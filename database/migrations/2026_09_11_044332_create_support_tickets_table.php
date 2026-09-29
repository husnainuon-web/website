
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_tickets', function (Blueprint $table) {

            $table->id();

            // Customer who created the support request
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Support request subject
            $table->string('subject');

            // Customer message
            $table->text('message');

            // Admin reply
            $table->text('admin_reply')->nullable();

            // Support request status
            $table->enum('status', [
                'pending',
                'in_progress',
                'resolved',
                'closed',
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
