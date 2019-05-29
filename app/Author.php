<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    
    protected $fillable = [
        'a_name',
        'a_email',
        'a_desc'
    ];

    public function book()
    {
        return $this->hasMany('App\Book');
    }

    public function ebook()
    {
        return $this->hasMany('App\Ebook');
    }
}
