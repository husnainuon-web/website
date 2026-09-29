```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_views', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->after('user_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->unique(
                ['user_id', 'product_id'],
                'product_views_user_product_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('product_views', function (Blueprint $table) {

            $table->dropUnique(
                'product_views_user_product_unique'
            );

            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);

            $table->dropColumn([
                'user_id',
                'product_id',
            ]);
        });
    }
};

