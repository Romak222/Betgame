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
        Schema::create('retailers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Shop
            $table->string('shop_name');
            $table->string('shop_code')->unique();

            // Owner
            $table->string('owner_name');

            $table->string('mobile',20);

            $table->string('alternate_mobile',20)
                ->nullable();

            // Address

            $table->text('address');

            $table->string('city');

            $table->string('state');

            $table->string('pincode',10);

            // Business

            $table->decimal('margin',5,2)
                ->default(0);

            $table->decimal('daily_limit',15,2)
                ->default(0);

            // Extra

            $table->boolean('status')
                ->default(true);

            $table->text('notes')
                ->nullable();

            $table->timestamp('last_login')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('retailers');
    }
};