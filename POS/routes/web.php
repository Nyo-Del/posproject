<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;



require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';
require __DIR__.'/auth.php';
Route::redirect('/','login');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//google and git login

require __DIR__.'/auth.php';
Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('sociallogin');

Route::get('/auth/{provider}/callback',[SocialLoginController::class,'callback'])->name('socialcallback');






