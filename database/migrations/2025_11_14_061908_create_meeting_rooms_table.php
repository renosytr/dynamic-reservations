<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\RegionCode;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->enum('region_code', RegionCode::values())->default(RegionCode::Jakarta->value);
            $table->smallInteger('capacity');
            $table->string('image')->nullable();
            $table->boolean('is_enable')->default(true);
            $table->timestamps();
        });

        Schema::create('meeting_room_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_room_id')->constrained('meeting_rooms')->onDelete('cascade');
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
            $table->unsignedSmallInteger('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_rooms');
        Schema::dropIfExists('meeting_room_facilities');
    }
};
