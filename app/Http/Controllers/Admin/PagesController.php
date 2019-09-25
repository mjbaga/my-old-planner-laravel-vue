<?php

namespace App\Http\Controllers\Admin;

use App\Title;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Displays the resourcing board page.
     *
     * @return \Illuminate\Http\Response
     */
    public function board()
    {
        if(Auth::check()) {
            return view('admin.pages.resource-board');
        }
        return redirect()->route('home');
    }

    /**
     * Display a settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        if(Auth::check()) {
            return view('admin.pages.settings');
        }
        return redirect()->route('home');
    }

    /**
     * Display a authorised projects page.
     *
     * @return \Illuminate\Http\Response
     */
    public function authProjects()
    {
        if(Auth::check()) {
            return view('admin.pages.auth-projects');
        }
        return redirect()->route('home');
    }

    /**
     * Display a authorised projects page.
     *
     * @return \Illuminate\Http\Response
     */
    public function titles()
    {
        if(Auth::check()) {
            $titles = Title::all();

            return view('admin.pages.titles', compact('titles'));
        }
        return redirect()->route('home');
    }
}
