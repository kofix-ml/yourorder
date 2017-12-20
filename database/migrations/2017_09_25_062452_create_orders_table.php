<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menus')->default('{}');
            $table->string('paid')->default('no');
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('cascade');
            $table->unsignedInteger('table_id');
            $table->foreign('table_id')
                  ->references('id')
                  ->on('tables')
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('user_id');
            $table->dropColumn('table_id');
        });
        Schema::dropIfExists('orders');
    }
}
