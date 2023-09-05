<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('openai_laravel_responses', function (Blueprint $table) {
            $table->id();
            $table->longText('prompt');
            $table->string('hashsum');
            $table->longText('response');
            $table->timestamps();
        });
    }
};