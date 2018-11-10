<?php
/**
 * 文章分类
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('name', 50)->comment('名称');
            $table->string('slug');
            $table->text('content');
            $table->unsignedTinyInteger('sort')->default(0)->comment('排序权重 越大越靠前 255最大');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
