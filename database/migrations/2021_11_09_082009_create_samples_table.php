<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->longText('description')->nullable();
            $table->string('manufacturer', 200)->nullable();
            $table->string('model_no', 200)->nullable();
            $table->string('finish', 200)->nullable();
            $table->tinyInteger('client')->default(0);
            $table->tinyInteger('client_rep')->default(0);
            $table->tinyInteger('architech')->default(0);
            $table->tinyInteger('service_consult')->default(0);
            $table->tinyInteger('esd')->default(0);
            $table->tinyInteger('bca')->default(0);
            $table->string('sample_url')->nullable();
            $table->longText('overall_status')->nullable();
            $table->longText('comments')->nullable();
            $table->string('sample_no', 200)->nullable();
            $table->string('subcontractor', 200)->nullable();
            $table->string('location_used', 200)->nullable();
            $table->string('specification', 200)->nullable();
            $table->tinyInteger('is_alt_product')->default(0);
            $table->tinyInteger('sample_type')->default(0);
            $table->tinyInteger('data_period')->default(0);
            $table->string('warrenty_period', 200)->nullable();
            $table->string('sample_type_photo', 200)->nullable();
            $table->string('tech_data_photo', 200)->nullable();
            $table->enum('status', ['Approved', 'Rejected', 'In Progress'])->default('In Progress');
            $table->longText('signatureValues')->nullable();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
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
        Schema::dropIfExists('samples');
    }
}
