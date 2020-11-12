<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('grantN');
            $table->date('contractSignData')->nullable();
            $table->string('grantLeder')->nullable();
            $table->string('orgName')->nullable();
            $table->string('coorgName1')->nullable(); 
            $table->string('coorgName2')->nullable(); 
            $table->bigInteger('fullbudget')->nullable();
            $table->bigInteger('leadbudget')->nullable();
            $table->bigInteger('cobudget1')->nullable();
            $table->bigInteger('cobudget2')->nullable();
            $table->set('currPeriod', ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'])->nullable();
            $table->string('income1')->nullable();
            $table->string('income2')->nullable();
            $table->string('income3')->nullable();
            $table->string('outcome1')->nullable();
            $table->string('outcome2')->nullable();
            $table->string('outcome3')->nullable();
            $table->string('jobChangeEflow')->nullable();
            $table->string('jobTerminationEflow')->nullable();
            $table->set('Status', ['Current', 'Finished'])->default('Current');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
