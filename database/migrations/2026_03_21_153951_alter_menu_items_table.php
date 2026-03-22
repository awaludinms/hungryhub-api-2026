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
        //
        Schema::table('menu_items', function (Blueprint $table){
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
            $table->boolean("is_deleted")->nullable();
            $table->datetime("deleted_at")->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
