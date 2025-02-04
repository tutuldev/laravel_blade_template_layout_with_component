<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        // $users=User::all();
        $users=User::simplePaginate(4);
        return view("home",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adduser');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|alpha',
        ]);
        // return $request;
        User::create([
            'name' => $request->username,
            'email' => $request->useremail,
            'age' => $request->userage,
            'city' => $request->usercity,
        ]);

        return redirect()->route('user.index')
                        ->with('status','New User Added Successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        // return $users;
        return view('viewuser',compact('users'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)//you can use 'string $id'
    {
        $users = User::findOrFail($user->id);
        return view('updateuser',compact('users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) //you can use 'User $user'
    {
        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|alpha',
        ]);

        // update method 2 mass update
        $user =User::where('id',$id)
                        ->update([
                            'name' => $request->username,
                            'email' => $request->useremail,
                            'age' => $request->userage,
                            'city' => $request->usercity,
                        ]);

        return redirect()->route('user.index')
                        ->with('status','User Data Updated Successfully.');
    }

    public function destroy(string $id)
    {

        // common and good method
        $users=User::find($id);
        $users->delete();
        return redirect()->route('user.index')
        ->with('status','User Data Deleted Successfully.');
    }
}
