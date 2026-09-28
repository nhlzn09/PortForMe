<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $t) {
            $t->string('username', 20)->nullable()->unique()->after('id');
        });
        Schema::create('portfolios', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $t->string('template', 10)->default('aurora');
            $t->string('name', 80)->nullable();
            $t->string('headline', 140)->nullable();
            $t->text('bio')->nullable();
            $t->text('skills')->nullable();
            $t->json('projects')->nullable();
            $t->string('contact', 200)->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('portfolios');
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn('username'));
    }
};
