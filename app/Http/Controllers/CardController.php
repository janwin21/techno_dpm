<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\File;

class CardController extends Controller
{
    /* VISIT YUGIOH CARD MAKE PAGE AS A GUEST */
    public function default_visit() {
        return view('yugioh-card-maker');
    }

    /* CREATE CARD */
    public function create(Request $request, $id) {

        $request->path = '';

        if($request->hasFile('card_image')) {
            $file = $request->file('card_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('/images/user/' . $id), $filename);
            $request->path = $filename;          
        }
       
        Card::create([
            'user_id' => $id,
            'card_image' => $request->path,
            'card_template' => $request->card_template,
            'card_name' => $request->card_name,
            'card_attribute' => $request->card_attribute,
            'card_rarity' => $request->card_rarity,
            'non_monster_type' => $request->non_monster_type,
            'card_level' => $request->card_level,
            'card_rank' => $request->card_rank,
            'link_rating' => $request->link_rating,
            'card_effect' => $request->card_effect,
            'card_atk' => $request->card_atk,
            'card_summoning' => $request->card_summoning,
            'card_def' => $request->card_def,
            'card_scale_left' => $request->card_scale_left,
            'card_scale_right' => $request->card_scale_right,
            'link_marker' => $request->link_marker,
            'card_pendulum_effect' => $request->card_pendulum_effect,
            'card_description' => $request->card_description,
            'card_id' => $request->card_id,
            'card_serial_number' => $request->card_serial_number,
            'card_copyright' => $request->card_copyright,
            'card_stamp' => $request->card_stamp
        ]);

        return redirect('home');
    }

    /* VISIT YUGIOH CARD MAKE PAGE AS A USER */
    public function visit($id, $card_main_id) {
        $card = DB::table('cards')
            ->where('user_id', $id)
            ->where('card_main_id', $card_main_id)
            ->get();

        $card = ($card) ? $card[0] : '';

        return view('yugioh-card-maker', compact('card'));
    }

    /* UPDATE CARD */
    public function update(Request $request, $card_main_id, $user_id, $card_image) {

        $request->path = ($card_image != 'empty.png') ? $card_image : '';

        if($request->hasFile('card_image')) {
            if(File::exists(public_path('/images/user/' . $user_id . '/' . $card_image))) {
                File::delete(public_path('/images/user/' . $user_id . '/' . $card_image));
            }

            $file = $request->file('card_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('/images/user/' . $user_id), $filename);
            $request->path = $filename;          
        }

        DB::table('cards')
            ->where('card_main_id', $card_main_id)
            ->update([
                'user_id' => $user_id,
                'card_image' => $request->path,
                'card_template' => $request->card_template,
                'card_name' => $request->card_name,
                'card_attribute' => $request->card_attribute,
                'card_rarity' => $request->card_rarity,
                'non_monster_type' => $request->non_monster_type,
                'card_level' => $request->card_level,
                'card_rank' => $request->card_rank,
                'link_rating' => $request->link_rating,
                'card_effect' => $request->card_effect,
                'card_atk' => $request->card_atk,
                'card_summoning' => $request->card_summoning,
                'card_def' => $request->card_def,
                'card_scale_left' => $request->card_scale_left,
                'card_scale_right' => $request->card_scale_right,
                'link_marker' => $request->link_marker,
                'card_pendulum_effect' => $request->card_pendulum_effect,
                'card_description' => $request->card_description,
                'card_id' => $request->card_id,
                'card_serial_number' => $request->card_serial_number,
                'card_copyright' => $request->card_copyright,
                'card_stamp' => $request->card_stamp
            ]);

        return redirect('home');
    }

    /* DELETE CARD */
    public function delete($card_main_id, $user_id, $card_image = 'empty.png') {
   
        if(File::exists(public_path('/images/user/' . $user_id . '/' . $card_image))) {
            File::delete(public_path('/images/user/' . $user_id . '/' . $card_image));
        }

        DB::table('cards')
            ->where('card_main_id', $card_main_id)
            ->delete();

        return redirect('home');
        
    }

}
