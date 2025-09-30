<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Univers;
use Illuminate\Http\Request;
use App\Http\Requests\UniversRequest;

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
        if(!Auth::check()){
            $liste = Univers::all();
            return view('univers', compact('liste'));
        }
        return view('edit', ['univers' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversRequest $request)
    {
            $donnes = $request->validated();

            $donnes['image'] = $request->file('image')->store('univers', 'public');
            $donnes['logo'] = $request->file('logo')->store('univers', 'public');
            $univers = Univers::create($donnes);


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
    public function update(UniversRequest $request, $id)
    {
        $univers = Univers::findOrFail($id);
        $donnes = $request->validated();

            if($request->hasFile('image')){
                $donnes['image'] = $request->file('image')->store('univers', 'public');
            }
            else{
                $donnes['image'] = $univers->image;
            }
            if($request->hasFile('logo')){
                $donnes['logo'] = $request->file('logo')->store('univers', 'public');
            }
            else{
                $donnes['logo'] = $univers->logo;
            }

        $univers->update([
            'name' => $donnes["name"],
            'description' => $donnes['description'],
            'image' => $donnes['image'],
            'logo' => $donnes['logo'],
            'couleur_principale' => $donnes['couleur_principale'],
            'couleur_secondaire' => $donnes['couleur_secondaire'],
        ]);

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $univers = Univers::findOrFail($id);
        $univers->delete();
        return redirect('/');
    }
}
