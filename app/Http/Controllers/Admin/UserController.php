<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilter $filter)
    {
        $users = User::filter($filter)->where('id', '!=', Auth::user()->id)->orderByDesc('created_at')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);
        if(Auth::user()->role == 'moder' and $request->role == 'admin') {
            return redirect()->back();
        }
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role
        ]);
        return redirect()->route('users.index')->with('success', "Пользователь успешно зарегистрирован");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => ($request->email == $user->email ?  'email' : 'required|unique:users|email'),
        ]);


        if(Auth::user()->role == 'moder' and !empty($request->role)) {
            return redirect()->back();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            empty($request->password) ? : 'password' => Hash::make($request->password),
            empty($request->role) ? : 'role' => $request->role,
        ]);
        return redirect()->route('users.index')->with('success', "Пользователь успешно c ID $id успешно изменен");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', "Пользователь с ID $id успешно удален");
    }
}
