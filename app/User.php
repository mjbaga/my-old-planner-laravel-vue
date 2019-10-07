<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\Facades\Image;
class User extends Authenticatable
{
    use HasSlug;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public static function getSavePath()
    {
        return public_path('/images/users');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }
    
    /**
     * Set projects relationship
     *
     * @return void
     */
    public function projects()
    {
        $this->belongsToMany('App\Project')
                ->using('App\UserProjects')
                ->withPivot([
                    'dateFrom',
                    'dateTo',
                    'remarks'
                ])
                ->withTimestamps();
    }

    /**
     * Set title relationship
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function savePhoto($photo)
    {
        $name = $this->slug;
        $image_name = $name . '.' . str_random(5) . '.' . $photo->getClientOriginalExtension();
        $save_name = self::getSavePath() . '/' . $image_name;

        if (!file_exists(self::getSavePath())) {
            mkdir(self::getSavePath(), 666, true);
        }

        Image::make($photo)
            ->resize(500, null, function($constraints) {
                $constraints->aspectRatio();
            })
            ->save($save_name);

        $this->image = $image_name;
        $this->save();
    }
}
