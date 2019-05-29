<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Issue;
use App\Book;
use App\Ebook;

class DynamicPDFController extends Controller
{
    public function index()
    {
        $issued_book_data = $this->get_issued_book_data();
        return view('issues.index')->with('issued_book_data',$issued_book_data);
    }

    public function get_issued_book_data() 
    {
        $issued_book_data = Issue::with('user','book')->get();
        return $issued_book_data;
    }

    public function get_book_data()
    {
        $book_data = Book::with('author', 'genre', 'publisher', 'shelf')->get();
        return $book_data;
    }

    public function get_ebook_data()
    {
        $ebook_data = Ebook::with('author', 'genre', 'publisher')->get();
        return $ebook_data;
    }

    public function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_issued_book_data_to_html());
        return $pdf->stream();
    }

    public function pdfBook()
    {
        $pdfbook = \App::make('dompdf.wrapper');
        $pdfbook->loadHTML($this->convert_book_data_to_html());
        return $pdfbook->stream();
    }

    public function pdfEbook()
    {
        $pdfebook = \App::make('dompdf.wrapper');
        $pdfebook->loadHTML($this->convert_ebook_data_to_html());
        return $pdfebook->stream();
    }

    public function convert_issued_book_data_to_html()
    {
        $issued_book_data = $this->get_issued_book_data();
        $output = '
            <h3 align="center">Issued Book Data</h3>
            <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
            <th style="border: 1px solid; padding:12px;" width="30%">Book Title</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Student ID</th>
            <th style="border: 1px solid; padding:12px;" width=30%">Student Name</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Issued Date</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Returned Date</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Fine</th>
        </tr>
            ';  
            foreach($issued_book_data as $issued_book)
            {   
            if($issued_book['returned_date']==null)
            {
                $issued_book['returned_date'] = 'Not Returned Yet';
            }
            if($issued_book['fine']==0 || $issued_book['fine']==null)
            {
                $issued_book['fine'] = '0';
            }
            $output .= '
            <tr>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['book']['b_title'].'</td>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['user']['uid'].'</td>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['user']['name'].'</td>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['issued_date'].'</td>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['returned_date'].'</td>
            <td style="border: 1px solid; padding:12px;">'.$issued_book['fine'].'</td>
            </tr>
            ';
            }
            $output .= '</table>';
            return $output;
    }

    public function convert_book_data_to_html()
    {
        $book_data = $this->get_book_data();
        $output = '
            <h3 align="center">Books List</h3>
            <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
            <th style="border: 1px solid; padding:12px;" width="30%">Book Title</th>
            <th style="border: 1px solid; padding:12px;" width="30%">ISBN Number</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Publication Date</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Availability</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Edition</th>
        </tr>
            ';
        foreach ($book_data as $book) 
        {
           if($book['b_qty'] == 0)
           {
               $book['b_qty'] = 'No';
           }
            $output .= '
            <tr>
            <td style="border: 1px solid; padding:12px;">' . $book['b_title'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $book['b_isbn'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $book['pub_date'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $book['b_qty'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $book['edition'] . '</td>
            </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }

    public function convert_ebook_data_to_html()
    {
        $ebook_data = $this->get_ebook_data();
        $output = '
            <h3 align="center">Ebooks List</h3>
            <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
            <th style="border: 1px solid; padding:12px;" width="30%">Ebook Title</th>
            <th style="border: 1px solid; padding:12px;" width="30%">ISBN Number</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Publication Date</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Author</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Edition</th>
        </tr>
            ';
        foreach ($ebook_data as $ebook) 
        {
            $output .= '
            <tr>
            <td style="border: 1px solid; padding:12px;">' . $ebook['ebook_title'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $ebook['ebook_isbn'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $ebook['pub_date'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $ebook['author']['a_name'] . '</td>
            <td style="border: 1px solid; padding:12px;">' . $ebook['edition'] . ' Edition </td>
            </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }
}
