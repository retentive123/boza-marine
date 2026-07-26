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
            $table->boolean('nav_about_visible')->default(true);
            $table->boolean('nav_leadership_visible')->default(true);
            $table->boolean('nav_services_visible')->default(true);
            $table->boolean('nav_gallery_visible')->default(true);
            $table->boolean('nav_news_visible')->default(true);
            $table->boolean('nav_careers_visible')->default(true);
            $table->boolean('nav_contact_visible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'nav_about_visible',
                'nav_leadership_visible',
                'nav_services_visible',
                'nav_gallery_visible',
                'nav_news_visible',
                'nav_careers_visible',
                'nav_contact_visible',
            ]);
        });
    }
};
