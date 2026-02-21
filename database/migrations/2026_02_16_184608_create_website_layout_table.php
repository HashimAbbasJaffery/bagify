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
        Schema::create('website_layout', function (Blueprint $table) {
            $table->id();
            $table->foreignId("header_id")->constrained("headers")->cascadeOnDelete();
            $table->foreignId("banner_id")->constrained("banners")->cascadeOnDelete();
            $table->foreignId("footer_id")->constrained("footers")->cascadeOnDelete();
            
            $table->enum("status", Status::values())
                        ->default(Status::Inactive->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_layout');
    }
};
