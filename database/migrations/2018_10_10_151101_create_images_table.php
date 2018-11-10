<?php
/**
 * 学校图片
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('图片名');
            $table->string('path')->comment('图片路径');
            $table->unsignedInteger('imageable_id')->nullable();
            $table->string('imageable_type')->nullable();
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
        Schema::dropIfExists('images');
    }
}
