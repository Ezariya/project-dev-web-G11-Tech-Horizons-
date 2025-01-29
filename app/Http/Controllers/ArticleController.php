<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RatingController;

class ArticleController extends Controller
{
    /**
     * Display a list of articles.
     */
    public function index()
    {
        // Fetch articles with related themes and authors, 4 per page
        $articles = Article::with(['theme', 'author'])
            ->orderBy('created_at', 'desc')
            ->paginate(9); // Fetch 4 articles per page

        return view('articles.index', compact('articles'));
    }


    /**
     * Show a single article details.
     */
    public function show($id)
    {
        $article = Article::with(['theme', 'author'])->findOrFail($id);

        // Get the average rating for the article
        $ratingController = new RatingController();
        $moyenne = $ratingController->getAverageRating($id);

        // Check if the user is authenticated
        $userRating = null;
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // Save the article visit in history every time the article is opened
            $user->histories()->create(['article_id' => $article->id]);

            // Get the user's rating for this article, if any
            $userRating = $user->ratings()->where('article_id', $article->id)->first();
        }

        // Retrieve all chat messages related to the article
        $chats = Chat::where('article_id', $article->id)
            ->with('user')
            ->orderBy('created_at', 'desc') // Fetch the latest messages first
            ->paginate(10); // Load 10 messages per request

        return view('articles.show', compact('article', 'moyenne', 'userRating', 'chats'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        // Only allowed for 'abonne' or above
        $themes = Theme::all();
        return view('articles.create', compact('themes'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'theme_id' => 'required|exists:themes,id',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
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
        $article->status = 'en_cours';
        $article->image_path = $imagePath; // Save image path
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article proposed successfully!');
    }

    /**
     * Edit an existing article (for demonstration, might be restricted).
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);


        $themes = Theme::all();
        return view('articles.edit', compact('article', 'themes'));
    }

    /**
     * Update the article in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'theme_id' => 'required|exists:themes,id',
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
        $article->image_path = $imagePath;
        $article->save();

        // Redirect to the edit page with a success message
        return redirect()->route('articles.edit', $article->id)
                         ->with('success', 'Article updated successfully!');
    }


    /**
     * Delete an article (also might be restricted).
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Check permission
        if ($article->author_id !== Auth::id()) {
            return redirect()->route('articles.index')->withErrors('Not authorized to delete this article.');
        }

        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path); // Delete associated image
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:refus,en_cours,retenu,publie',
        ]);

        $article = Article::findOrFail($id);
        $article->status = $request->status;
        $article->save();

        return redirect()->back()->with('success', 'Le statut de l\'article a été mis à jour avec succès.');
    }

    public function addComment(Request $request, $articleId)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $article = Article::findOrFail($articleId);

        $article->chats()->create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
