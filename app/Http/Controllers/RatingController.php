<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store a new rating.
     */
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $article = Article::findOrFail($articleId);

        // Check if the user already rated this article
        $existingRating = Rating::where('article_id', $articleId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            return redirect()->back()->withErrors('Vous avez déjà noté cet article.');
        }

        // Create a new rating
        Rating::create([
            'user_id' => Auth::id(),
            'article_id' => $articleId,
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Note enregistrée avec succès.');
    }

    /**
     * Update an existing rating.
     */
    public function update(Request $request, $articleId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $article = Article::findOrFail($articleId);

        // Update the existing rating
        $rating = Rating::where('article_id', $articleId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $rating->rating = $request->input('rating');
        $rating->save();

        return redirect()->back()->with('success', 'Note modifiée avec succès.');
    }

    /**
     * Delete a rating.
     */
    public function destroy($articleId)
    {
        $article = Article::findOrFail($articleId);

        // Delete the rating
        $rating = Rating::where('article_id', $articleId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $rating->delete();

        return redirect()->back()->with('success', 'Note supprimée avec succès.');
    }

    /**
     * Get the average rating of an article.
     */
    public static function getAverageRating($articleId)
    {
        $rating = Rating::where('article_id', $articleId)->avg('rating');
        return $rating;
    }
}
