<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use function foo\func;

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
            $user->skills = $user->skills()->get();
            if ($user->status === 0) {
                $user->role = "Standard";
            } else {
                $user->role = "Administrateur";
            }
            // Send mail to each user = I test on my VM !
            // Mail::to($user->email)->send(new SendMailable($user));
        }

        $skills = Skill::select('id', 'name')->get();

        return view('user.index', ['users' => $users, 'skills' => $skills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->authorize('create', User::class);

        $data = $this->storeValidation();
        unset($data['c_password']);
        $data['name'] = $data['last_name'] . ' ' . $data['first_name'];
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('/users')->with('success', 'L\'utilisateur a bien été sauvegardé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $user->skills = $user->skills()->get();

        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $skills = $user->skills()->get();
        $available_skills = $user->availableSkills();

        return view('user.edit', ['user' => $user, 'skills' => $skills, 'available_skills' => $available_skills]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user)
    {
        $this->authorize('update', $user);

        $data = $this->updateValidation();

        $user['status'] = isset($data['status']) ? $data['status'] : 0;
        $user['name'] = $data['last_name'] . ' ' . $data['first_name'];
        $user->update($data);

        return redirect('/users');
    }

    /**
     * Add a user's skill
     */
    public function addSkill($id)
    {
        $this->authorize('update', User::find($id));

        $data = $this->addSkillsValidation();
        $data['user_id'] = $id;
        $data['level'] = 1;
        DB::table('skill_user')->insert($data);

        return redirect('/users');
    }

    /**
     * Update the user's skills
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateSkills($id)
    {
        $this->authorize('update', User::find($id));

        $data = $this->updateSkillsValidation();

        $user = User::find($id);
        $skills = $data['skills'];
        for ($i = 0; $i < sizeof($skills['id']); $i++) {
            $user->skills()->updateExistingPivot($skills['id'][$i], ['level' => $skills['level'][$i]]);
        }

        return redirect('/users');
    }

    /**
     * Remove a user's skill
     */
    public function destroySkill($id)
    {
        $this->authorize('delete', User::find($id));

        $data = $this->destroySkillsValidation();

        $user = User::find($id);
        $user->skills()->detach($data['skill_id']);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect('/users')->with('error', 'L\'utilisateur a bien été supprimé.');
    }

    public function search()
    {
        $data = $this->searchValidation();

        $users = User::join('skill_user as su', 'users.id', 'su.user_id')
            ->where([
                ['su.skill_id', $data['skill_id']],
                ['level', '>=', $data['level']]
            ])
            ->get();

        foreach ($users as $user) {
            $user->skills = $user->skills()->get();
            if ($user->status === 0) {
                $user->role = "Standard";
            } else {
                $user->role = "Administrateur";
            }
            // Send mail to each user = I test on my VM !
            // Mail::to($user->email)->send(new SendMailable($user));
        }

        $skills = Skill::select('id', 'name')->get();

        return view('user.index', ['users' => $users, 'skills' => $skills]);
    }

    private function storeValidation()
    {
        return request()->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users',
            'bio' => 'required|string',
            'password' => 'required|string',
            'c_password' => 'required|string|same:password'
        ]);
    }

    private function updateValidation()
    {
        return request()->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'status' => 'integer|between:0,1',
            'bio' => 'required|string'
        ]);
    }

    private function updateSkillsValidation()
    {
        return request()->validate([
            'skills.level.*' => 'required|integer|between:1,5',
            'skills.id.*' => 'required|integer'
        ]);
    }

    private function addSkillsValidation()
    {
        return request()->validate([
            'skill_id' => 'required|integer'
        ]);
    }

    private function destroySkillsValidation()
    {
        return request()->validate([
            'skill_id' => 'required|integer'
        ]);
    }

    private function searchValidation()
    {
        return request()->validate([
            'skill_id' => 'required|integer|exists:skills,id',
            'level' => 'required|integer|between:1,5'
        ]);
    }
}
