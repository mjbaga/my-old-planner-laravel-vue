<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guarded = ['id'];

    /**
     * Define relationship with projects
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany('App\Users')
                    ->using('App\UserProjects')
                    ->withPivot([
                        'dateFrom',
                        'dateTo',
                        'remarks'
                    ])
                    ->withTimestamps();
    }
}
