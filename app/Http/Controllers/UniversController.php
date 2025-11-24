<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversRequest;
use App\Mail\InfoMail;
use App\Models\Univers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UniversController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [new Middleware('status', ['destroy'])];
    }

    public function index(): view
    {
        $liste = Univers::all();

        return view('univers', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        if (! Auth::check()) {
            $liste = Univers::all();

            return view('univers', compact('liste'));
        }

        return view('edit', ['univers' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversRequest $request): RedirectResponse
    {
        $donnes = $request->validated();

        $donnes['image'] = $request->file('image')->store('univers', 'public');
        $donnes['logo'] = $request->file('logo')->store('univers', 'public');
        $univers = Univers::create($donnes);

        return $this->sendMail();
    }

    /**
     * Display the specified resource.
     */
    public function show(univers $univers): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): view
    {
        $univers = Univers::findOrfail($id);

        return view('edit', compact('univers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversRequest $request, int $id): RedirectResponse
    {
        $univers = Univers::findOrFail($id);
        $donnes = $request->validated();

        if ($request->hasFile('image')) {
            $donnes['image'] = $request->file('image')->store('univers', 'public');
        } else {
            $donnes['image'] = $univers->image;
        }
        if ($request->hasFile('logo')) {
            $donnes['logo'] = $request->file('logo')->store('univers', 'public');
        } else {
            $donnes['logo'] = $univers->logo;
        }

        $univers->update([
            'name' => $donnes['name'],
            'description' => $donnes['description'],
            'image' => $donnes['image'],
            'logo' => $donnes['logo'],
            'couleur_principale' => $donnes['couleur_principale'],
            'couleur_secondaire' => $donnes['couleur_secondaire'],
        ]);

        return $this->sendMail();
    }

    public function sendMail(): RedirectResponse
    {
        $user = (object) ['name' => 'Titouan Lefort', 'email' => 'titouan@universworld.com'];

        Mail::to($user->email)->send(new InfoMail($user));

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $univers = Univers::findOrFail($id);
        $univers->delete();

        return redirect('/');
    }
}
