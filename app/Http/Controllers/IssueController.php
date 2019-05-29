<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Input;
use App\User;
use App\Book;
use App\Issue;

class IssueController extends Controller
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
            $result['issues'] = Issue::with('user', 'book')->get()->toArray();
            $result['books'] = Book::with('author', 'genre', 'publisher', 'shelf')->get()->toArray();
            return view('issues.index', $result);
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
            return view('issues.create');
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
                'student_id' => 'required|exists:users,uid',
                'book_isbn' => 'required|exists:books,b_isbn'
            ],[
                'student_id.required' => 'Student ID must be provided.',
                'book_isbn.required' => 'Book ISBN Number must be provided.',
                'student_id.exists' => 'Student ID is invalid. Check again!',
                'book_isbn.exists' => 'Book ISBN Number is invalid. Check again!'
            ]);
            
            //check inputs have their own entity
            $student_id = $request->student_id;
            $book_isbn = $request->book_isbn;
            //check active status
            $active_status = DB::table('users')->select('status')->where('uid', '=', $student_id)->take(1)->first();
            
            $check_student_id = User::where('uid', '=', $student_id)->exists();
            $check_book_isbn = Book::where('b_isbn', '=', $book_isbn)->exists();
            //get book id where isbn is the same
            $get_book_id = DB::table('books')
                           ->select('id')
                           ->where('b_isbn', '=', $book_isbn)
                           ->take(1)
                           ->first();
            //get user id where u_id and student_id is the same
            $get_u_id = DB::table('users')
                        ->select('id')
                        ->where('uid', '=', $student_id)
                        ->take(1)
                        ->first();
            
            $qty_query = DB::table('books')
                        ->where('id',$get_book_id->id);

            if($check_student_id && $check_book_isbn && ($active_status->status==1))
            { 
                $issue = new Issue();
                $issue->book_id = $get_book_id->id;
                $issue->u_id = $get_u_id->id;
                $issue->student_id = $request->input('student_id');
                $issue->issued_date = now();
                //Check return status
                $return_status = DB::table('issues')
                                ->select('return_status')
                                ->where('u_id', '=', $get_u_id->id)
                                ->take(1)
                                ->first();
                if($return_status == null || ($return_status->return_status == 1))
                {
                    //decrement as student issued book
                    $qty_query->decrement('b_qty');
                    $issue->save();

                    return redirect('/issues')->with('success', 'Book has successfully issued!');
                }
                else 
                {
                    echo('You have not returned book yet');
                }
            }
            else 
            {
                return redirect()->back()->withInput()->withErrors('This student is inactive!');
            }
  
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
            //return issue
            $result['issue'] = Issue::with('user','book')->where('id', $id)->first()->toArray();
            return view('issues.edit', $result);
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
            $issue = Issue::find($id);
            $issue->returned_date = now();
            $issue->return_status = 1;
            $issue->fine = $request->input('book_fine');

            $qty_query = DB::table('books')
                        ->where('id',$issue->book_id);
            //increment as student issued book
            $qty_query->increment('b_qty'); 

            $issue->save();
            
            return redirect('/issues')->with('success', 'Book has been returned!');
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
        //
    }
}
