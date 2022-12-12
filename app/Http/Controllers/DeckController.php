<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    /* VISIT YUGIOH DECK BUILDER PAGE (use to redirect after creating a data) */
    public function read($id) {

        $deck = DB::table('decks')
            ->where('deck_id', $id)
            ->get();
            
        $deck = ($deck) ? $deck[0] : '';

        return view('yugioh-deck-builder')->with('deck', $deck);
    }

    /* CREATE DECK */
    public function create(Request $request, $id) {

        $deck = new Deck();
        $deck->user_id = $id;
        $deck->deck_name = $request->deck_name;
        $deck->main_deck = '';
        $deck->extra_deck = '';
        $deck->side_deck = '';
        $deck->save();

        return redirect('home');
    }

    // UPDATE DECK (AUTO || CLICK)
    public function update($deck_id, $deck_name, $main_deck, $extra_deck, $side_deck) {

        DB::table('decks')
            ->where('deck_id', $deck_id)
            ->update([
                'deck_name' => $deck_name,
                'main_deck' => $main_deck,
                'extra_deck' => $extra_deck,
                'side_deck' => $side_deck,
            ]);
        
        $deck = DB::table('decks')
            ->where('deck_id', $deck_id)
            ->get();

        $deck = ($deck) ? $deck[0] : '';

        return Response::json([
            'data' => $deck
        ]);
    }

    /* DELETE DECK */
    public function delete($id) {
        DB::table('decks')
            ->where('deck_id', $id)
            ->delete();

        return redirect('home');
    }

}
