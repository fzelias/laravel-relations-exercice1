<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        $users = User::all();
        return view("back.users.all", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view("back.users.create", compact("roles"));
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
            "prenom" => "required|max:255",
            "nom" => "required|max:255",
            "age" => "required|integer",
            "email" => "required",
            "mdp" => "required",
            "ddn" => "required|date",
            "genre" => "required",
            "role" => "required",
        ]);

        $user = new User;

        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->age = $request->age;
        $user->email = $request->email;
        $user->mdp = Hash::make($request->mdp);
        $user->ddn = $request->ddn;
        $user->genre = $request->genre;
        $user->role_id = $request->role;

        $user->save();
        return redirect()->route("users.index")->with("success", "User has been created !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view("back.users.edit", compact("roles", "user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "prenom" => "required|max:255",
            "nom" => "required|max:255",
            "age" => "required|integer",
            "email" => "required",
            "mdp" => "required",
            "ddn" => "required|date",
            "genre" => "required",
            "role" => "required",
        ]);

        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->age = $request->age;
        $user->email = $request->email;
        if ($request->mdp !== $user->mdp) {
            $user->mdp = Hash::make($request->mdp);
        }
        $user->ddn = $request->ddn;
        $user->genre = $request->genre;
        $user->role_id = $request->role;

        $user->save();
        return redirect()->route("users.index")->with("success", "User has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index")->with("success", "User has been deleted !");
    }

    public function favori($id)
    {
        $user = User::find($id);
        if ($user->favori) {
            $user->favori = false;
        } else {
            $user->favori = true;
        }
        $user->save();
        return redirect()->route("users.index")->with("success", "User has been updated !");
    }
}
