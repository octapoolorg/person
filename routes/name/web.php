<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Name\NameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');

Route::get('names/search', [NameController::class, 'search'])->name('names.search');
Route::get('names/favorites', [NameController::class, 'favorites'])->name('names.favorites');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');

// list of popular stuff related to a name
Route::get('name/{name}/signatures', [NameController::class, 'signatures'])->name('names.signatures');
Route::get('name/{name}/wallpapers', [NameController::class, 'wallpapers'])->name('names.wallpapers');
// Route::get('name/{name}/images', [NameController::class, 'images'])->name('names.images');
// Route::get('name/{name}/videos', [NameController::class, 'videos'])->name('names.videos');
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
// Route::get('name/{name}/horoscope', [NameController::class, 'horoscope'])->name('names.horoscope');
// Route::get('name/{name}/numerology', [NameController::class, 'numerology'])->name('names.numerology');
// Route::get('name/{name}/name-meaning', [NameController::class, 'nameMeaning'])->name('names.nameMeaning');
// Route::get('name/{name}/name-origin', [NameController::class, 'nameOrigin'])->name('names.nameOrigin');
// Route::get('name/{name}/famous-people', [NameController::class, 'famousPeople'])->name('names.famousPeople');
// Route::get('name/{name}/name-day', [NameController::class, 'nameDay'])->name('names.nameDay');
// Route::get('name/{name}/birthstone', [NameController::class, 'birthstone'])->name('names.birthstone');
// Route::get('name/{name}/personalized-gifts', [NameController::class, 'personalizedGifts'])->name('names.personalizedGifts');
// Route::get('name/{name}/personalized-books', [NameController::class, 'personalizedBooks'])->name('names.personalizedBooks');
// Route::get('name/{name}/personalized-jewelry', [NameController::class, 'personalizedJewelry'])->name('names.personalizedJewelry');
// Route::get('name/{name}/personalized-music', [NameController::class, 'personalizedMusic'])->name('names.personalizedMusic');
// Route::get('name/{name}/personalized-movies', [NameController::class, 'personalizedMovies'])->name('names.personalizedMovies');
// Route::get('name/{name}/personalized-tv-shows', [NameController::class, 'personalizedTvShows'])->name('names.personalizedTvShows');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-popularity', [NameController::class, 'namePopularity'])->name('names.namePopularity');
// Route::get('name/{name}/name-statistics', [NameController::class, 'nameStatistics'])->name('names.nameStatistics');
// Route::get('name/{name}/similar-names', [NameController::class, 'similarNames'])->name('names.similarNames');
// Route::get('name/{name}/name-predictions', [NameController::class, 'namePredictions'])->name('names.namePredictions');
// Route::get('name/{name}/name-in-different-languages', [NameController::class, 'nameInDifferentLanguages'])->name('names.nameInDifferentLanguages');
// Route::get('name/{name}/name-in-sign-language', [NameController::class, 'nameInSignLanguage'])->name('names.nameInSignLanguage');
// Route::get('name/{name}/name-in-braille', [NameController::class, 'nameInBraille'])->name('names.nameInBraille');
// Route::get('name/{name}/name-in-morse-code', [NameController::class, 'nameInMorseCode'])->name('names.nameInMorseCode');
// Route::get('name/{name}/name-in-binary', [NameController::class, 'nameInBinary'])->name('names.nameInBinary');
// Route::get('name/{name}/name-in-ascii', [NameController::class, 'nameInAscii'])->name('names.nameInAscii');
// Route::get('name/{name}/name-in-hieroglyphics', [NameController::class, 'nameInHieroglyphics'])->name('names.nameInHieroglyphics');
// Route::get('name/{name}/name-in-emoji', [NameController::class, 'nameInEmoji'])->name('names.nameInEmoji');
// Route::get('name/{name}/name-in-anagrams', [NameController::class, 'nameInAnagrams'])->name('names.nameInAnagrams');
// Route::get('name/{name}/name-in-acrostic-poem', [NameController::class, 'nameInAcrosticPoem'])->name('names.nameInAcrosticPoem');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-in-different-scripts', [NameController::class, 'nameInDifferentScripts'])->name('names.nameInDifferentScripts');
// Route::get('name/{name}/name-in-ancient-languages', [NameController::class, 'nameInAncientLanguages'])->name('names.nameInAncientLanguages');
// Route::get('name/{name}/name-in-fantasy-languages', [NameController::class, 'nameInFantasyLanguages'])->name('names.nameInFantasyLanguages');
// Route::get('name/{name}/name-in-cryptography', [NameController::class, 'nameInCryptography'])->name('names.nameInCryptography');
// Route::get('name/{name}/name-in-pig-latin', [NameController::class, 'nameInPigLatin'])->name('names.nameInPigLatin');
// Route::get('name/{name}/name-in-reverse', [NameController::class, 'nameInReverse'])->name('names.nameInReverse');
// Route::get('name/{name}/name-in-palindrome', [NameController::class, 'nameInPalindrome'])->name('names.nameInPalindrome');
// Route::get('name/{name}/name-in-abbreviations', [NameController::class, 'nameInAbbreviations'])->name('names.nameInAbbreviations');
// Route::get('name/{name}/name-in-puns', [NameController::class, 'nameInPuns'])->name('names.nameInPuns');
// Route::get('name/{name}/name-in-riddles', [NameController::class, 'nameInRiddles'])->name('names.nameInRiddles');
// Route::get('name/{name}/name-in-jokes', [NameController::class, 'nameInJokes'])->name('names.nameInJokes');
// Route::get('name/{name}/name-in-quotes', [NameController::class, 'nameInQuotes'])->name('names.nameInQuotes');
// Route::get('name/{name}/name-in-proverbs', [NameController::class, 'nameInProverbs'])->name('names.nameInProverbs');
// Route::get('name/{name}/name-in-tongue-twisters', [NameController::class, 'nameInTongueTwisters'])->name('names.nameInTongueTwisters');

require __DIR__.'/image.php';