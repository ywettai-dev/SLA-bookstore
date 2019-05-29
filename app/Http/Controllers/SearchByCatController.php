<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Genre;
use App\Publisher;
use App\Book;
use App\Shelf;

class SearchByCatController extends Controller
{
    public function searchCatindex()
    {
        $authors = Author::get()->toArray();
        $genres = Genre::get()->toArray();
        $publishers = Publisher::get()->toArray();
        $books = Book::with('author', 'genre', 'publisher', 'shelf')->paginate(8);
        return view('books.searchCat', compact('authors', 'genres', 'publishers', 'books'));
    }

    public function authorCat(Request $request, $id, $name)
    {
        $authors = Author::get()->toArray();
        $genres = Genre::get()->toArray();
        $publishers = Publisher::get()->toArray();
        $books = Book::with('author', 'genre', 'publisher', 'shelf')->paginate(8);
        
        $res_author = Book::with('author', 'genre', 'publisher', 'shelf')->where('a_id',$id)->paginate(8);
        $a_name = $request->name;
        return view('books.searchCat', compact('authors', 'genres', 'publishers', 'books', 'res_author', 'a_name'));
    }

    public function genreCat(Request $request, $id, $name)
    {
        $authors = Author::get()->toArray();
        $genres = Genre::get()->toArray();
        $publishers = Publisher::get()->toArray();
        $books = Book::with('author', 'genre', 'publisher', 'shelf')->paginate(8);

        $res_genre = Book::with('author', 'genre', 'publisher', 'shelf')->where('g_id', $id)->paginate(8);
        $g_name = $request->name;
        return view('books.searchCat', compact('authors', 'genres', 'publishers', 'books', 'res_genre', 'g_name'));
    }

    public function publisherCat(Request $request, $id, $name)
    {
        $authors = Author::get()->toArray();
        $genres = Genre::get()->toArray();
        $publishers = Publisher::get()->toArray();
        $books = Book::with('author', 'genre', 'publisher', 'shelf')->paginate(8);

        $res_publisher = Book::with('author', 'genre', 'publisher', 'shelf')->where('p_id', $id)->paginate(8);
        $p_name = $request->name;
        return view('books.searchCat', compact('authors', 'genres', 'publishers', 'books', 'res_publisher', 'p_name'));
    }

}
