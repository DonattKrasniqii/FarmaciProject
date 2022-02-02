<?php namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Password_Reset;
use App\Models\User;
use App\Notifications\SlackMessageAPI;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\DrugRepository;
use App\Repositories\DrugSeenRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;

class HomeController extends Controller
{
    private $cityRepository;
    private $userRepository;
    private $drugRepository;
    private $categoryRepository;
    private $drugSeenRepository;

    public function __construct(CityRepository $cityRepository, UserRepository $userRepository, DrugRepository $drugRepository, CategoryRepository $categoryRepository, DrugSeenRepository $drugSeenRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->drugRepository = $drugRepository;
        $this->categoryRepository = $categoryRepository;
        $this->drugSeenRepository = $drugSeenRepository;
    }

    public function index(Request $request)
    {
        return view('index', ['drugs' => $this->drugRepository->getDrugsWithPagination($request), 'bannerDrugStores' => $this->userRepository->getBannerDrugStores(),
            'storesCount' => $this->drugRepository->countStores(), 'drugsCount' => $this->drugRepository->countDrugs(), 'categories' => $this->categoryRepository->getAll(), 'visitors' => $this->drugSeenRepository->countAllVisits()]);
    }

    public function auth()
    {
        return view('templates.auth.auth', ['cities' => $this->cityRepository->getAll()]);
    }

    public function authRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'logo' => 'required',
            'email' => ['required', Rule::unique(User::class, 'email')],
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);


        if ($this->userRepository->store($request)) {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                Notification::route('slack', env('SLACK_WEBHOOK'))
                    ->notify(new SlackMessageAPI($validated));
                return redirect()->action([DashboardController::class, 'index']);
            } else {
                return redirect()->action([HomeController::class, 'index']);

            }
        } else {
            return redirect()->action([HomeController::class, 'index']);
        }
    }

    public function reloadCaptcha(){

        return response()->json(['captcha'=> captcha_img()]);
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', 'Kredencialet gabim !');
        }
    }

    public function resetPasswordView()
    {
        return view('templates.auth.password-reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $token = Hash::make($request->input('email'));
        $token = str_replace("/", "", $token);

        if ($this->userRepository->validateEmail($request->input('email'))) {

            DB::table('password_resets')->insert(
                ['email' => $request->input('email'), 'token' => $token, 'created_at' => Carbon::now()]
            );

            Mail::send('templates.auth.recover-password-verify', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });

            return back()->with('message', 'Në email ju kemi derguar instruksionet e nevojshme !');
        } else {
            return back()->with('message', 'Në email ju kemi derguar instruksionet e nevojshme !');
        }
    }

    public function resetPasswordFinal($token)
    {
        $email = $this->userRepository->getPasswordResetEmailByToken($token);
        if (!is_null($email)) {
            return view('templates.auth.reset-password-token', ['email' => $email->email, 'token' => $token]);
        }
        return redirect('/');
    }

    public function resetPasswordViaEmail(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required',
            'repeatpw' => 'required',
        ]);
        $email = $this->userRepository->getPasswordResetEmailByToken($request->input('token'));
        if ($request->input('password') == $request->input('repeatpw')) {
            if ($this->userRepository->resetPassword($request, $email)) {
                return redirect()->action([HomeController::class, 'successfulResetPasswordNote']);
            }
        }
        return redirect()->back()->with('message', 'Fjalëkalime të ndryshme !');
    }

    public function successfulResetPasswordNote()
    {
        return view('templates.auth.password-successfully-reset');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action([HomeController::class, 'index']);
    }




}
