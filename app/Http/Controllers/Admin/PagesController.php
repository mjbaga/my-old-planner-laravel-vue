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
            $titles = Title::all();
            return view('admin.pages.resource-board', compact('titles'));
        }
        return redirect()->route('home');
    }

    /**
     * Display the resources list.
     *
     * @return \Illuminate\Http\Response
     */
    public function resources()
    {
        if(Auth::check()) {
            return view('admin.pages.settings.resources');
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

            return view('admin.pages.settings.titles', compact('titles'));
        }
        return redirect()->route('home');
    }

    /**
     * Display list of holidays.
     *
     * @return \Illuminate\Http\Response
     */
    public function holidays()
    {
        if(Auth::check()) {
            $titles = Title::all();

            return view('admin.pages.settings.titles', compact('titles'));
        }
        return redirect()->route('home');
    }
}
