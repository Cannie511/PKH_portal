<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use Carbon\Carbon;
use App\Services\ImageService;
use App\Models\TrnCheckWarehouse;
use App\Models\TrnCheckWarehouseDetail;

class Crm0810Service extends BaseService
{
    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $productActive
     */
    public function selectListProduct($productActive)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.product_id
                , a.product_code
                , a.product_name
                , a.selling_price
            from
                mst_product a
            where
                a.active_flg = '1'
                and a.selling_price >= ?
			";

        $sql .= "
  			order by a.product_code
          ";
        $sqlParam[] = $productActive;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function loadListProduct($param)
    {
        $sqlParam = array();
        $sql      = "
                select
                a.product_id
                , a.product_code
                , a.product_name
                , a.selling_price
                , b.amount
                , b.notes
                from
                mst_product a left join trn_check_warehouse_detail b
                    on a.product_id = b.product_id
                where
                a.active_flg = '1'
                and b.check_warehouse_id = ?
                and a.selling_price >= ?
			";
        $sql .= "
  			order by a.product_code
          ";
        $sqlParam[] = $param['checkWarehouseId'];
        $sqlParam[] = $param['productActive'];

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $checkWarehouseId
     */
    public function loadCheckWareHouse($checkWarehouseId)
    {
        $sqlParam = array();
        $sql      = "
              select
                a.id
                , a.check_user_id
                , a.branch_id
                , a.check_date
                , a.notes
                , b.name as update_by
                , c.branch_name
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
                , d.name as warehouse_name
                , a.warehouse_id
                , a.checking_sts
            from
                trn_check_warehouse a
                left join users b
                    on a.check_user_id = b.id
                left join mst_branch c
                    on a.branch_id = c.branch_id
                left join mst_warehouse d
                    on a.warehouse_id = d.warehouse_id
            where
                a.id = ?
			";
        $sqlParam[] = $checkWarehouseId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $created_date
     */
    private function checkValidToChange($created_date)
    {
        $check_date  = $created_date;
        $date        = date('Y-m-d', strtotime($check_date));
        $next1Date   = date('Y-m-d', strtotime('+4 day', strtotime($check_date)));
        $mytime      = Carbon::now();
        $currentDate = date('Y-m-d', strtotime($mytime));

        if ($currentDate <= $next1Date) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $dateCheckWarehouse
     */
    public function countChecking(
        $dateCheckWarehouse,
        $warehouse_id
    ) {
        $sqlParam = array();
        $sql      = "
                select
                    count(*) as counting
                from
                    trn_check_warehouse a
                where
                    a.check_date = ? and
                    a.warehouse_id = ? and a.checking_sts != 5
			";
        $sqlParam[] = $dateCheckWarehouse;
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $dateCheckWarehouse
     */
    public function validCheckingDate(
        $dateCheckWarehouse,
        $warehouse_id
    ) {
        $num = $this->countChecking($dateCheckWarehouse, $warehouse_id);

        if ($num[0]->counting > 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $user
     * @param $productList
     * @param $checkWarehouseIdParam
     * @param $checkDateParam
     * @param $noteParam
     * @return
     */
    public function createCheckWarehouseDetail(
        $user,
        $param
    ) {
        $productList               = $param["data"];
        $checkWarehouseIdParam     = $param["checkWarehouseId"];
        $checkDateParam            = $param["checkDate"];
        $noteParam                 = $param["sumary_note"];
        $warehouse_id              = $param["warehouse_id"];
        $status                    = 1;
        $entityCheckWareHouse      = null;
        $isUpdateMode              = false;
        $id_check_warehouse        = $checkWarehouseIdParam;
        $sumaryNotesCheckWarehouse = $noteParam;
        $dateCheckWarehouse        = $checkDateParam;

        if ($id_check_warehouse) {
            $isUpdateMode = true;
        } else {

// Không được nhập kiểm kho cho 1 ngày quá 1 lần (trừ đơn huỷ)
            if (!$this->validCheckingDate($dateCheckWarehouse, $warehouse_id)) {
                return -2;
            }

        }

        if (true == $isUpdateMode) {
            // Update

            $entityCheckWareHouse = TrnCheckWarehouse::find($id_check_warehouse);

//Allowing user to change content of payment within 1 day starting from this created date
            if (!$this->checkValidToChange($entityCheckWareHouse->created_at)) {
                return -1;
            }

            $status                           = 2;
            $entityCheckWareHouse->notes      = $sumaryNotesCheckWarehouse;
            $entityCheckWareHouse->check_date = $dateCheckWarehouse;
            $this->updateRecordHeader($entityCheckWareHouse, $user, false);
        } else {
            // Create
            $isUpdateMode                        = false;
            $entityCheckWareHouse                = new TrnCheckWarehouse();
            $entityCheckWareHouse->check_user_id = $user->id;
            $entityCheckWareHouse->branch_id     = $user->branch_id;
            $entityCheckWareHouse->warehouse_id  = $warehouse_id;

            $entityCheckWareHouse->check_date = $dateCheckWarehouse;
            $this->updateRecordHeader($entityCheckWareHouse, $user, true);
        }

        $entityCheckWareHouse->notes = $sumaryNotesCheckWarehouse;

        $listCheckWarehouseDetail = [];

        foreach ($productList as $item) {
            $checkWarehouseDetail = new TrnCheckWarehouseDetail();

            if (isset($item['amount'])) {
                $checkWarehouseDetail->amount = $item['amount'];
            } else {
                $checkWarehouseDetail->amount = 0;
            }

            if (isset($item['notes'])) {
                $checkWarehouseDetail->notes = $item['notes'];
            } else {
                $checkWarehouseDetail->notes = null;
            }

            $checkWarehouseDetail->product_id = $item['product_id'];
            $checkWarehouseDetail->seq_no     = $item['seq_no'];
            $checkWarehouseDetail->unit_price = $item['unit_price'];
            $this->updateRecordHeader($checkWarehouseDetail, $user, true);
            $listCheckWarehouseDetail[] = $checkWarehouseDetail;
        }

        DB::transaction(function () use ($entityCheckWareHouse, $id_check_warehouse, $listCheckWarehouseDetail) {
            $entityCheckWareHouse->save();
            TrnCheckWarehouseDetail::where('check_warehouse_id', $id_check_warehouse)->delete();

            foreach ($listCheckWarehouseDetail as $detail) {
                $detail->check_warehouse_id = $entityCheckWareHouse->id;
                $detail->save();
            }

        });

        return $status;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        // $param['export'] = true;
        $data = $this->loadListProduct($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "DanhSachKiemKho_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('Tonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0810-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

    /**
     * @param $param
     */
    public function cancelCheckWarehouse($param)
    {
        $checkWarehouse = TrnCheckWarehouse::find($param["check_warehouse_id"]);

        if (isset($checkWarehouse)) {

            if ('1' == $checkWarehouse->checking_sts) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Kiểm kho đã được xác nhận",
                ];
            }

            $checkWarehouse->checking_sts = "5";
            $checkWarehouse->notes        = ' ' . $checkWarehouse->notes . $param["notes"];

            $checkWarehouse->save();

            return [
                "rtnCd" => true,
                "msg"   => "Đã hủy ",
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Đợt kiểm không tồn tại.",
        ];
    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "crm0810";
        $fileName     = $this->imageService->uploadImage($newsId, $base64Img, $locationName);

        return [
            "rtnCd"    => true,
            "fileName" => $fileName,
        ];
    }

    /**
     * @param $param
     */
    public function loadImages($param)
    {
        $locationName = "crm0810";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
    }

}
