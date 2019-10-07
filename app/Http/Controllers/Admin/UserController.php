<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserPostRequest;

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

        $image_path = public_path('/images/users');

        $photo = $request->file('image');
        $name = $user->slug;
        $image_name = $name . '.' . str_random(5) . '.' . $photo->getClientOriginalExtension();
        $save_name = $image_path . '/' . $image_name;

        if (!file_exists($image_path)) {
            mkdir($image_path, 666, true);
        }

        Image::make($photo)
            ->resize(500, null, function($constraints) {
                $constraints->aspectRatio();
            })
            ->save($save_name);

        $user->image = $image_name;
        $user->save();

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
    public function update(Request $request, $id)
    {
        //
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
