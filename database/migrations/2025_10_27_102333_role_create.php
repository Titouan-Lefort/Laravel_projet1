<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Bouncer::allow('creator')->to('create-univers');

        Bouncer::allow('admin')->to('create-univers');
        Bouncer::allow('admin')->to('modif-univers');
        Bouncer::allow('admin')->to('supp-univers');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
