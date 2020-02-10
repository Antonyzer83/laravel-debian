<?php

namespace App\Http\Controllers;

use App\Skill;
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
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $skill = Skill::find($id);

        return view('skill.show', ['skill' => $skill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $skill = Skill::find($id);

        return view('skill.edit', compact('skill'));
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
        $this->authorize('update', Skill::class);

        $data = $this->updateValidation();

        $skill = Skill::find($id);
        $skill->update($data);

        return redirect('/skills');
    }

    public function updateLogo($id)
    {
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
    public function destroy($id)
    {
        $this->authorize('delete', Skill::class);

        $skill = Skill::find($id);
        $skill->delete();

        return redirect('/skills')->with('error', 'La compétence a bien été supprimée.');
    }

    private function storeValidation()
    {
        return request()->validate([
            'name' => 'required|unique:skills',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg'
        ]);
    }

    private function updateValidation()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
    }

    private function updateLogoValidation()
    {
        return request()->validate([
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg'
        ]);
    }
}
