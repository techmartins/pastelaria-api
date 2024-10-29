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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nome do produto
            $table->decimal('price', 10, 2);  // Nome do Preço
            $table->string('photo')->nullable();  // Foto do Produto
            $table->softDeletes();  //  deleted_at
            $table->timestamps();  //  Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
