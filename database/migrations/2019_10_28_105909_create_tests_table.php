->nullable()<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('test_password')->nullable();
            $table->string('test_string')->nullable();
            $table->string('test_language')->nullable();
            $table->string('test_color', 7)->nullable();
            $table->string('test_name')->nullable();
            $table->string('test_lastname')->nullable();
            $table->string('test_email')->nullable();
            $table->string('test_telephone')->nullable();
            $table->string('test_zip')->nullable();
            $table->string('test_country', 2)->nullable();
            $table->string('test_file')->nullable();
            $table->string('test_file_mime')->nullable();
            $table->string('test_file_name')->nullable();
            $table->string('test_file_size')->nullable();
            $table->string('test_mask')->nullable();
            $table->string('test_html')->nullable();
            $table->string('test_creditcard_type')->nullable();
            $table->string('test_creditcard')->nullable();
            $table->string('test_creditcard_expiration')->nullable();
            $table->json('test_creditcard_json')->nullable();
            $table->json('test_json')->nullable();
            $table->text('test_address')->nullable();
            $table->text('test_description')->nullable();
            $table->enum('test_enum', ['yes', 'no'])->nullable();
            $table->decimal('test_decimal', 10, 2)->default(0);
            $table->float('lat_test_coordenate', 10, 6)->default(0);
            $table->float('lng_test_coordenate', 10, 6)->default(0);
            $table->integer('test_integer')->nullable();
            $table->integer('test_number')->nullable();
            $table->ipAddress('test_ip')->nullable();
            $table->boolean('test_boolean')->default(true);
            $table->date('test_date')->nullable();
            $table->year('test_year')->nullable();
            $table->point('test_point')->nullable();
            $table->polygon('test_polygon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
