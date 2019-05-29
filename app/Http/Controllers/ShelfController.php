<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Shelf;
use App\Genre;

class ShelfController extends Controller
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
            $shelves = Shelf::all();
            return view('shelves.index', compact('shelves'));
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
            return view('shelves.create');
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
                's_name' => 'required|unique:shelves'
            ]);
            $shelf = new Shelf([
                's_name' => $request->get('s_name'),
                'status' => $request->get('s_status'),
                's_desc' => $request->get('s_desc')
            ]);
            $shelf->save();

            return redirect('/shelves')->with('success', 'Shelf "' . $shelf->s_name . '" has been created!');
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
            $shelf = Shelf::find($id);

            return view('shelves.edit', compact('shelf'));
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
                's_name' => 'required',
            ]);

            $shelf = Shelf::find($id);
            $shelf->s_name = $request->get('s_name');
            $shelf->status = $request->get('s_status');
            $shelf->s_desc = $request->get('s_desc');
            $shelf->save();


            return redirect('/shelves')->with('success', 'Shelf "' . $shelf->s_name . '" has been updated');
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
            $shelf = Shelf::find($id);
            $shelf->delete();

            return redirect('/shelves')->with('success', 'Shelf "' . $shelf->s_name . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }
}
