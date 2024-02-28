<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Name\NameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('names/search', [NameController::class, 'search'])->name('names.search');
Route::get('names/favorites/{favorite?}', [NameController::class, 'favorites'])->name('names.favorites');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');

// list of popular stuff related to a name
Route::get('signatures/{name}', [NameController::class, 'signatures'])->name('names.signatures');
Route::get('wallpapers/{name}', [NameController::class, 'wallpapers'])->name('names.wallpapers');

Route::get('/wallpaper/{style}/{name}.jpg', [NameController::class, 'wallpaper'])->name('names.wallpaper');
Route::get('/signature/{style}/{name}.jpg', [NameController::class, 'signature'])->name('names.signature');
Route::get('/cover/{name}.jpg', [NameController::class, 'cover'])->name('names.cover');

// Route::get('name/{name}/quotes', [NameController::class, 'quotes'])->name('names.quotes');
// Route::get('name/{name}/memes', [NameController::class, 'memes'])->name('names.memes');
// Route::get('name/{name}/tattoos', [NameController::class, 'tattoos'])->name('names.tattoos');
// Route::get('name/{name}/jewelry', [NameController::class, 'jewelry'])->name('names.jewelry');
// Route::get('name/{name}/gifts', [NameController::class, 'gifts'])->name('names.gifts');
// Route::get('name/{name}/books', [NameController::class, 'books'])->name('names.books');
// Route::get('name/{name}/music', [NameController::class, 'music'])->name('names.music');
// Route::get('name/{name}/movies', [NameController::class, 'movies'])->name('names.movies');
// Route::get('name/{name}/tv-shows', [NameController::class, 'tvShows'])->name('names.tv-shows');
// Route::get('name/{name}/celebrities', [NameController::class, 'celebrities'])->name('names.celebrities');

// // list of personalized stuff related to a name
// Route::get('name/{name}/personality', [NameController::class, 'personality'])->name('names.personality');
// Route::get('name/{name}/numerology', [NameController::class, 'numerology'])->name('names.numerology');
// Route::get('name/{name}/birthstone', [NameController::class, 'birthstone'])->name('names.birthstone');
// Route::get('name/{name}/famous-people', [NameController::class, 'famousPeople'])->name('names.famousPeople');
// Route::get('name/{name}/name-day', [NameController::class, 'nameDay'])->name('names.nameDay');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-popularity', [NameController::class, 'namePopularity'])->name('names.namePopularity');
// Route::get('name/{name}/name-statistics', [NameController::class, 'nameStatistics'])->name('names.nameStatistics');
// Route::get('name/{name}/similar-names', [NameController::class, 'similarNames'])->name('names.similarNames');
// Route::get('name/{name}/name-in-emoji', [NameController::class, 'nameInEmoji'])->name('names.nameInEmoji');
// Route::get('name/{name}/name-in-anagrams', [NameController::class, 'nameInAnagrams'])->name('names.nameInAnagrams');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-in-cryptography', [NameController::class, 'nameInCryptography'])->name('names.nameInCryptography');
// Route::get('name/{name}/name-in-palindrome', [NameController::class, 'nameInPalindrome'])->name('names.nameInPalindrome');
// Route::get('name/{name}/name-in-riddles', [NameController::class, 'nameInRiddles'])->name('names.nameInRiddles');
// Route::get('name/{name}/name-in-jokes', [NameController::class, 'nameInJokes'])->name('names.nameInJokes');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-in-sentences', [NameController::class, 'nameInSentences'])->name('names.nameInSentences');
// Route::get('name/{name}/name-in-stories', [NameController::class, 'nameInStories'])->name('names.nameInStories');
// Route::get('name/{name}/name-in-novels', [NameController::class, 'nameInNovels'])->name('names.nameInNovels');
