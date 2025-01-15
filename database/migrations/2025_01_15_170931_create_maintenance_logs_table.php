<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceLogsTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->string('status'); // 'Aktif' atau 'Nonaktif'
            $table->timestamp('changed_at'); // Waktu perubahan status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_logs');
    }
}
