<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use Auth;

class AuthorController extends Controller
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
        if($admin===1)
        {
            $authors = Author::all();
            return view('authors.index', compact('authors'));
        }
        else
        {
            return redirect('/');
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
        if($admin===1)
        {
            return view('authors.create');
        }
        else
        {
            return redirect('/');
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
        if($admin===1)
        {
            $request->validate([
            'a_name'=>'required|unique:authors',
            'a_email'=>'required|unique:authors|email'
        ]);
        $author = new Author([
            'a_name'=>$request->get('a_name'),
            'a_email'=>$request->get('a_email'),
            'a_desc'=>$request->get('a_desc')
        ]);
        $author->save();
        return redirect('/authors')->with('success', 'Author "'.$author->a_name.'" has been created!');
        }
        else
        {
            return redirect('/');
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
        $admin=Auth::user()->admin;
        if($admin===1)
        {
            $author = Author::find($id);

            return view('authors.edit', compact('author'));
        }
        else
        {
            return redirect('/');
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
        if ($admin===1) 
        {
            $request->validate([
                'a_name' => 'required',
                'a_email' => 'required|email',
            ]);

            $author = Author::find($id);
            $author->a_name = $request->get('a_name');
            $author->a_email = $request->get('a_email');
            $author->a_desc = $request->get('a_desc');
            $author->save();
            
            
            return redirect('/authors')->with('success', 'Author "'.$author->a_name.'" has been updated');
        }
        else
        {
            return redirect('/');
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
        if ($admin===1) 
        {
            $author = Author::find($id);
            $author->delete();

            return redirect('/authors')->with('success', 'Author "'. $author->a_name .'" has been deleted Successfully');
        }
        else
        {
            return redirect('/');
        }
    }
}
