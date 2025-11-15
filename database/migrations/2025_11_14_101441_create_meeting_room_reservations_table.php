<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ReservationStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meeting_room_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->foreignId('meeting_room_id')->constrained('meeting_rooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ReservationStatus::values())->default(ReservationStatus::Pending->value);
            $table->timestamps();
        });

        Schema::create('meeting_room_reservation_attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_room_reservation_id')->constrained('meeting_room_reservations')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_room_reservations');
        Schema::dropIfExists('meeting_room_reservation_attendees');
    }
};
