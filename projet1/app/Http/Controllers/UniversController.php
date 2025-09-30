<?php

namespace App\Http\Controllers;

use App\Models\Univers;
use Illuminate\Http\Request;

class UniversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liste = Univers::all();
        return view('univers', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'logo' => 'required',
            'couleur_principale' => 'required',
            'couleur_secondaire' => 'required',
        ]);




            $validate['image'] = $request->file('image')->store('univers', 'public');
            $validate['logo'] = $request->file('logo')->store('univers', 'public');

            $univers = Univers::create($validate);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(univers $univers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $univers = Univers::findOrfail($id);
        return view('edit', compact('univers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $univers = Univers::findOrFail($id);
          $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'couleur_principale' => 'required',
            'couleur_secondaire' => 'required',
        ]);


            if($request->hasFile('image')){
                $validate['image'] = $request->file('image')->store('univers', 'public');
            }
            else{
                $validate['image'] = $univers->image;
            }
            if($request->hasFile('logo')){
                $validate['logo'] = $request->file('logo')->store('univers', 'public');
            }
            else{
                $validate['logo'] = $univers->logo;
            }

        $univers->update([
            'name' => $validate["name"],
            'description' => $validate['description'],
            'image' => $validate['image'],
            'logo' => $validate['logo'],
            'couleur_principale' => $validate['couleur_principale'],
            'couleur_secondaire' => $validate['couleur_secondaire'],
        ]);

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $univers = Univers::findOrFail($id);
        $univers->delete();
        return redirect('/');
    }
}
