<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()) {
            $titles = Title::all();
            return view('admin.users.create', compact('titles'));
        }
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $request->validated();

        $user = new User([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'title_id' => $request->get('title_id'),
            'active' => 0
        ]);

        $user->save();

        $photo = $request->file('image');

        if($photo) {
            $user->savePhoto($photo);
        }

        return redirect('/resources')->with('success', 'A new resource has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug = null)
    {
        $titles = Title::all();
        $user = User::where('slug', $slug)->first();
        return view('admin.users.edit', compact('user', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->title_id = $request->get('title_id');
        $user->save();

        $photo = $request->file('image');

        if($photo) {
            $user->savePhoto($photo);
        }

        return redirect()->route('user.edit', $user->slug)->with('success', 'Successfully updated details.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'Successfully deleted user');
    }

    /**
     * Retrieve all titles through an API request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResources(Request $request)
    {
        // $users = User::where('active', 1)->with('title')->orderBy('created_at', 'asc')->get();
        $users = User::with('title')->orderBy('created_at', 'asc')->get();

        return response()->json($users);
    }
}
