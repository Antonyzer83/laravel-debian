<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->status === 0) {
                $user->role = "Standard";
            } else {
                $user->role = "Administrateur";
            }
        }

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->storeValidation();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return redirect('/users')->with('success', 'L\'utilisateur a bien été sauvegardé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $data = $this->updateValidation();

        $user = User::find($id);
        $user['status'] = $data['status'];
        $user->update($data);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('error', 'L\'utilisateur a bien été supprimé.');
    }

    private function storeValidation() {
        return request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|unique:users',
            'bio' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
    }

    private function updateValidation() {
        return request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'status' => 'integer|between:0,1',
            'bio' => 'required'
        ]);
    }
}
