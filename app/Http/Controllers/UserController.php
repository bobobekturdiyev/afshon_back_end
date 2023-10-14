<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = User::orderByDesc('id')->get();

        return view('user.user', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'role' => 'required|string|max:255'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->password = $request->password;
		$user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with(['message' => "User create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('user.delete-user', ['id' => $id, 'model' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        return view('user.edit-user', ['model' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'role' => 'required|string|max:255'
        ]);

        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->password = $request->password;
		$user->role = $request->role;
        $user->update();

        return redirect()->route('user.index')->with(['message' => "User update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        
        $user->delete();

        return redirect()->route('user.index')->with(['message' => 'User delete successfully']);
    }
}
