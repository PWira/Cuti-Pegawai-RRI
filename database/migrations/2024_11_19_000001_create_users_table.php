<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id("id");
            $table->string('name', 50);
            $table->string('user_nip', 20)->unique();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('user_unit_id')->nullable();
            $table->foreign('user_unit_id')
            ->references('unit_id')
            ->on('unit_kerja');
            $table->string('user_jabatan', 50)->nullable();
            $table->enum('roles', ['admin', 'direktur', 'kepala_rri','sdm'])->nullable();
            $table->enum('hak', ['admin', 'super_user', 'user']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

            // $table->id("id");
            // $table->string('name');
            // $table->string('nip')->unique();
            // $table->enum('jk',['laki_laki','perempuan']);
            // $table->integer('umur');
            // $table->string('jabatan');
            // $table->string('user_unit_kerja');
            // $table->integer('user_masa_kerja');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->string('asal');
            // $table->string('roles');
            // $table->enum('hak',['admin','super_user','user']);
            // $table->rememberToken();
            // $table->timestamps();