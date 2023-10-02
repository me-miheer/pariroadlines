<?php

use App\Models\default_profile;
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
        Schema::create('default_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('default',0);
            $table->timestamps();
        });

        $profile = new default_profile();
        $profile->default = 0;
        $profile->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_profiles');
    }
};
