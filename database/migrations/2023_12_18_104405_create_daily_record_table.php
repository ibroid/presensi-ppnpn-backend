<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id", "Employee Record")->references("id")->on("employees");
            $table->text("note");
            $table->date("record_date");
            $table->time("record_time");
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
        Schema::dropIfExists('daily_record');
    }
}
