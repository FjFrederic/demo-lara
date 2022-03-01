<?php

use App\Models\User;
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
        Schema::table('users', function(Blueprint $table)
        {
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@caissemanagement.com';
            $user->password =  bcrypt('AdminFirst1@caisse');
            $user->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            User::where('email', 'frederic@caissemanagement.com')->delete();
        });
    }
};
