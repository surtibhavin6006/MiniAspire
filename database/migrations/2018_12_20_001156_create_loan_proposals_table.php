<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_proposals', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('reason')->nullable();
            $table->string('documents')->nullable();
            $table->double('borrow_amount')->nullable();

            $table->uuid('loan_type_id');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');

            $table->tinyInteger('is_approved')->nullable();
            $table->string('decline_reason')->nullable();
            $table->integer('tenure')->nullable();

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('proposals');
    }
}
