<?php

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('unique campaign name');
            $table->dateTime('from_date')->comment('campaign start date');
            $table->dateTime('to_date')->comment('campaign end date');
            $table->float('total_budget',8, 2)->comment('campaign total budget in USD');
            $table->float('daily_budget',8, 2)->comment('campaign daily budget in USD');
            $table->json('creative_upload')->comment('campaign images with name and path');
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
        Schema::dropIfExists('campaigns');
    }
};
