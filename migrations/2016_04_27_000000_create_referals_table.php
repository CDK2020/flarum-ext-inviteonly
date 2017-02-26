<?php 
use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return Migration::createTable(
    'referals',
    function (Blueprint $table) {
        $table->increments('id');
        $table->integer('referrer')->unsigned();
        $table->string('token');
        $table->timestamp('created_at');
        $table->integer('used');
    }
);
