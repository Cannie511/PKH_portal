<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionStoresTable extends Migration
{
    public function up()
    {
        Schema::create('promotion_stores', function (Blueprint $table) {
            $table->increments('id'); // Tạo cột 'id' tự động tăng
            $table->unsignedBigInteger('store_id'); // Cột 'store_id' kiểu BigInteger không âm
            $table->integer('year'); // Cột 'year' kiểu integer
            $table->integer('quarter'); // Cột 'quarter' kiểu integer
            $table->integer('total_score_card'); // Cột 'total_score_card' kiểu integer
            $table->integer('discount'); // Cột 'discount' kiểu decimal với 2 chữ số sau dấu phẩy
            $table->integer('voucher'); // Cột 'voucher' kiểu chuỗi, có thể null
            $table->string('type_promotion'); // Cột 'type_promotion' kiểu chuỗi
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotion_stores'); // Xóa bảng 'promotion_stores' nếu tồn tại
    }
}
