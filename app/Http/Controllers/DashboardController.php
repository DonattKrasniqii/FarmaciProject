<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\BlogRepository;
use App\Repositories\CityRepository;
use App\Repositories\ContactMessagesRepository;
use App\Repositories\DrugRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    private $cityRepository;
    private $userRepository;
    private $drugRepository;
    private $contactMessagesRepository;
    private $ordersRepository;
    private $paymentsRepository;
    private $blogRepository;

    public function __construct(CityRepository $cityRepository, UserRepository $userRepository, DrugRepository $drugRepository, ContactMessagesRepository $contactMessagesRepository, OrdersRepository $ordersRepository, PaymentsRepository $paymentsRepository,BlogRepository $blogRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->drugRepository = $drugRepository;
        $this->contactMessagesRepository = $contactMessagesRepository;
        $this->ordersRepository = $ordersRepository;
        $this->paymentsRepository = $paymentsRepository;
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        return view('templates.web-dashboard.index', ['cities' => $this->cityRepository->getAll(), 'drugs' => $this->drugRepository->getDrugs(),
            'drugStores' => $this->userRepository->getUsersWithPagination(),'stores'=>$this->userRepository->getAll(), 'messages' => $this->contactMessagesRepository->getAll(), 'orders' => $this->ordersRepository->getOrders(),'payments'=>$this->paymentsRepository->getAll(),'blogs'=>$this->blogRepository->getBlogs()
            ,'drugsToBeAccepted' => $this->drugRepository->getNotAcceptedDrugs(),'totalSumDrugs' => $this->drugRepository->countTotal(),'countNotAccepted' => $this->drugRepository->countNotAccepted()]);
    }

    public function userInfoUpdate(Request $request)
    {
        $user = $this->userRepository->getById(auth()->user()->id);
        if (!is_null($user)) {
            if (!empty($user->logo)) {
                $request->validate([
                    'name' => 'required',
                    'city' => 'required',
                    'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore(auth()->user()->id)],
                ]);
            } else {
                $request->validate([
                    'name' => 'required',
                    'city' => 'required',
                    'logo' => 'required',
                    'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore(auth()->user()->id)],
                ]);
            }
            if ($this->userRepository->update($request, $user)) {
                session()->flash('success', 'Llogaria është përditesuar !');
                return redirect()->action([DashboardController::class, 'index']);
            } else {
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
        } else {
            return redirect()->back();
        }
    }
}
