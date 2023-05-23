<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designers_addresses', function (Blueprint $table) {
            $table->bigIncrements('id', )->length(10);
            $table->unsignedBigInteger('designer_id');
            $table->string       ('street',   255);
            $table->string       ('nr',       255);
            $table->string       ('bloc',     255);
            $table->string       ('city',     255);
            $table->string       ('county',   255);
            $table->string       ('country',  255);
            $table->string       ('zip_code', 255);
            $table->text         ('comments', 255);
            $table->integer      ('ordering' )->length(10)->unsigned()->nullable();
            $table->boolean      ('is_billing_address')->default(false);
            $table->dateTime     ('created_at');
            $table->dateTime     ('updated_at');

            $table->foreign('designer_id')->references('id')->on('designers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designers_addresses');
    }
}
