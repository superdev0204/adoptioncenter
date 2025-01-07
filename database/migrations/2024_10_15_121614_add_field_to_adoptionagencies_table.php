<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('adoptionagencies', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->after('created_date');
        });

        Schema::table('adoptionagencylogs', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->after('updated');
        });
    }

    public function down()
    {
        Schema::table('adoptionagencies', function (Blueprint $table) {
            $table->dropColumn('user_id'); // Rollback the addition of the field
        });

        Schema::table('adoptionagencylogs', function (Blueprint $table) {
            $table->dropColumn('user_id'); // Rollback the addition of the field
        });
    }
};