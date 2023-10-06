<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = User::paginate();
            return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('dashboard.users.create' , compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|string|email|max:255|unique:users,email',
            //     'password' => 'nullable|string|min:8|confirmed',
            //     'role' => 'required|in:admin,writer,user',
            //     'image' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            // ]);

            $request_data = $request->except(['password', 'image']);

            $request_data['password'] = Hash::make($request->password);

            if ($request->image) {
                $image = $request->file('image');
                $path = $image->move(public_path('uploads/users'), $image->getClientOriginalName());
                $request_data['image'] = $path;
            }

            $user = User::create($request_data);

            toastr()->success('successfully created');

            return redirect()->route('dashboard.users.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        //edit user
        return view('dashboard.users.edit', compact('user'));
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

        //update
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        //     'password' => 'nullable|string|min:8|confirmed',
        //     'role' => 'required|in:admin,writer,user',
        //     'image' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
        // ]);

        $request_data = $request->except(['password']);

        if ($request->password) {
            $request_data['password'] = Hash::make($request->password);
        }


        $user = User::findOrFail($id);

        $user->update($request_data);

        toastr()->success('successfully updated');

        return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {


        $user->delete();

        toastr()->success('successfully deleted');

        return redirect()->route('dashboard.users.index');

    }
}
