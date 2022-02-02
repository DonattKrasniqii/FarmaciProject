<?php namespace App\Http\Controllers;

use App\Models\ProfileViews;
use App\Models\User;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function viewStore($id)
    {
        $user = $this->userRepository->getById($id);
        if (!is_null($user)) {
            if(auth()->check() && auth()->user()->id != $user->id ) {
                if ($this->userRepository->makeUserView(auth()->user()->id, $user->id)) {
                    return view('templates.web.store.index', ['user' => $this->userRepository->getById($id)]);
                }
            }
            return view('templates.web.store.index', ['user' => $this->userRepository->getById($id)]);
        } else {
            return redirect()->action([HomeController::class, 'index']);
        }
    }

    public function advertiseType($id, $type)
    {
        if ($this->userRepository->changeAdvertiseType($id, $type)) {
            session()->flash('success', 'Llogaria është bërë ' . $this->getAdvertiseTypeName($type) . ' !');
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    private function getAdvertiseTypeName($type)
    {
        switch ($type) {
            case 1:
                return "Premium";
                break;
            case 2:
                return "Top";
                break;
            case 3:
                return "Standard";
                break;
        }
    }

    //inserse shkaku se dergohen numrat ne parameter para se me ju ndryshu statusi.

    private function getUserStatusInverse($type){

        switch ($type) {
            case 1:
                return "deaktivizua";
                break;
            case 0:
                return "aktivizua";
                break;
        }

    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->getById($id);
        if ($this->userRepository->deleteUser($user)) {
            $msg = 'Barnatorja u fshi me sukses , oops , <a href="'. action('UserController@restore',$user->id) . '"> <strong>kliko këtu </strong></a>  për të rikthyer barnatoren';
            session()->flash('warning', $msg);
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function restore($id){

        $user = User::withTrashed()->find($id);
        if(auth()->user()->isAdmin()){
            if($user && $user->trashed()){
             }
            session()->flash('success','Barnatorja është rikthyer me sukses');
            return redirect()->action([DashboardController::class,'index']);
        }else{
            session()->flash('error','Gabim në procesim !');
        }

    }

    public function viewsDelete($id)
    {

        $user = auth()->user();
        if ($user) {
            if ($user->views[0]->profileUser->id == $user->id) {
                $user->views()->where('id', $id)->delete();
                session()->flash('success', 'Njoftimi u fshi me sukses');
                return redirect()->action([DashboardController::class, 'index']);
            }
        }
        else{
            session()->flash('error','Gabim në procesim !');
            return redirect()->action([DashboardController::class,'index']);
        }
    }

    public function userStatus($id,$type){

        $user = $this->userRepository->getById($id);
       if(\auth()->user()->is_admin) {
           if ($this->userRepository->userStatusChanger($user,$type)) {
               session()->flash('success', 'Sukses! Llogaria e ' . $user->name . " u " . $this->getUserStatusInverse($type));
               return redirect()->action([DashboardController::class, 'index']);
           } else {
               session()->flash('error', 'Gabim në procesim !');
               return redirect()->action([DashboardController::class, 'index']);
           }
       }

    }
}
