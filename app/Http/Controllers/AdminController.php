<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Theme;
use App\Models\Issue;
use App\Models\Article;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin dashboard showing summary stats, etc.
     */
    public function index()
    {
        $userCount = User::count();
        $themeCount = Theme::count();
        $issueCount = Issue::count();
        $articleCount = Article::count();

        return view('admin.dashboard', compact('userCount', 'themeCount', 'issueCount', 'articleCount'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'role_id'               => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function manageUsers()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->blocked = !$user->blocked;
        $user->save();

        return back()->with('success', 'Le statut de blocage de l\'utilisateur a été mis à jour.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'L\'utilisateur a été supprimé.');
    }

    public function manageArticles()
    {
        $articles = Article::with('author')->paginate(10);
        return view('admin.articles', compact('articles'));
    }

    public function changeStatus($id)
    {
        $article = Article::findOrFail($id);
        $newStatus = $article->status === 'publie' ? 'retenu' : 'publie';
        $article->status = $newStatus;
        $article->save();

        return redirect()->route('admin.articles')->with('success', 'Statut de l\'article mis à jour.');
    }

    public function createArticle()
    {
        $themes = Theme::all();
        return view('admin.articles.create', compact('themes'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'theme_id' => 'required|exists:themes,id',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/articles', 'public');
        }

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->theme_id = $request->theme_id;
        $article->author_id = Auth::id();
        $article->status = $request->status;
        $article->image_path = $imagePath;
        $article->save();

        return redirect()->route('admin.articles')->with('success', 'Article créé avec succès.');
    }

    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        $themes = Theme::all();
        return view('admin.articles.edit', compact('article', 'themes'));
    }

    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'theme_id' => 'required|exists:themes,id',
            'status'   => 'required|string|in:refus,en_cours,retenu,publie',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $imagePath = $article->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('images/articles', 'public');
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->theme_id = $request->theme_id;
        $article->status = $request->status;
        $article->image_path = $imagePath;
        $article->save();

        return redirect()->route('admin.articles')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroyArticle($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('admin.articles')->with('success', 'Article supprimé avec succès.');
    }
}
