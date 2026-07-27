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
            $table->boolean('whatsapp_agents_enabled')->default(true);

            for ($i = 1; $i <= 3; $i++) {
                $table->boolean("whatsapp_agent_{$i}_active")->default(true);
                $table->string("whatsapp_agent_{$i}_photo")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $columns = ['whatsapp_agents_enabled'];

            for ($i = 1; $i <= 3; $i++) {
                $columns[] = "whatsapp_agent_{$i}_active";
                $columns[] = "whatsapp_agent_{$i}_photo";
            }

            $table->dropColumn($columns);
        });
    }
};
