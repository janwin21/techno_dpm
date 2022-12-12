<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('card_main_id');
            $table->unsignedBigInteger('user_id');
            $table->string('card_image')->nullable();
            $table->string('card_template')->nullable();
            $table->string('card_name')->nullable();
            $table->string('card_attribute')->nullable();
            $table->string('card_rarity')->nullable();
            $table->string('non_monster_type')->nullable();
            $table->integer('card_level')->nullable()->default(0);
            $table->integer('card_rank')->nullable()->default(0);
            $table->integer('link_rating')->nullable()->default(0);
            $table->string('card_effect')->nullable();         
            $table->integer('card_atk')->nullable();           
            $table->string('card_summoning')->nullable();
            $table->integer('card_def')->nullable();
            $table->integer('card_scale_left')->nullable()->default(0);
            $table->integer('card_scale_right')->nullable()->default(0);   
            $table->string('link_marker')->nullable();
            $table->longText('card_pendulum_effect')->nullable();
            $table->longText('card_description')->nullable();
            $table->string('card_id')->nullable()->default('0123456789');
            $table->string('card_serial_number')->nullable()->default('SKC-000');
            $table->string('card_copyright')->nullable()->default(date('Y') . 'Author');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('card_stamp')->default('unlimited-edition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
