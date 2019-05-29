<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';

    protected $fillable = [
        'p_name',
        'p_email',
        'p_desc'
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
