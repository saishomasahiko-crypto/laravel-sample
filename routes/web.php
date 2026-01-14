<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Livewire\UserList;

Route::resource('post', PostController::class);
Route::get('/users', UserList::class)->middleware('can:admin')->name('users.list');


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // 投稿のCRUD処理
    Route::resource('post', PostController::class);
    // ユーザー一覧ページ
    Route::get('/users', UserList::class)->middleware('can:admin')->name('users.list');

});

// require __DIR__.'/auth.php';
