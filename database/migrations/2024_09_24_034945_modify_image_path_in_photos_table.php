<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyImagePathInPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('photos', function (Blueprint $table) {
                $table->string('image_path', 255)->change();
            });

        }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('photos', function (Blueprint $table) {
                $table->dropColumn('image_path');
            });
    }
}
