<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstProduct extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_product";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
          $table->dropColumn('product_type');
          $table->dropColumn('product_cat_id');
          $table->dropColumn('stock_code');
          $table->dropColumn('name');
          $table->dropColumn('name_origin');
          $table->dropColumn('packing');
          $table->dropColumn('moq');
          $table->dropColumn('handle_id');
          $table->dropColumn('color_id');
          $table->dropColumn('packing_id');
          $table->dropColumn('packaging_id');
          $table->dropColumn('standard_packing');
          $table->dropColumn('warning_qty');
          $table->dropColumn('purchase_price');
          $table->dropColumn('accountant_price');
          $table->dropColumn('selling_price_sample');
          $table->dropColumn('selling_price_tax');
          $table->dropColumn('product_code_old');
          $table->dropColumn('allow_order_flg');
          $table->dropColumn('warranty_year');
          $table->dropColumn('chr_feature');
          $table->dropColumn('priority_degree');
          $table->dropColumn('selling_price_retail');
          $table->dropColumn('selling_price_standard');
          $table->dropColumn('shopee_url');
          

            $table->string('describes')->nullable();
            $table->integer('product_cat1_id');
            $table->integer('product_cat2_id');
            $table->string('product_name', 255)->nullable();
            $table->integer('pakaging');
            $table->string('img', 255)->nullable();
            $table->string('notes', 255)->nullable();
            $table->string('pakagingType', 255)->nullable();
            $table->integer('warranty');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }

}