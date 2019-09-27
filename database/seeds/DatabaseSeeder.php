<?php

use App\User;
use App\Title;
use App\Project;
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

        Project::create([
            'type' => 'engagement',
            'engagement_code' => 21030063,
            'project_name' => 'MSF Divorce Portal - Research + Prototype',
            'client_name' => 'Ministry of Social and Family Development',
            'abbreviation' => 'MSF',
            'status' => 'engagement'
        ]);

        Project::create([
            'type' => 'engagement',
            'engagement_code' => 21036456,
            'project_name' => 'Infra Asia project pipeline templates and form',
            'client_name' => 'International Enterprise Singapore',
            'abbreviation' => 'IES',
            'status' => 'engagement'
        ]);

        Project::create([
            'type' => 'authorised-project',
            'engagement_code' => 22000001,
            'project_name' => 'SG Mercury Training',
            'client_name' => 'EY Digital',
            'abbreviation' => 'MT',
            'status' => ''
        ]);

        Project::create([
            'type' => 'authorised-project',
            'engagement_code' => 22000002,
            'project_name' => 'Walk for Rice',
            'client_name' => 'EY Digital',
            'abbreviation' => 'MT',
            'status' => ''
        ]);

        Project::create([
            'type' => 'authorised-project',
            'engagement_code' => 22000003,
            'project_name' => 'New Business Development',
            'client_name' => 'EY Digital',
            'abbreviation' => 'MT',
            'status' => ''
        ]);
    }
}
