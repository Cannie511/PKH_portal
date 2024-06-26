<?php
/**
 * Copyright(c) Phan Khang Home Co. VN, Ltd. All Rights Reserved.
 */

namespace App\Models;

/**
 * 
 * @author Nguyen Phu Cuong
 *
 */
class MstFuncConf extends BaseModel {
	protected $table = "mst_func_conf";

	/**
     * The primary key for the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** String  */
        "func_key",
        /** String  */
        "chr_val",
        /** LocalDate  */
        "dat_val",
        /** LocalDateTime  */
        "dtm_val",
        /** LocalTime  */
        "tim_val",
        /** Integer  */
        "int_val",
        /** String  */
        "txt_val",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}