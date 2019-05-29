<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Auth; 
use App\Shelf;

class GenreController extends Controller
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
            $genres = Genre::all();
            return view('genres.index', compact('genres'));
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
            return view('genres.create');
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
                'g_name' => 'required|unique:genres'
            ]);
            $genre = new Genre([
                'g_name' => $request->get('g_name'),
                'g_desc' => $request->get('g_desc')
            ]);
            $genre->save();

            return redirect('/genres')->with('success', 'Genre "' . $genre->g_name . '" has been created!');
        } else {
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $genre = Genre::find($id);

            return view('genres.edit', compact('genre'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $request->validate([
                'g_name' => 'required'
            ]);

            $genre = Genre::find($id);
            $genre->g_name = $request->get('g_name');
            $genre->g_desc = $request->get('g_desc');
            $genre->save();


            return redirect('/genres')->with('success', 'Genre "' . $genre->g_name . '" has been updated');
        } else {
            return redirect('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $genre = Genre::find($id);
            $genre->delete();

            return redirect('/genres')->with('success', 'Genre "' . $genre->g_name . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }
}
