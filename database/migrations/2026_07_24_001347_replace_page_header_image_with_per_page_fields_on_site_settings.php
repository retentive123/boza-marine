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
            $table->dropColumn('page_header_image');
            $table->string('header_image_about')->nullable();
            $table->string('header_image_services')->nullable();
            $table->string('header_image_gallery')->nullable();
            $table->string('header_image_careers')->nullable();
            $table->string('header_image_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'header_image_about', 'header_image_services', 'header_image_gallery',
                'header_image_careers', 'header_image_contact',
            ]);
            $table->string('page_header_image')->nullable();
        });
    }
};
