<?php namespace App\Repositories;

use App\Mail\WelcomeMail;
use App\Models\PasswordReset;
use App\Models\ProfileViews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserRepository
{
    public function getById($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        return $this->update($request, new User());
    }

    public function update(Request $request, $user)
    {
        if (!$user instanceof User) {
            $user = $this->getById($user);
        }
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        $user->city_id = $request->input('city');
        $user->address = $request->input('address');
        $user->website_url = $request->input('website_url');
        $user->facebook_url = $request->input('facebook_url');
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = time() . '.' . $logo->getClientOriginalExtension();
            $img = Image::make($logo->getRealPath());
            $img->stream();
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');
            if (file_exists($user->logo)) {
                unlink($user->logo);
            }
            $user->logo = "/storage/images/" . $fileName;
        }

        if (!is_null($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        return $user->save();
    }

    public function getUsersWithPagination()
    {
        return User::orderBy('advertise_type', 'ASC')->orderBy('created_at', 'DESC')->paginate(30);
    }

    public function changeAdvertiseType($id, $type)
    {
        $user = $this->getById($id);
        if (!is_null($user)) {
            $user->advertise_type = $type;
            return $user->save();
        }
        return false;
    }

    public function deleteUser($user)
    {

        if (!is_null($user)) {
            return $user->delete();
        }
        return false;
    }

    public function getBannerDrugStores()
    {
        return User::where('is_admin', 0)->orderBy('advertise_type')->orderBy('created_at', 'DESC')->take(20)->get();
    }

    public function validateEmail($email)
    {
        $user = User::where('email', $email)->get();
        if (!is_null($user)) {
            return true;
        }
        return false;
    }

    public function getPasswordResetEmailByToken($token)
    {
        return PasswordReset::where('token', $token)->first();
    }

    public function resetPassword(Request $request, $email)
    {
        $user = User::where('email', $email->email)->first();
        if (!is_null($user)) {
            PasswordReset::where('email', $email->email)->delete();
            $user->password = Hash::make($request->input('password'));
            return $user->save();
        }
        return false;
    }

    public function makeUserView($idViewer,$idBeingViewed){

        $user = $this->getById($idViewer);

        if(!is_null($user)){
            $profileView = new ProfileViews();
            $profileView->profile_id = $idBeingViewed;
            $profileView->viewer_id = $idViewer;

            return $profileView->save();
        }

        return false;

    }

    public function getAll()
    {
        return User::orderBy('name')->get();
    }

    public function userStatusChanger($user,$type){

        if (!is_null($user)) {
            if($user->is_active == User::USER_IS_ACTIVE){
                $user->is_active = User::USER_IS_DEACTIVATED;

            }else{
                $user->is_active = User::USER_IS_ACTIVE;
            }

            return $user->save();
        }
    }
}
