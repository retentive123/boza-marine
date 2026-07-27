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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('tiktok_url')->nullable();
            $table->string('youtube_url')->nullable();

            for ($i = 1; $i <= 3; $i++) {
                $table->string("whatsapp_agent_{$i}_name")->nullable();
                $table->string("whatsapp_agent_{$i}_number")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $columns = ['tiktok_url', 'youtube_url'];

            for ($i = 1; $i <= 3; $i++) {
                $columns[] = "whatsapp_agent_{$i}_name";
                $columns[] = "whatsapp_agent_{$i}_number";
            }

            $table->dropColumn($columns);
        });
    }
};
