<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\ThemeUser;

class ThemeController extends Controller
{
    /**
     * List all themes.
     */
    public function index()
    {
        $themes = Theme::all();
        return view('themes.index', compact('themes'));
    }

    /**
     * Show a single theme details (e.g., list articles, stats, etc.).
     */
    public function show($id)
    {
        $theme = Theme::with('articles')->findOrFail($id);
        return view('themes.show', compact('theme'));
    }

    /**
     * Subscribe to a theme (for an abonné).
     */
    public function subscribe($id)
    {
        $theme = Theme::findOrFail($id);

        // Check if the user is already subscribed
        if (!auth()->user()->theme->contains($theme->id)) {
            $user = User::findOrFail(auth()->user()->id);
            $user->theme()->attach($theme->id);
            return back()->with('success', 'You have subscribed to the theme!');
        }

        return back()->with('info', 'You are already subscribed to this theme.');
    }

    public function unsubscribe($id)
    {
        $theme = Theme::findOrFail($id);

        // Detach the theme if the user is subscribed
        if (auth()->user()->theme->contains($theme->id)) {
            $user = User::findOrFail(auth()->user()->id);
            $user->theme()->detach($theme->id);
            return back()->with('success', 'You have unsubscribed from the theme.');
        }

        return back()->with('info', 'You are not subscribed to this theme.');
    }
    /**
     * If you have a form to create a new theme (for responsible or editor).
     */
    public function create()
    {
        return view('themes.create');
    }

    /**
     * Store a newly created theme.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $theme = new Theme();
        $theme->name = $request->name;
        $theme->description = $request->description;
        $theme->responsable_id = $request->responsable_id;
        $theme->save();

        return redirect()->route('themes.index')->with('success', 'Theme created successfully!');
    }


    public function edit($id)
    {
        $theme = Theme::findOrFail($id);
        $users = User::whereIn('role_id', [Role::where('name', 'editeur')->first()->id, Role::where('name', 'responsable')->first()->id])->get();
        return view('themes.edit', compact('theme', 'users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $theme = Theme::findOrFail($id);
        $theme->name = $request->name;
        $theme->description = $request->description;
        $theme->responsable_id = $request->responsable_id;
        $theme->save();

        return redirect()->route('themes.index')->with('success', 'Theme updated successfully!');
    }

    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        $theme->delete();
        return redirect()->route('themes.index')->with('success', 'Theme deleted successfully!');
    }


}
