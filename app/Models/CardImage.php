<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CardImage extends Model
{
    use HasFactory;

    protected $table = 'card_images';

    protected $guarded = [];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
