<?php

namespace App\Http\Controllers;

use App\Skill;
use App\User;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $skills = Skill::all();

        return view('skill.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->authorize('create', Skill::class);

        $data = $this->storeValidation();

        $image_name = strtolower($data['name']) . '.' . $data['logo']->extension();

        $data['logo']->move(public_path('skills_img'), $image_name);
        $data['logo'] = $image_name;

        $user = Skill::create($data);

        return redirect('/skills')->with('success', 'La compétence a bien été sauvegardé.');
    }

    /**
     * Display the specified resource.
     *
     * @param Skill $skill
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Skill $skill)
    {
        $skill->users = $skill->users()->get();

        foreach ($skill->users as $user) {
            $user->skills = $user->skills()->get();
        }

        return view('skill.show', ['skill' => $skill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Skill $skill
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Skill $skill)
    {
        $this->authorize('update', Skill::class);

        return view('skill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Skill $skill
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Skill $skill)
    {
        $this->authorize('update', Skill::class);

        $data = $this->updateValidation();

        $skill->update($data);

        return redirect('/skills');
    }

    public function updateLogo($id)
    {
        $this->authorize('update', Skill::class);

        $data = $this->updateLogoValidation();
        $skill = Skill::find($id);

        $image_name = strtolower($skill['name']) . '.' . $data['logo']->extension();

        $data['logo']->move(public_path('skills_img'), $image_name);
        $data['logo'] = $image_name;


        $skill->update($data);

        return redirect('/skills');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Skill $skill)
    {
        $this->authorize('delete', Skill::class);

        $skill->delete();

        return redirect('/skills')->with('error', 'La compétence a bien été supprimée.');
    }

    private function storeValidation()
    {
        return request()->validate([
            'name' => 'required|string|unique:skills',
            'description' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg'
        ]);
    }

    private function updateValidation()
    {
        return request()->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);
    }

    private function updateLogoValidation()
    {
        return request()->validate([
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg'
        ]);
    }
}
