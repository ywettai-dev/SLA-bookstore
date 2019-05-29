<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNull('approved_at')->get();
        return view('users',compact('users'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update([
            'approved_at'=>now(),
            'status'=>1
        ]);
        return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }

}
