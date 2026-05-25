<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ACCESS LEVELS
        |--------------------------------------------------------------------------
        */

        Schema::create('access_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('username')
                ->unique();

            $table->string('password');

            $table->string('authenticable_type')
                ->nullable();

            $table->unsignedBigInteger('authenticable_id')
                ->nullable();

            $table->foreignId('access_level_id')
                ->nullable()
                ->constrained('access_levels');

            $table->foreignId('center_id')
                ->nullable()
                ->constrained('centers');

            $table->softDeletes();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_type_id')
                ->nullable()
                ->constrained('product_types')
                ->nullOnDelete();

            $table->foreignId('center_id')
                ->nullable()
                ->constrained('centers')
                ->nullOnDelete();

            $table->text('description');

            $table->integer('current_quantity')
                ->default(0);

            $table->timestamp('viewed_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('users');
        Schema::dropIfExists('access_levels');
    }
};