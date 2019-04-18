<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAstrometryJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astrometry_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('image_id');
            $table->unsignedInteger('submission_id')->nullable();
            $table->unsignedInteger('job_id')->nullable();
            $table->string('status');
            $table->double('ra', 20)->nullable();
            $table->double('dec', 20)->nullable();
            $table->double('radius', 20)->nullable();
            $table->double('orientation', 20)->nullable();
            $table->double('pixel_scale', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('astrometry_jobs');
    }
}
