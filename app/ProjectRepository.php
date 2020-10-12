<?php
/**
 * Created by PhpStorm.
 * User: Sin
 * Date: 12/10/2020
 * Time: 9:17 μμ
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProjectRepository extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
