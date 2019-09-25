<?php

namespace App\Http\Controllers\Admin;

use App\Title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TitleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = new Title([
            'title' => $request->get('title')
        ]);

        $title->save();

        return back()->with('success', 'Successfully added new title');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = Title::find($id);
        $title->delete();

        return back()->with('success', 'Successfully deleted title');
    }

    /**
     * Retrieve all titles through an API request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $titles = Title::orderBy('created_at', 'asc')->get();
        return response()->json($titles);
    }
}
