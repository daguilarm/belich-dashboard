<?php

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
            $table->string('test_string');
            $table->string('test_language');
            $table->string('test_name');
            $table->string('test_lastname');
            $table->string('test_email');
            $table->string('test_telephone');
            $table->string('test_zip');
            $table->string('test_file');
            $table->string('test_mask');
            $table->string('test_html');
            $table->string('test_creditcard_type');
            $table->string('test_creditcard');
            $table->string('test_creditcard_expiration');
            $table->json('test_creditcard_json');
            $table->json('test_json');
            $table->text('test_address');
            $table->text('test_description');
            $table->enum('test_enum', ['yes', 'no']);
            $table->decimal('test_decimal', 10, 2)->default(0);
            $table->float('lat_test_coordenate', 10, 6)->default(0);
            $table->float('lng_test_coordenate', 10, 6)->default(0);
            $table->integer('test_integer')->unsigned()->index();
            $table->integer('test_number');
            $table->ipAddress('test_ip');
            $table->boolean('test_boolean');
            $table->date('test_date');
            $table->year('test_year');
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
