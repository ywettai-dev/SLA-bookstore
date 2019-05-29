<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;
use Auth;

class PublisherController extends Controller
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
            $pubs = Publisher::all();
            return view('publishers.index', compact('pubs'));
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
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            return view('publishers.create');
        } else {
            return redirect('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $request->validate([
                'p_name' => 'required|unique:publishers',
                'p_email' => 'required|unique:publishers|email'
            ]);
            $pubs = new Publisher([
                'p_name' => $request->get('p_name'),
                'p_email' => $request->get('p_email'),
                'p_desc' => $request->get('p_desc')
            ]);
            $pubs->save();
            return redirect('/publishers')->with('success', 'Publisher "' . $pubs->p_name . '" has been created!');
        } else {
            return redirect('home');
        }
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
            $pubs = Publisher::find($id);

            return view('publishers.edit', compact('pubs'));
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
                'p_name' => 'required',
                'p_email' => 'required|email',
            ]);

            $pubs = Publisher::find($id);
            $pubs->p_name = $request->get('p_name');
            $pubs->p_email = $request->get('p_email');
            $pubs->p_desc = $request->get('p_desc');
            $pubs->save();


            return redirect('/publishers')->with('success', 'Publisher "' . $pubs->p_name . '" has been updated');
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
        if ($admin === 1) {
            $pubs = Publisher::find($id);
            $pubs->delete();

            return redirect('/publishers')->with('success', 'Publisher "' . $pubs->p_name . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }
}
