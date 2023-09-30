<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class ProfileController extends Controller
{
    //direct admin home page
     public function index(){
        $id = Auth::user()->id;
        $user = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        return view("admin.profile.index",compact('user'));
     }

     //direct cahnge password page
     public function changePasswordPage(){
        return view('admin.profile.changePassword');
     }

    //update admin acc
    public function adminUpdate(Request $request){
        $userData = $this->accountValidationCheck($request);
        $userData = $this->getUserData($request);
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Account Updated Successful!']);
    }

    //admin password change
    public function changePassword(Request $request){
           $validator = $this->passwordValidationCheck($request);
           if($validator->fails()){
             return back()->withErrors($validator)->withInput();
           }

           $user = User::select('password')->where('id',Auth::user()->id)->first();
           $dbPassword = $user->password;

           if(Hash::check($request->oldPassword, $dbPassword)){
            $updatePassword = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($updatePassword);
            return redirect()->route('dashboard');
           }else{
            return back()->with(['fail' => 'Old password does nt match!']);
           }
        }


    //get user data
     private function getUserData($request){
        return[
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
     }
     //accountValidationCheck
     private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'Name is required!',
            'adminEmail.required' => 'Email is required!'
        ])->validate();
     }

     //password validation
     private function passwordValidationCheck($request){
        return Validator::make($request->all(),[
            'oldPassword' => 'required|min:1|max:15',
            'newPassword' => 'required|min:1|max:15',
            'confirmPassword' => 'required|min:1|max:15|same:newPassword',
        ]);
     }
}
