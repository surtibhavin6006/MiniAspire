<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanEmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_emis', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->uuid('loan_proposal_id');
            $table->foreign('loan_proposal_id')->references('id')->on('loan_proposals')->onDelete('cascade');

            $table->uuid('loan_type_id');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');

            /**
             * taking here interest rate is may be ,we change interest so old customer should not have any changes.
             */
            $table->double('interest_rate')->nullable();

            $table->double('remaining_amount')->nullable();
            $table->double('emi_amount')->nullable();
            $table->tinyInteger('is_paid')->nullable();
            $table->tinyInteger('is_enable')->nullable();
            $table->date('date_of_emi')->nullable();
            $table->tinyInteger('is_forget_to_pay')->nullable();
            $table->tinyInteger('penalty_amount')->nullable();

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
        Schema::dropIfExists('loan_emis');
    }
}
