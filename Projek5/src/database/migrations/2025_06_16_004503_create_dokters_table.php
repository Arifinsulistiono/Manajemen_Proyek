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
            Schema::create('dokters', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('spesialis')->nullable(); // contoh: Umum, Gigi, Anak
                $table->string('foto')->nullable(); // path ke gambar profil dokter
                $table->integer('harga_jasa')->nullable(); // Harga Jasa
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('dokters');
        }
    };
