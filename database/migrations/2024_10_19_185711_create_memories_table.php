<?php

use App\Models\User;
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
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->ulid('ref');
            $table->foreignIdFor( User::class);
            $table->string('name');
            $table->string('account_id')->default('351012345671');
            $table->string('ngo')->default('CY60002023420000003423423433');
            $table->text('description')->nullable();
            $table->dateTime('start_at')->default(now()->addDays(3));
            $table->string('ceremony_location')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};
