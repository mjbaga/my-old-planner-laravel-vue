<?php

use App\User;
use App\Title;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Title::create([
            'title' => 'Division Head',
            'slug' => 'division-head'
        ]);
        
        Title::create([
            'title' => 'Project Consultant',
            'slug' => 'project-consultant'
        ]);
        
        Title::create([
            'title' => 'UX Researcher',
            'slug' => 'ux-researcher'
        ]);
        
        Title::create([
            'title' => 'Data Analyst',
            'slug' => 'data-analyst'
        ]);
        
        Title::create([
            'title' => 'Designer',
            'slug' => 'designer'
        ]);
        
        Title::create([
            'title' => 'Front-end Developer',
            'slug' => 'front-end-developer'
        ]);
        
        Title::create([
            'title' => 'Back-end Developer',
            'slug' => 'back-end-developer'
        ]);
        
        User::create([
            'first_name' => 'Marvin',
            'last_name' => 'Baga',
            'slug' => 'marvin-baga',
            'email' => 'marvin.baga@sg.ey.com',
            'password' => Hash::make('1234aA'),
            'title_id' => 6,
            'active' => 1
        ]);
    }
}
