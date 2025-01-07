<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentIdToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable()->after('user_id');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default('Pending')->after('agent_id');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['agent_id']);
            $table->dropColumn('agent_id');
            $table->dropColumn('status');
        });
    }
}
