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
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('about_image')->nullable();
            $table->string('color_primary', 7)->default('#128dc4');
            $table->string('color_secondary', 7)->default('#0a1626');
            $table->string('color_accent', 7)->default('#f5a623');
            $table->string('font_heading')->default('Fraunces');
            $table->string('font_body')->default('Plus Jakarta Sans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'logo_path', 'favicon_path', 'about_image',
                'color_primary', 'color_secondary', 'color_accent',
                'font_heading', 'font_body',
            ]);
        });
    }
};
