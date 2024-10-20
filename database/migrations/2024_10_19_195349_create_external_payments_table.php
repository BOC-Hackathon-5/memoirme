<?php

use App\Models\Memory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create( 'external_payments', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId('memory_id' )->constrained('memories');
            $table->string('name');
            $table->text('message')->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( 'external_payments' );
    }
};
