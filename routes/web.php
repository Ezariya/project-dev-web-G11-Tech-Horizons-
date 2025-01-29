<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResponsableController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici se trouvent les routes web de votre application.
|
*/

// Page d'accueil publique
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes publiques pour les articles : index et show
Route::resource('articles', ArticleController::class)->only(['index','show']);

// Routes publiques pour les thèmes : consultation
Route::resource('themes', ThemeController::class)->only(['index','show']);

// Routes publiques pour les numéros publics : consultation
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/{issue}', [IssueController::class, 'show'])->name('issues.show');

// Les routes d'authentification (login, register, etc.) sont gérées par Breeze via auth.php

// Tableau de bord accessible aux utilisateurs authentifiés vérifiés
Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->middleware(['auth', 'check.blocked', 'verified'])->name('dashboard');


// Groupes de routes nécessitant une authentification
Route::middleware(['auth', 'check.blocked'])->group(function () {
    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/history', [HomeController::class, 'manageHistory'])->name('history.manage');


    // Gestion des articles pour les actions autres que index/show
    Route::resource('articles', ArticleController::class)->except(['index','show']);
    Route::get('/articles1/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::patch('/articles1/{id}/change-status', [ArticleController::class, 'updateStatus'])->name('articles.updateStatus');


    // Pour les numéros, exclure index et show (déjà publics)
   // Création et stockage d'un nouveau numéro
   Route::get('/issues1/create', [IssueController::class, 'create'])->name('issues.create');
   Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

   // Édition et mise à jour d'un numéro existant
   Route::get('/issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');
   Route::put('/issues/{issue}', [IssueController::class, 'update'])->name('issues.update');

   // Action de publication
   Route::post('/issues/{issue}/publish', [IssueController::class, 'publish'])->name('issues.publish');

   // Attacher des articles à un numéro
   Route::post('/issues/{issue}/attach-articles', [IssueController::class, 'attachArticles'])->name('issues.attach.articles');

   // Détacher un article d'un numéro
   Route::delete('/issues/{issue}/detach-article/{article}', [IssueController::class, 'detachArticle'])->name('issues.detach.article');

    // Suppression d'un numéro
    Route::delete('/issues/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');
    // Pour les thèmes, exclure index et show (déjà publics)
    Route::resource('themes', ThemeController::class)
         ->except(['index','show']);
    Route::get('themes1/create', [ThemeController::class, 'create'])->name('themes.create');
    Route::post('/themes/{theme}/subscribe', [ThemeController::class, 'subscribe'])->name('themes.subscribe');
    Route::post('/themes/{theme}/unsubscribe', [ThemeController::class, 'unsubscribe'])->name('themes.unsubscribe');


    Route::post('ratings/{article}', [RatingController::class, 'store'])->name('ratings.store');
    Route::patch('ratings/{article}', [RatingController::class, 'update'])->name('ratings.update');
    Route::delete('ratings/{article}', [RatingController::class, 'destroy'])->name('ratings.destroy');


    // Système de chat/commentaires
    Route::post('/chats/{article_id}/store', [ChatController::class, 'store'])->name('chats.store');
    Route::delete('/chats/{id}/destroy', [ChatController::class, 'destroy'])->name('chats.destroy');
    Route::get('/chats', [ChatController::class, 'loadChats'])->name('chats.load');
    Route::delete('/comments/{id}', [ChatController::class, 'destroy'])->name('chats.destroy');
    Route::patch('/comments/{id}/moderate', [ChatController::class, 'moderate'])->name('chats.moderate');

});

// Routes réservées à l'éditeur (Admin)
Route::prefix('admin')->middleware(['auth','role:editeur'])->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/users1/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/{id}/block', [AdminController::class, 'blockUser'])->name('admin.users.block');
    Route::get('/articles', [AdminController::class, 'manageArticles'])->name('admin.articles');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::get('/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::delete('/articles/{id}', [AdminController::class, 'destroyArticle'])->name('admin.articles.destroy');
    Route::post('/articles/{id}/change-status', [AdminController::class, 'changeStatus'])->name('admin.articles.changeStatus');

});

Route::get('/responsable/no-theme', function () {
    return view('responsable.no-theme', ['message' => 'Vous n\'êtes responsable d\'aucun thème.']);
})->name('responsable.no-theme');


Route::prefix('responsable')->middleware(['auth', 'role:responsable'])->group(function() {
    Route::get('/', [ResponsableController::class, 'index'])->name('responsable.dashboard');
    Route::get('/subscriptions', [ResponsableController::class, 'subscriptions'])->name('responsable.subscriptions');
    Route::post('/subscriptions/{user_id}/detach', [ResponsableController::class, 'detachSubscription'])->name('responsable.subscriptions.detach');
    Route::post('/subscriptions/{user_id}/toggle-block', [ResponsableController::class, 'toggleBlockSubscription'])
    ->name('responsable.subscriptions.toggleBlock');
    Route::get('/articles/moderate', [ResponsableController::class, 'moderateArticles'])->name('responsable.articles.moderate');
    Route::post('/articles/{article}/status', [ResponsableController::class, 'moderateArticleStatus'])->name('responsable.articles.updateStatus');
    Route::get('/conversations/moderate', [ResponsableController::class, 'moderateThemeConversations'])
     ->name('responsable.conversations.moderate');
    Route::delete('/conversations/delete/{id}', [ResponsableController::class, 'deleteConversationMessage'])
     ->name('responsable.conversations.delete');


});


// Inclusion des routes d'authentification de Breeze
require __DIR__.'/auth.php';
