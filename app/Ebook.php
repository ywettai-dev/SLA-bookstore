<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $table = 'ebooks';

    protected $fillable = [
        'ebook_title', 'ebook_isbn', 'pub_date', 'edition', 'a_id', 'g_id',
        'p_id', 'ebook_page', 'ebook_cover', 'ebook_pdf' ,'ebook_desc'
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

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
