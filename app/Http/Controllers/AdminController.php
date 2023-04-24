<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function getAdminList(){
        $users=User::get();

        return view('admin.adminList',compact('users'));
    }
    //
    public function getProfile(){
        $user=Auth::user();

        return view('admin.adminProfile',compact('user'));
    }
    public function profileDetail($id){
        $user=User::where('id',$id)->first();

        return view('admin.profileDetail',compact('user'));

    }
    //

    public function editProfilePage($id){
        $user=User::where('id',$id)->first();

        return view('admin.editProfile',compact('user'));
    }
    //
    public function deleteAdmin($id){
        $user=User::where('id',$id)->delete();
        $users=User::get();


        return redirect()->route('admin#list',compact('users'))->with(['deleteSuccess'=>'deleted Success']);


    }
    //
    public function editProfile(Request $request){
       $data= $this->getUserData($request);
       $user=User::where('id',$request->userId)->first();
        if($request->userImage){

           if($user->image){
            Storage::delete('public/users/'.$user->image);
                }
            $imageName=uniqid().'_'.$request->file('userImage')->getClientOriginalName();
            $request->file('userImage')->storeAs('public/users',$imageName);
            $data['image']=$imageName;
        }
        User::where('id',$request->userId)->update($data);
        return redirect()->route('admin#editProfilePage',$user);
    }
    public function changeRole(Request $request){
        $user=User::where('id',$request->userId)->exists();
        if($user){
            User::where('id',$request->userId)->update([
                    "role"=>$request->role
            ]);
            return response()->json([
                "status"=>"success",
                "user"=>$user
            ]);
        }
    }
    //
    public function getUserData($request){
        return [
            'name'=>$request->userName,
            'email'=>$request->userEmail,
            'phone'=>$request->userPhone,
            'gender'=>$request->userGender,
            'address'=>$request->userAddress
        ];
    }
}
