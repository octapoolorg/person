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
// Route::get('name/{name}/famous-people', [NameController::class, 'famousPeople'])->name('names.famousPeople');
// Route::get('name/{name}/name-day', [NameController::class, 'nameDay'])->name('names.nameDay');
// Route::get('name/{name}/birthstone', [NameController::class, 'birthstone'])->name('names.birthstone');

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
// Route::get('name/{name}/name-in-limericks', [NameController::class, 'nameInLimericks'])->name('names.nameInLimericks');
// Route::get('name/{name}/name-in-haikus', [NameController::class, 'nameInHaikus'])->name('names.nameInHaikus');
// Route::get('name/{name}/name-in-sonnets', [NameController::class, 'nameInSonnets'])->name('names.nameInSonnets');
// Route::get('name/{name}/name-in-epics', [NameController::class, 'nameInEpics'])->name('names.nameInEpics');
// Route::get('name/{name}/name-in-ballads', [NameController::class, 'nameInBallads'])->name('names.nameInBallads');
// Route::get('name/{name}/name-in-odes', [NameController::class, 'nameInOdes'])->name('names.nameInOdes');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-in-idioms', [NameController::class, 'nameInIdioms'])->name('names.nameInIdioms');
// Route::get('name/{name}/name-in-slang', [NameController::class, 'nameInSlang'])->name('names.nameInSlang');
// Route::get('name/{name}/name-in-urban-dictionary', [NameController::class, 'nameInUrbanDictionary'])->name('names.nameInUrbanDictionary');
// Route::get('name/{name}/name-in-lingo', [NameController::class, 'nameInLingo'])->name('names.nameInLingo');
// Route::get('name/{name}/name-in-terms', [NameController::class, 'nameInTerms'])->name('names.nameInTerms');
// Route::get('name/{name}/name-in-phrases', [NameController::class, 'nameInPhrases'])->name('names.nameInPhrases');

// // list of personalized stuff related to a name
// Route::get('name/{name}/name-in-words', [NameController::class, 'nameInWords'])->name('names.nameInWords');
// Route::get('name/{name}/name-in-sentences', [NameController::class, 'nameInSentences'])->name('names.nameInSentences');
// Route::get('name/{name}/name-in-paragraphs', [NameController::class, 'nameInParagraphs'])->name('names.nameInParagraphs');
// Route::get('name/{name}/name-in-essays', [NameController::class, 'nameInEssays'])->name('names.nameInEssays');
// Route::get('name/{name}/name-in-stories', [NameController::class, 'nameInStories'])->name('names.nameInStories');
// Route::get('name/{name}/name-in-novels', [NameController::class, 'nameInNovels'])->name('names.nameInNovels');
