<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('d_codigo')->nullable()->comment('Código Postal asentamiento');
            $table->string('d_asenta')->nullable()->comment('Nombre asentamiento');
            $table->string('d_tipo_asenta')->nullable()->comment('Tipo de asentamiento (Catálogo SEPOMEX)');
            $table->string('D_mnpio')->nullable()->comment('Nombre Municipio (INEGI, Marzo 2013)');
            $table->string('d_estado')->nullable()->comment('Nombre Entidad (INEGI, Marzo 2013)');
            $table->string('d_ciudad')->nullable()->comment('Nombre Ciudad (Catálogo SEPOMEX)');
            $table->string('d_CP')->nullable()->comment('Código Postal de la Administración Postal que reparte al asentamiento');
            $table->string('c_estado')->nullable()->comment('Clave Entidad (INEGI, Marzo 2013)');
            $table->string('c_oficina')->nullable()->comment('Código Postal de la Administración Postal que reparte al asentamiento');
            $table->string('c_CP')->nullable()->comment('Campo Vacio');
            $table->string('c_tipo_asenta')->nullable()->comment('Clave Tipo de asentamiento (Catálogo SEPOMEX)');
            $table->string('c_mnpio')->nullable()->comment('Clave Municipio (INEGI, Marzo 2013)');
            $table->string('id_asenta_cpcons')->nullable()->comment('Identificador único del asentamiento (nivel municipal)');
            $table->string('d_zona')->nullable()->comment('Zona en la que se ubica el asentamiento (Urbano/Rural)');
            $table->string('c_cve_ciudad')->nullable()->comment('Clave Ciudad (Catálogo SEPOMEX)');

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
        Schema::dropIfExists('postal_codes');
    }
}
