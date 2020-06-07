<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProjectTag extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];
    /**
     * Dont show theese fields when returning data from DB
     * @var array
     */
    protected $hidden = ['pivot'];
    /**
     * The filters that someone can use for the ProjectTag Entity
     * @var array
     */
    public static $filters = [
        'id', 'title'
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Projects');
    }


}
