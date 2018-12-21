<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {

            $table->string('role_slug');
            $table->foreign('role_slug')->references('slug')->on('roles')->onDelete('cascade');

            $table->string('permission_slug');
            $table->foreign('permission_slug')->references('slug')->on('permissions')->onDelete('cascade');

            $table->unique(['role_slug','permission_slug']);

            $table->softDeletes();
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
        Schema::dropIfExists('role_permissions');
    }
}
