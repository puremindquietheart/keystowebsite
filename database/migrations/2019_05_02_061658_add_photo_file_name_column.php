<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoFileNameColumn extends Migration
{
    
    public function up()
    {
        Schema::table('uploaded_photos', function (Blueprint $table) {
            $table->string('photo_file_name')->after('photo_name');
        });
    }

    public function down()
    {
        Schema::table('uploaded_photos', function (Blueprint $table) {
            $table->dropColumn('photo_file_name');
        });
    }
}
