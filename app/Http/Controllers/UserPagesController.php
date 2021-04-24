<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPagesController extends Controller
{
    // User List Page
    public function index()
    {
        // $breadcrumbs = [
        //     ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "User List"],
        // ];
        // return view('/pages/app-user-list', [
        //     'breadcrumbs' => $breadcrumbs,
        // ]);
        $users = User::all();

        return view('/pages/app-user-list', compact('users'));
    }

    // User View Page
    public function show($id)
    {
        $user = User::find($id);
        return view('/pages/app-user-view', compact('user'));
    }

    // User Edit Page
    public function edit($id)
    {
        $user = User::find($id);
        return view('/pages/app-user-edit', compact('user'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "User Create"],
        ];
        return view('/pages/app-user-create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(Request $request)
    {
        $user = new User([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'level' => (int) $request->get('level'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->save();
        return redirect('/users')->with('success', 'User saved!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->user_name = $request->get('user_name');
        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }

}
