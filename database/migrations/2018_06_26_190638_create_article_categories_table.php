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
            $table->string('name', 50)->comment('名称');
            $table->string('slug');
            $table->string('logo')->comment('LOG图')->nullable();
            $table->string('invitation_code')->comment('邀请码')->nullable();
            $table->string('code_img')->comment('下载二维码')->nullable();
            $table->string('android_download_url')->comment('安卓下载地址')->nullable();
            $table->string('ios_download_url')->comment('IOS下载地址')->nullable();
            $table->text('content')->nullable();
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
