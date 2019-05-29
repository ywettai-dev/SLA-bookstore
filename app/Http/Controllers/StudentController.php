<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $users = User::all()->where('admin',0);
            return view('students.index', compact('users'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $user = User::find($id);
            return view('students.edit', compact('user'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'status' => 'required'
            ]);

            $user = User::find($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->status = $request->get('status');
            $user->save();


            return redirect('/students')->with('success', 'Student "' . $user->uid . '" has been updated');
        } else {
            return redirect('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) 
        {
            $user = User::find($id);
            $user->delete();

            return redirect('/students')->with('success', 'Student "' . $user->uid . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }
}
