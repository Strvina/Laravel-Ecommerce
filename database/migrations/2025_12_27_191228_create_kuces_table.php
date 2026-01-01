<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('kuces', function (Blueprint $table) {
        $table->id();                      // unique ID
        $table->string('name');            // dog name
        $table->string('breed');           // dog breed
        $table->integer('price');          // dog price
        $table->text('description');       // description about the dog/breed
        $table->string('image')->nullable(); // image path (optional)
        $table->timestamps();              // created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuces');
    }
};
