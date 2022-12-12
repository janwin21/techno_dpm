<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\CardImage;
use Illuminate\Support\Facades\Response;

class CardImageController extends Controller
{
    public function create(Request $request, $user_id) {

        $request->path = '';

        if($request->hasFile('card_image')) {
            $file = $request->file('card_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('/images/user/' . $user_id . '/album'), $filename);
            $request->path = $filename;         
        }
       
        CardImage::create([
            'user_id' => $user_id,
            'card_image_main_id' => $request->card_main_id,
            'card_image' => $request->path
        ]);

        return redirect('home');

    }

    public function delete($id, $user_id, $card_image) {
   
        if(File::exists(public_path('/images/user/' . $user_id . '/album/' . $card_image))) {
            File::delete(public_path('/images/user/' . $user_id . '/album/' . $card_image));
        }

        DB::table('card_images')
            ->where('card_image_id', $id)
            ->delete();

        return redirect('home');

    }

    public function read($id) {
        $card = DB::table('cards')
            ->where('card_main_id', $id)
            ->get();

        $card = ($card) ? $card[0] : '';

        return Response::json([
            'data' => $card
        ]);
    }
}
