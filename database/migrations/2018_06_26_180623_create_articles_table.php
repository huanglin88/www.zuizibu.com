<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('article_category_id');

            $table->unsignedInteger('views')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('cover')->nullable();
            $table->text('content');
            $table->text('abstract')->comment('摘要');
            $table->unsignedTinyInteger('sort')->default(0)->comment('排序权重 越大越靠前 255最大');
            $table->timestamps();
            $table->softDeletes();

            $table->index('article_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
