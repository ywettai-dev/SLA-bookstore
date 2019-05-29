<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Ebook;

class PublicController extends Controller
{
    public function index()
    {
        $result['latest_books'] = Book::with('author', 'genre', 'publisher', 'shelf')->orderBy('id', 'desc')->limit(4)->get();
        $result['latest_ebooks'] = Ebook::with('author', 'genre', 'publisher')->orderBy('id', 'desc')->limit(4)->get();
        return view('public', $result);
    }

    public function allBook()
    {
        $all_books = Book::with('author', 'genre', 'publisher', 'shelf')->get();
        return view('books.all', compact('all_books'));
    }

    public function allEbook()
    {
        $all_ebooks = Ebook::with('author', 'genre', 'publisher')->get();
        return view('ebooks.all', compact('all_ebooks'));
    }
}
