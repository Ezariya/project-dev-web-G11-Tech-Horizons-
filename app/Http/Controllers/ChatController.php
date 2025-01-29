<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display all comments for an article.
     */
    public function index($articleId)
    {
        $article = Article::with('chats.user')->findOrFail($articleId);

        return view('chats.index', compact('article'));
    }

    /**
     * Add a new comment to an article.
     */
    public function store(Request $request, $article_id)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        Chat::create([
            'user_id' => Auth::id(),
            'article_id' => $article_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message envoyé avec succès.');
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);

        if (auth()->user()->role->name !== 'editeur' && auth()->id() !== $chat->article->theme->responsable_id) {
            abort(403, 'Action non autorisée.');
        }

        $chat->delete();

        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }
    public function loadChats(Request $request)
    {
        $articleId = $request->input('article_id');
        $chats = Chat::where('article_id', $articleId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $html = view('partials.chat_messages', compact('chats'))->render();

        return response()->json(['html' => $html]);
    }


    /**
     * Moderate a comment (e.g., block/unblock or approve/reject).
     */
    public function moderate($id, Request $request)
    {
        $chat = Chat::findOrFail($id);

        // Authorization check
        if (Auth::user()->role->name !== 'editeur' && Auth::user()->role->name !== 'responsable') {
            abort(403, 'Action non autorisée.');
        }

        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $chat->is_approved = $request->input('is_approved');
        $chat->save();

        return back()->with('success', 'Commentaire modéré avec succès.');
    }
}
