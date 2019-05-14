<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploaded_photos', function (Blueprint $table) {
            $table->string('second_photo')->after('first_photo');
            $table->string('third_photo')->after('second_photo');
            $table->string('fourth_photo')->after('third_photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploaded_photos', function (Blueprint $table) {
            $table->dropColumn('second_photo');
            $table->dropColumn('third_photo');
            $table->dropColumn('fourth_photo');
        });
    }
}
