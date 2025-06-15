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
        Schema::create('donations', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key

            // Foreign key ke user (nullable jika guest donation diizinkan)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Foreign key ke campaign (referensi ke campaign_id di tabel campaigns)
            $table->unsignedBigInteger('campaign_id'); // Ganti foreignId() dengan unsignedBigInteger
            $table->foreign('campaign_id')->references('campaign_id')->on('campaigns')->onDelete('cascade');

            // Jumlah donasi
            $table->decimal('amount', 15, 2);

            // Metode pembayaran: transfer, e-wallet, dsb
            $table->string('payment_method')->nullable();

            // Review atau pesan dari donatur (opsional)
            $table->text('review_text')->nullable();

            // Tanggal donasi
            $table->date('donation_date');

            // Menambahkan kolom created_at dan updated_at
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at secara otomatis

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
