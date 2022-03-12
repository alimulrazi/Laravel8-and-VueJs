<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function changePassword(){
        return view('admin.profile.change_password');
    }

    public function updatePassword(Request $request)
    {
       $validatedData =  $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Updated successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Current Password incorrect!!');
        }
    }

    public function updateProfile()
    {
       if(Auth::user()){
        $user = User::find(Auth::user()->id);
        return view('admin.profile.update_profile', compact('user'));
       }
        
    }

    public function updateUserProfile(Request $request)
    {
       
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return redirect()->back()->with('success', 'Profile Updated successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Error in update!!');
        }
       
    }


}
