<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Role column is already created in the users table migration.
    }

    public function down(): void
    {
        // Nothing to rollback because this migration does not add anything.
    }
};