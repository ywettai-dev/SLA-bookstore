<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'b_title', 'b_isbn', 'b_qty', 'pub_date', 'edition', 'a_id', 'g_id',
        'p_id', 's_id', 'b_page', 'b_price', 'b_cover', 'b_desc'
    ];

    function author()
    {
        return $this->belongsTo('App\Author', 'a_id');
    }

    function genre()
    {
        return $this->belongsTo('App\Genre', 'g_id');
    }

    function publisher()
    {
        return $this->belongsTo('App\Publisher', 'p_id');
    }

    function shelf()
    {
        return $this->belongsTo('App\Shelf','s_id');
    }

    public function issue()
    {
        return $this->hasMany('App\Issue');
    }
}
