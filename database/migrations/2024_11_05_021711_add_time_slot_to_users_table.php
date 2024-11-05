<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeSlotToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Define the ENUM values as needed
            $table->enum('time_slot', [
                '09:00-12:00',
                '13:00-17:00',
                '09:00-17:00',
                '11:00-14:00',
                '15:00-18:00',
                'Other' // Add more options as necessary
            ])->nullable(); // Use nullable() if you want to allow null values
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('time_slot');
        });
    }
}