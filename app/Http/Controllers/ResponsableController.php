<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ThemeUser;
use App\Models\Chat;

class ResponsableController extends Controller
{
    /**
     * Display the dashboard for the responsable.
     */
    public function index(Request $request)
    {
        $themes = Theme::where('responsable_id', Auth::id())->with(['users', 'articles'])->get();

        if ($themes->isEmpty()) {
            return redirect()->route('responsable.no-theme')->with('error', 'Vous n\'êtes responsable d\'aucun thème.');
        }

        $selectedThemeId = $request->input('theme_id');
        $theme = $themes->firstWhere('id', $selectedThemeId) ?? $themes->first();

        $subscribersCount = $theme->users->count();
        $articlesCount = $theme->articles->count();

        return view('responsable.dashboard', compact('themes', 'theme', 'subscribersCount', 'articlesCount'));
    }



    /**
     * Manage subscriptions for the theme.
     */
    public function subscriptions(Request $request)
    {
        $themes = Theme::where('responsable_id', Auth::id())->with('users')->get();

        if ($themes->isEmpty()) {
            return redirect()->route('responsable.no-theme')->with('error', 'Vous n\'êtes responsable d\'aucun thème.');
        }

        $selectedThemeId = $request->input('theme_id');
        $theme = $themes->firstWhere('id', $selectedThemeId) ?? $themes->first();

        $subscribers = $theme->users;
        $theme_user = ThemeUser::where('theme_id', $selectedThemeId)->where('user_id', Auth::id())->first();


        return view('responsable.subscriptions', compact('themes', 'theme', 'subscribers' , 'theme_user'));
    }

    public function detachSubscription($user_id, Request $request)
    {
        $themeId = $request->input('theme_id');
        $theme = Theme::where('id', $themeId)->where('responsable_id', Auth::id())->firstOrFail();

        $theme->users()->detach($user_id);

        return redirect()->route('responsable.subscriptions', ['theme_id' => $themeId])
                         ->with('success', 'Abonnement supprimé avec succès.');
    }
    public function toggleBlockSubscription($user_id, Request $request)
    {
        $themeId = $request->input('theme_id');

        // Verify that the theme exists and belongs to the current responsable
        $theme = Theme::where('id', $themeId)
                      ->where('responsable_id', Auth::id())
                      ->firstOrFail();

        // Fetch the current `is_blocked` status directly from the `theme_user` table
        $themeUser = DB::table('theme_user')
                       ->where('user_id', $user_id)
                       ->where('theme_id', $themeId)
                       ->first();

        if (!$themeUser) {
            return redirect()->route('responsable.subscriptions', ['theme_id' => $themeId])
                             ->withErrors('Abonné non trouvé pour ce thème.');
        }

        // Toggle the `is_blocked` value
        $newStatus = !$themeUser->is_blocked;

        DB::table('theme_user')
            ->where('user_id', $user_id)
            ->where('theme_id', $themeId)
            ->update(['is_blocked' => $newStatus]);

        return redirect()->route('responsable.subscriptions', ['theme_id' => $themeId])
                         ->with('success', $newStatus ? 'Abonné bloqué avec succès.' : 'Abonné débloqué avec succès.');
    }




    /**
     * Moderate articles for the theme.
     */
    public function moderateArticles(Request $request)
    {
        $themeId = $request->input('theme_id');

        // Ensure the theme belongs to the logged-in responsable
        $theme = Theme::where('id', $themeId)
                      ->where('responsable_id', Auth::id())
                      ->with('articles')
                      ->firstOrFail();

        // Get all articles associated with the theme
        $articles = $theme->articles()->paginate(10); 

        return view('responsable.moderate_articles', compact('theme', 'articles'));
    }

    public function moderateArticleStatus(Request $request, $articleId)
    {
        $request->validate([
            'status' => 'required|in:publie,retenu,en_cours,refus',
        ]);

        $article = Article::findOrFail($articleId);

        // Check if the article belongs to the theme managed by the responsable
        if ($article->theme->responsable_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet article.');
        }

        // Update the article's status
        $article->status = $request->input('status');
        $article->save();

        return back()->with('success', 'Le statut de l\'article a été mis à jour.');
    }

    /**
     * Moderate conversations for the theme.
     */

     public function moderateThemeConversations(Request $request)
     {
         $themeId = $request->input('theme_id');
         $theme = Theme::where('id', $themeId)->with('articles')->firstOrFail();

         // Ensure the authenticated responsable has access to this theme
         if ($theme->responsable_id !== Auth::id()) {
             abort(403, 'Accès refusé.');
         }

         // Retrieve all chat messages for articles in this theme
         $chats = Chat::whereIn('article_id', $theme->articles->pluck('id'))
                      ->with(['user', 'article'])
                      ->latest()
                      ->paginate(10);

         return view('responsable.conversations', compact('theme', 'chats'));
     }


     public function deleteConversationMessage($id)
     {
         $chat = Chat::findOrFail($id);

         // Ensure the chat belongs to an article in a theme managed by the responsable
         $themeIds = Theme::where('responsable_id', Auth::id())->pluck('id');
         $article = Article::where('id', $chat->article_id)->whereIn('theme_id', $themeIds)->firstOrFail();

         // Delete the chat message
         $chat->delete();

         return redirect()->back()->with('success', 'Message supprimé avec succès.');
     }




}
