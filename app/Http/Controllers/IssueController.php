<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Article;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Liste tous les numéros.
     */
    public function index()
    {
        $issues = Issue::orderBy('created_at', 'desc')->get();
        return view('issues.index', compact('issues'));
    }

    /**
     * Affiche un numéro avec ses articles associés.
     */
    public function show($id)
    {
        $issue = Issue::with('articles')->findOrFail($id);
        return view('issues.show', compact('issue'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau numéro (réservé aux éditeurs).
     */
    public function create()
    {
        $articles = Article::all();
        return view('issues.create', compact('articles'));
    }


    /**
     * Stocke un nouveau numéro et attache les articles sélectionnés.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'article_ids' => 'nullable|array',
            'article_ids.*' => 'exists:articles,id',
        ]);

        $issue = new Issue();
        $issue->title = $request->title;
        $issue->is_public = false;
        $issue->status = 'draft';
        $issue->save();

        // Associe les articles sélectionnés au numéro
        if ($request->filled('article_ids')) {
            $issue->articles()->sync($request->article_ids);
        }

        return redirect()->route('issues.index')->with('success', 'Issue created successfully!');
    }

    /**
     * Affiche le formulaire d'édition d'un numéro.
     */
    public function edit($id)
    {
        $issue = Issue::with('articles')->findOrFail($id);
        // Récupère tous les articles pour permettre la sélection lors de l'édition
        $articles = Article::all();
        return view('issues.edit', compact('issue', 'articles'));
    }

    /**
     * Met à jour un numéro existant et synchronise les articles associés.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'status'      => 'required|string|in:draft,published,archived',
            'is_public'   => 'nullable',
            'article_ids' => 'nullable|array',
            'article_ids.*' => 'exists:articles,id',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->title = $request->title;
        $issue->status = $request->status;
        $issue->is_public = $request->has('is_public');
        $issue->save();

        // Synchronise les articles associés au numéro
        if ($request->filled('article_ids')) {
            $issue->articles()->sync($request->article_ids);
        } else {
            // Si aucun article n'est fourni, détache tous les articles
            $issue->articles()->detach();
        }

        return redirect()->route('issues.show', $issue->id)
                         ->with('success', 'Issue updated successfully!');
    }

    /**
     * Publie ou met à jour le statut d'un numéro.
     */
    public function publish($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->status = 'published';
        $issue->is_public = true;
        $issue->save();

        return redirect()->route('issues.show', $issue->id)
                         ->with('success', 'Issue published successfully!');
    }

    /**
     * Attache des articles à un numéro sans supprimer les existants.
     */
    public function attachArticles(Request $request, $id)
    {
        $request->validate([
            'article_ids' => 'required|array',
            'article_ids.*' => 'exists:articles,id',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->articles()->syncWithoutDetaching($request->article_ids);

        return redirect()->route('issues.show', $id)
                         ->with('success', 'Articles attached to issue!');
    }

    /**
     * Détache un article d'un numéro.
     */
    public function detachArticle($issueId, $articleId)
    {
        $issue = Issue::findOrFail($issueId);
        $issue->articles()->detach($articleId);

        return back()->with('success', 'Article detached from issue.');
    }

    /**
     * Supprime un numéro.
     */
    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'Issue deleted successfully!');
    }
}
