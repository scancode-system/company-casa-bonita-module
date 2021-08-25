<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Pdf\Repositories\PdfLayoutRepository;

class InsertPdfLayoutsRecordsCompanyCasaBonita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PdfLayoutRepository::create(['title' => 'Casa Bonita - Compactado', 'description' => 'Layout Compactado', 'path' => 'companycasabonita::pdf.order']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PdfLayoutRepository::deleteByTitle('Casa Bonita - Compactado');
    }
}

 