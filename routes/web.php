<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// --------------------------------------------------------------------------------------------------->
// home route
Route::get('/', function () {
    return view('welcome');
})->name('main');

// (Routes of ALL php files related to Authentication process) enable verification to TRUE
Auth::routes(['verify' => true]);

// dashboard route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// --------------------------------------------------------------------------------------------------->

// --------------------------------------------------------------------------------------------------->
// YUGIOH CARD MAKER ROUTE
Route::get('/yugioh-card-maker', [App\Http\Controllers\CardController::class, 'default_visit'])->name('yugioh-card-maker'); // visit by a guest

Route::get('/yugioh-card-maker/{id}', [App\Http\Controllers\CardController::class, 'create'])->name('card.create'); // create card applying user's id

Route::get('/yugioh-card-maker/{id}/{card_main_id}', [App\Http\Controllers\CardController::class, 'visit'])->name('yugioh-card-maker-user'); // visit the created card for update

Route::get('card/update/{card_main_id}/{user_id}/{card_image}', [App\Http\Controllers\CardController::class, 'update']); // update the card and go back to the dashboard

Route::get('card/delete/{card_main_id}/{user_id}/{card_image?}', [App\Http\Controllers\CardController::class, 'delete']); // delete cards and redirect again ti the dashboard itself
// --------------------------------------------------------------------------------------------------->

// --------------------------------------------------------------------------------------------------->
// YUGIOH CARD IMAGE UPLOAD
Route::get('card-image/create/{user_id}', [App\Http\Controllers\CardImageController::class, 'create']); // upload and save card image and go back to the dashboard itself

Route::get('card-image/delete/{id}/{user_id}/{card_image}', [App\Http\Controllers\CardImageController::class, 'delete']); // delete the image and go back to the dashboard itself

Route::get('card-image/read/{id}', [App\Http\Controllers\CardImageController::class, 'read']); // read the card information using the cards table
// --------------------------------------------------------------------------------------------------->

// --------------------------------------------------------------------------------------------------->
// DECK BUILDER
Route::get('/deck/create/{user_id}', [App\Http\Controllers\DeckController::class, 'create'])->name('deck-builder'); // create a deck go the dashboard itself

Route::get('/deck/read/{id}', [App\Http\Controllers\DeckController::class, 'read'])->name('deck-reader'); // get the data and redirect to the Deck Builder Page

Route::get('/deck/update/{deck_id}/{deck_name}/{main_deck}/{extra_deck}/{side_deck}', [App\Http\Controllers\DeckController::class, 'update']); // create a deck and redirect to the Deck Builder Page

Route::get('/deck/delete/{id}', [App\Http\Controllers\DeckController::class, 'delete']); // create a deck and redirect to the Deck Builder Page
// --------------------------------------------------------------------------------------------------->

// --------------------------------------------------------------------------------------------------->
// PDF PREVIEW & UPLOAD
Route::get('/card_pdf', [App\Http\Controllers\PDFController::class, 'cards']); // visit card PDF uploader page

Route::get('/card_pdf/pdf', [App\Http\Controllers\PDFController::class, 'upload_cards']); // preview & upload cards to pdf
// --------------------------------------------------------------------------------------------------->

// --------------------------------------------------------------------------------------------------->
// GOOGLE CHART (FOR DECK)
Route::get('/deck_chart/{id}', [App\Http\Controllers\ChartController::class, 'analyse_deck_statistics']); // visit DECK CHART STATISTIC PAGE with deck stored data
// --------------------------------------------------------------------------------------------------->
