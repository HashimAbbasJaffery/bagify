<?php

use App\Enum\Status;
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
        Schema::create('section_arrangement', function (Blueprint $table) {
            $table->id();
            $table->foreignId("section_id")->constrained("sections")->cascadeOnDelete();
            $table->foreignId("website_layout_id")->constrained("website_layout")->cascadeOnDelete();
            $table->unsignedInteger("order");
            
            $table->enum("status", Status::values())
                        ->default(Status::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_arrangement');
    }
};
