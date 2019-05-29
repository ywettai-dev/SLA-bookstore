<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;

class Issue extends Model
{
    protected $table = 'issues';

    protected $fillable = [
        'book_id', 'u_id', 'student_id', 'issued_date', 
        'returned_date', 'return_status', 'fine'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User','u_id');
    }

    public function book()
    {
        return $this->belongsTo('App\Book','book_id');
    }
    
}
