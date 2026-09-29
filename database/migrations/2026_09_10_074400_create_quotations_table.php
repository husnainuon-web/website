
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
        Schema::create('quotations', function (Blueprint $table) {

            $table->id();

            // Customer who requested the quotation
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Product for which quotation is requested
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Requested quantity
            $table->unsignedInteger('quantity')
                ->default(1);

            // Customer message / requirements
            $table->text('message')
                ->nullable();

            // Quotation status
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            // Admin response
            $table->text('admin_message')
                ->nullable();

            // Quoted price
            $table->decimal('quoted_price', 12, 2)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

