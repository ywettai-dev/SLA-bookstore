<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    
    protected $fillable = [
        'g_name',
        'g_desc'
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
