<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Book;
use App\Publisher;
use App\Genre;
use App\Author;
use App\Shelf;
use App\Library\File_upload;
use Input;
use DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $result['books'] = Book::with('author', 'genre', 'publisher', 'shelf')->get()->toArray();
            return view('books.index', $result);
        } else {
            return redirect('login');
        }
    }

    public function detailAdmin(Request $request,$id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $detail = Book::with('author', 'genre', 'publisher', 'shelf')->where('id',$id)->first();
            return view('books.detailAdmin', compact('detail'));
        } else {
            return redirect('home');
        }
    }

    public function detail(Request $request,$id)
    {
        $detail = Book::with('author', 'genre', 'publisher', 'shelf')->where('id', $id)->first();
        return view('books.detail', compact('detail'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $results = DB::table('books')
                    ->join('authors', 'books.a_id', '=', 'authors.id')
                    ->join('genres', 'books.g_id', '=', 'genres.id')
                    ->join('publishers', 'books.p_id', '=', 'publishers.id')
                    ->select('books.*', 'authors.a_name', 'genres.g_name', 'publishers.p_name')
                    ->where('books.b_title', 'like', '%'.$search.'%')
                    ->orwhere('authors.a_name', 'like', '%'.$search.'%')
                    ->orwhere('genres.g_name', 'like', '%' . $search . '%')
                    ->orwhere('publishers.p_name', 'like', '%' . $search . '%')
                    ->get();
        $books = Book::where('b_title','like','%'.$search.'%')->paginate(8);
        
        return view('books.search',compact('results','books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) 
        {
            $result['authors'] = Author::get()->toArray();

            $result['genres'] = Genre::get()->toArray();

            $result['publishers'] = Publisher::get()->toArray();

            $result['shelves'] = Shelf::get()->toArray();

            return view('books.create', $result);
        }
        else
        {
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
        if($admin === 1)
        {
            $request->validate([
                'b_title'=>'required|unique:books',
                'b_isbn'=>'required|unique:books',
                'b_qty'=>'required',
                'b_price'=>'required',
                'b_cover'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],[
                'b_title.required'=> 'Book title must be provided.',
                'b_isbn.required' => 'Book ISBN must be provided.',
                'b_title.unique' => 'Book title already exists.',
                'b_isbn.unique' => 'Book ISBN must be unique.',
                'b_qty.required' => 'Book Quantity must be provided',
                'b_price.required' => 'Book price must be provided.'
            ]);
            
            //bookcover upload use App\Library\File_upload
            $file = new File_upload;
            $b_cover = $file->image_upload('b_cover');

            $book = new Book();
            $book->b_title=$request->input('b_title');
            $book->b_isbn=$request->input('b_isbn');
            $book->b_qty=$request->input('b_qty');
            $book->pub_date=$request->input('pub_date');
            $book->edition=$request->input('b_edition');
            $book->a_id=$request->input('a_id');
            $book->g_id=$request->input('g_id');
            $book->p_id=$request->input('p_id');
            $book->s_id=$request->input('s_id');
            $book->b_page=$request->input('b_page');
            $book->b_price=$request->input('b_price');
            $book->b_cover=$b_cover;
            $book->b_desc=$request->input('b_desc');
            $book->save();
            return redirect('/books')->with('success', 'Book "' . $book->b_title . '" has been created!');
        }
        else
        {
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

            //return book
            $result['book'] = Book::where('id', $id)->first()->toArray();
            //return author
            $result['authors'] = Author::get()->toArray();
            //return genre
            $result['genres'] = Genre::get()->toArray();
            //return publisher
            $result['publishers'] = Publisher::get()->toArray();
            //return shelf
            $result['shelves'] = Shelf::get()->toArray();

            return view('books.edit', $result);
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
                'b_title' => 'required',
                'b_isbn' => 'required',
                'b_qty' => 'required',
                'b_price' => 'required',
                'b_cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            
            //bookcover upload use App\Library\File_upload
            $file = new File_upload;
            $b_cover = $file->image_upload('b_cover');
            
            //check if the update image has chosen
            if ($b_cover == "" || $b_cover == null) {
                $b_cover = $request->input('origin_b_cover');
            }
            
            $book = Book::find($id);
            $book->b_title = $request->input('b_title');
            $book->b_isbn = $request->input('b_isbn');
            $book->b_qty = $request->input('b_qty');
            $book->pub_date = $request->input('pub_date');
            $book->edition = $request->input('b_edition');
            $book->a_id = $request->input('a_id');
            $book->g_id = $request->input('g_id');
            $book->p_id = $request->input('p_id');
            $book->s_id = $request->input('s_id');
            $book->b_page = $request->input('b_page');
            $book->b_price = $request->input('b_price');
            $book->b_cover = $b_cover;
            $book->b_desc = $request->input('b_desc');
            $book->save();
            return redirect('/books')->with('success', 'Book "' . $book->b_title . '" has been updated!');
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
            $book = Book::find($id);
            $book->delete();

            return redirect('/books')->with('success', 'Book "' . $book->b_title . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }

    
}
