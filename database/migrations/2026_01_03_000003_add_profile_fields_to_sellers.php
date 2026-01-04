<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->json('photos')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->string('operational_days')->nullable();
            $table->string('shipping_estimate')->nullable();
            $table->string('slogan')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('website')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'logo',
                'banner',
                'photos',
                'phone',
                'address',
                'city',
                'province',
                'postal_code',
                'open_time',
                'close_time',
                'operational_days',
                'shipping_estimate',
                'slogan',
                'theme_color',
                'instagram',
                'facebook',
                'tiktok',
                'website'
            ]);
        });
    }
};
