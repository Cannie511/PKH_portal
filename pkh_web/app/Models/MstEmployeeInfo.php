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
class MstEmployeeInfo extends BaseModel {
	protected $table = "mst_employee_info";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'employee_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "employee_id",
        /** String  */
        "employee_code",
        /** String  */
        "fullname",
        /** String  */
        "title",
        /** String  */
        "devision",
        /** LocalDate  */
        "dob",
        /** String  */
        "address_permernance",
        /** String  */
        "address_contact",
        /** String  */
        "card_id",
        /** LocalDate  */
        "card_id_issue_on",
        /** String  */
        "card_id_issue_at",
        /** String  */
        "tax_number",
        /** String  */
        "social_number",
        /** String  */
        "home_phone",
        /** String  */
        "tel1",
        /** String  */
        "tel2",
        /** String  */
        "nationality",
        /** String  */
        "marital_sts",
        /** String  */
        "gender",
        /** LocalDate  */
        "probation_start_date",
        /** LocalDate  */
        "probation_end_date",
        /** LocalDate  */
        "start_date",
        /** LocalDate  */
        "end_date",
        /** Integer  */
        "count_dependent_person",
        /** String  */
        "notes",
        /** String  */
        "passcode",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}