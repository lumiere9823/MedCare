<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id('medication_id');
            $table->string('name'); // Name of the medication
            $table->text('description')->nullable(); // Description of the medication
            $table->foreignId('supplier_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->decimal('price', 8, 2); // Price of the medication
            $table->integer('stock_quantity'); // Stock quantity
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('medications');
    }
}