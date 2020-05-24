<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image',
    ];

    /**
     * The filters that someone can use for the Project Entity
     * @var array
     */
    public static $filters = [
        'id', 'title'
    ];


}
