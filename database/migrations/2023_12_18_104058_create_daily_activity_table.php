<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_activity', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id", "Employee Daily")->references("id")->on("employees");

            $table->string("doing", 191);
            $table->date("doing_date");
            $table->time("doing_time");
            $table->text("note");
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
        Schema::dropIfExists('daily_activity');
    }
}
