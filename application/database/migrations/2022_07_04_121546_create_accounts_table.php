<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table)  {
            $table->increments('account_id');
            $table->string('account_username')->unique();
            $table->string('account_name');
            $table->string('account_password');
            $table->string('account_role');
            $table->string('account_picture')->nullable();
            $table->string('account_dept');
            $table->text('account_desc')->nullable();
            $table->boolean('account_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
