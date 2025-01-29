<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Charger tous les articles avec leurs thèmes et auteurs
        $user = Auth::user();
        $articles = Article::with('theme')
        ->get()
        ->filter(function ($article) use ($user) {
            if ($article->status === 'publie') {
                return true;
            } elseif ($article->status === 'retenu') {
                if ($user) {
                    if ($user->role->name === 'editeur' || $user->id === $article->theme->responsable_id) {
                        return true;
                    } elseif ($user->role->name === 'abonne') {
                        return DB::table('theme_user')
                            ->where('user_id', $user->id)
                            ->where('theme_id', $article->theme->id)
                            ->exists();
                    }
                }
            } elseif ($article->status === 'en_cours') {
                if ($user && (
                    $user->id === $article->author_id ||
                    $user->role->name === 'editeur' ||
                    ($article->theme && $user->id === $article->theme->responsable_id)
                )) {
                    return true;
                }
            } elseif ($article->status === 'refus') {
                if ($user && $user->role->name === 'editeur') {
                    return true;
                }
            }
            return false;
        })
        ->take(3);
        $themes = Theme::all();

        return view('welcome', compact('articles' , 'themes'));
    }
    public function indexDashboard()
    {
        // Charger tous les articles avec leurs thèmes et auteurs
        $user = Auth::user();
        $articles = Article::with('theme')
        ->get()
        ->filter(function ($article) use ($user) {
            if ($article->status === 'publie') {
                return true;
            } elseif ($article->status === 'retenu') {
                if ($user) {
                    if ($user->role->name === 'editeur' || $user->id === $article->theme->responsable_id) {
                        return true;
                    } elseif ($user->role->name === 'abonne') {
                        return DB::table('theme_user')
                            ->where('user_id', $user->id)
                            ->where('theme_id', $article->theme->id)
                            ->exists();
                    }
                }
            } elseif ($article->status === 'en_cours') {
                if ($user && (
                    $user->id === $article->author_id ||
                    $user->role->name === 'editeur' ||
                    ($article->theme && $user->id === $article->theme->responsable_id)
                )) {
                    return true;
                }
            } elseif ($article->status === 'refus') {
                if ($user && $user->role->name === 'editeur') {
                    return true;
                }
            }
            return false;
        })
        ->take(3);
        $themes = Theme::all();

        return view('dashboard', compact('articles' , 'themes'));
    }


    public function manageHistory(Request $request)
    {
        $user =User::find(Auth::id());

        // Retrieve filters
        $themeId = $request->input('theme_id');
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query to fetch browsing history
        $query = $user->histories()->with(['article.theme']);

        // Apply filters
        if ($themeId) {
            $query->whereHas('article.theme', function ($q) use ($themeId) {
                $q->where('id', $themeId);
            });
        }
        if ($search) {
            $query->whereHas('article', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $histories = $query->latest()->paginate(10);
        $themes = Theme::all(); // Get all themes for the dropdown filter

        return view('history.manage', compact('histories', 'themes'));
    }


}
