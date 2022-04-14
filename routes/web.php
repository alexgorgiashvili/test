<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/show/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');
Route::get('/create', [IdeaController::class, 'create'])->name('idea.create');
Route::post('/store', [IdeaController::class, 'store'])->name('store');
Route::post('/storeTwo', [IdeaController::class, 'storeTwo'])->name('ideas.store');
Route::get('/edit_idea/{id}', [IdeaController::class, 'edit_idea'])->name('edit_idea');
Route::patch('/update_one/{id}', [IdeaController::class, 'update_one'])->name('update_one');
Route::patch('/update_two/{id}', [IdeaController::class, 'update_two'])->name('update_two');

// admin routes

Route::middleware(['auth', 'isAdmin'])->group(function () {
  Route::get('/admin',[AdminController::class,'polls'])->name('admin_polls');
  Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin_dashboard');
  Route::get('/admin_search',[AdminController::class,'admin_search'])->name('admin_search');
  Route::get('/admin/view/{id}',[AdminController::class,'view'])->name('admin_view');
  Route::get('/admin/addVotes/{id}',[AdminController::class,'addVotes'])->name('admin_addVotes');
  Route::get('/admin/delete{id}',[AdminController::class,'delete'])->name('admin_delete');
  Route::get('/admin/edit{id}',[AdminController::class,'edit'])->name('admin_edit');
  Route::patch('/admin/update_one{id}',[AdminController::class,'admin_update_one'])->name('admin_update_one');
  Route::patch('/admin/update_two{id}',[AdminController::class,'admin_update_two'])->name('admin_update_two');
  Route::get('/admin/clearSpams{id}',[AdminController::class,'clearSpams'])->name('admin_clear_spams');


  
  
  
});




// Google login

Route::get('/auth/google/redirect',[LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback',[LoginController::class, 'handleGoogleCallback']);

// facebook login

Route::get('/auth/facebook/redirect',[LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback',[LoginController::class, 'handleFacebookCallback']);



