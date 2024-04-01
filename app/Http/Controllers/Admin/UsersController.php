<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('email', '!=', 'superadmin@gmail.com')->paginate(15);
        return view('admin.users.index', compact('users'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminList()
    {
        $admins = User::where('email', '!=', 'superadmin@gmail.com')->where('role_id', 1)->paginate(15);
        return view('admin.users.adminList', compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($user->role_id == 1){
            $user->role_id = 2;
        } else {
            $user->role_id = 1;
        }
        $user->save();
        session()->flash('success','Role Changed Successfully');
        return redirect()->back();
    }
}
