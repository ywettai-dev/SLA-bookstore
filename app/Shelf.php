<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $table = 'shelves';

    protected $fillable = [
        's_name',
        's_desc',
        'status'
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
