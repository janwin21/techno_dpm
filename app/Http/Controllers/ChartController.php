<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // analyse the statistics of specified deck 
    public function analyse_deck_statistics($id) {
        $deck = DB::table('decks')->where('deck_id', $id)->get();
        return view('charts.deck_statistics')->with('deck', $deck[0]);
    }
}
