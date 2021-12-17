<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->String('avatar',500)->nullable()->after('admin');
			$table->String('facebook')->nullable()->after('admin');
			$table->String('twitter')->nullable()->after('admin');
			$table->String('linkedin')->nullable()->after('admin');
			$table->String('website')->nullable()->after('admin');
			$table->String('street')->nullable()->after('admin');
			$table->String('suite')->nullable()->after('admin');
			$table->String('city')->nullable()->after('admin');
			$table->String('state')->nullable()->after('admin');
			$table->String('zipcode')->nullable()->after('admin');
			$table->String('phone')->nullable()->after('admin');
			$table->String('office_contact')->nullable()->after('admin');
			$table->String('pro_designation')->nullable()->after('admin');
			$table->String('about')->nullable()->after('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
            $table->dropColumn('website');
            $table->dropColumn('street');
            $table->dropColumn('suite');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipcode');
            $table->dropColumn('phone');
            $table->dropColumn('office_contact');
            $table->dropColumn('about');
            $table->dropColumn('pro_designation');
        });
    }
}
