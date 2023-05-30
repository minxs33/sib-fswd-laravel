<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("category_id")->unsigned();
            $table->integer("created_by")->unsigned()->default(1);
            $table->string("name",100);
            $table->text("description");
            $table->double("price",50);
            $table->enum("status",["active", "non-active"])->default("non-active");
            $table->smallInteger("stock");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign("category_id")->references("id")->on("categories")->onUpdate("cascade")->onDelete("restrict");
            $table->foreign("created_by")->references("id")->on("users")->onUpdate("cascade")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
