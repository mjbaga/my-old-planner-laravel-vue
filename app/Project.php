<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasSlug;

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['client_name', 'engagement_name'])
            ->saveSlugsTo('slug');
    }
}
