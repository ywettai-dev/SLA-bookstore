<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ebook;
use App\User;
use App\Publisher;
use App\Genre;
use App\Author;
use App\Library\File_upload;

class EbookController extends Controller
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
            $result['ebooks'] = Ebook::with('author', 'genre', 'publisher')->get()->toArray();
            return view('ebooks.index', $result);
        } else {
            return redirect('home');
        }
    }

     public function detailAdmin(Request $request,$id)
    {
        $admin = Auth::user()->admin;
        if ($admin === 1) {
            $detail = Ebook::with('author', 'genre', 'publisher')->where('id',$id)->first();
            return view('ebooks.detailAdmin', compact('detail'));
        } else {
            return redirect('home');
        }
    }

    public function detail(Request $request, $id)
    {
        $detail = Ebook::with('author', 'genre', 'publisher')->where('id', $id)->first();
        return view('ebooks.detail', compact('detail'));
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

            return view('ebooks.create', $result);
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
                'ebook_title'=>'required|unique:ebooks',
                'ebook_isbn'=>'required|unique:ebooks',
                'ebook_cover'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ebook_pdf' => 'required|mimes:pdf|max:10000'
            ],[
                'ebook_title.required' => 'Ebook title must be provided.',
                'ebook_isbn.required' => 'Ebook ISBN must be provided.',
                'ebook_title.unique' => 'Ebook already exists.',
                'ebook_isbn.unique' => 'Ebook ISBN must be unique.',
                'ebook_pdf.required' => 'Ebook pdf file must be chosen.',
                'ebook_pdf.mimes' => 'Only PDF file extension can be uploaded.'
            ]);
            
            //bookcover upload use App\Library\File_upload
            $file = new File_upload;
            $ebook_cover = $file->image_upload('ebook_cover');
            $ebook_pdf = $file->pdf_upload('ebook_pdf');

            $ebook = new Ebook();
            $ebook->ebook_title=$request->input('ebook_title');
            $ebook->ebook_isbn=$request->input('ebook_isbn');
            $ebook->pub_date=$request->input('pub_date');
            $ebook->edition=$request->input('ebook_edition');
            $ebook->a_id=$request->input('a_id');
            $ebook->g_id=$request->input('g_id');
            $ebook->p_id=$request->input('p_id');
            $ebook->ebook_page=$request->input('ebook_page');
            $ebook->ebook_cover=$ebook_cover;
            $ebook->ebook_pdf=$ebook_pdf;
            $ebook->ebook_desc=$request->input('ebook_desc');
            $ebook->save();
            return redirect('/ebooks')->with('success', 'Book "' . $ebook->ebook_title . '" has been created!');
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
            $result['ebook'] = Ebook::where('id', $id)->first()->toArray();
            //return author
            $result['authors'] = Author::get()->toArray();
            //return genre
            $result['genres'] = Genre::get()->toArray();
            //return publisher
            $result['publishers'] = Publisher::get()->toArray();

            return view('ebooks.edit', $result);
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
        if($admin === 1)
        {
            $request->validate([
                'ebook_title'=>'required',
                'ebook_isbn'=>'required',
                'ebook_cover'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ebook_pdf' => 'mimes:pdf|max:10000'
            ],[
                'ebook_title.required' => 'Ebook title must be provided.',
                'ebook_isbn.required' => 'Ebook ISBN must be provided.',
                'ebook_pdf.mimes' => 'Only PDF file extension can be uploaded.'
            ]);
            
            //bookcover upload use App\Library\File_upload
            $file = new File_upload;
            $ebook_cover = $file->image_upload('ebook_cover');
            $ebook_pdf = $file->pdf_upload('ebook_pdf');

            //check if the update image has chosen
            if ($ebook_cover == "" || $ebook_cover == null) {
                $ebook_cover = $request->input('origin_ebook_cover');
            }
            //check if the update pdf has chosen
            if ($ebook_pdf == "" || $ebook_pdf == null) {
                $ebook_pdf = $request->input('origin_ebook_pdf');
            }

            $ebook = Ebook::find($id);
            $ebook->ebook_title=$request->input('ebook_title');
            $ebook->ebook_isbn=$request->input('ebook_isbn');
            $ebook->pub_date=$request->input('pub_date');
            $ebook->edition=$request->input('ebook_edition');
            $ebook->a_id=$request->input('a_id');
            $ebook->g_id=$request->input('g_id');
            $ebook->p_id=$request->input('p_id');
            $ebook->ebook_page=$request->input('ebook_page');
            $ebook->ebook_cover=$ebook_cover;
            $ebook->ebook_pdf=$ebook_pdf;
            $ebook->ebook_desc=$request->input('ebook_desc');
            $ebook->save();
            return redirect('/ebooks')->with('success', 'Book "' . $ebook->ebook_title . '" has been updated!');
        }
        else
        {
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
            $ebook = Ebook::find($id);
            $ebook->delete();

            return redirect('/ebooks')->with('success', 'Book "' . $ebook->ebook_title . '" has been deleted Successfully');
        } else {
            return redirect('home');
        }
    }

    public function download_pdf($id)
    {
        $res = Ebook::get()->where('id', $id)->first()->toArray();
        $file = $res['ebook_pdf'];
        $file_path = public_path('pdf/' . $file);
        return response()->download($file_path);
    }
}
