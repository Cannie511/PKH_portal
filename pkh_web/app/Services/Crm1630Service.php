<?php
namespace App\Services;

use DB;
use Log;
use Mail;
use Carbon\Carbon;
use App\Services\ImageService;
use App\Models\TrnImportWhStore;
use App\Models\TrnImportWhFactory;
use App\Models\TrnWarehouseChange;
use App\Models\TrnOrderEditRequest;
use App\Models\TrnImportWhStoreDetail;

/**
 * Crm1630Service class
 */
class Crm1630Service extends BaseService
{
    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $importWhFacId
     * @return mixed
     */
    public function selectImportWhFac($importWhFacId)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.import_wh_factory_id
                , a.warehouse_id
                , a.supplier_id
                , a.import_date
                , a.notes
                , a.active_flg
                , b.pi_no
                , c.name
            from
                trn_import_wh_factory a
                left join trn_supplier_delivery b
                    on a.supplier_id = b.supplier_delivery_id
                left join mst_supplier c
                    on b.supplier_id = c.supplier_id
            where
                a.import_wh_factory_id = ?
        ";
        $sqlParam[] = $importWhFacId;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        return $result[0];
    }

    /**
     * @param $importWhFacId
     * @return mixed
     */
    public function selectWarehouseChange($importWhFacId)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.warehouse_change_type
                , a.product_id
                , a.changed_date
                , a.amount
                , a.import_wh_factory_id
                , a.active_flg
                , b.product_code
                , b.stock_code
                , b.name product_name
                , b.standard_packing
            from
                trn_warehouse_change a
                left join mst_product b
                    on a.product_id = b.product_id
            where
                a.active_flg = 1
                and a.warehouse_change_type = 1
                and a.import_wh_factory_id = ?
        ";
        $sqlParam[] = $importWhFacId;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $key
     */
    public function checkInImportFactory(
        $param,
        $key
    ) {

        if (!isset($param[$key])) {
            return true;
        }

        $supplierDeliveryId = $param[$key];
        $sqlParam           = array();
        $sql                = "
            select
                *
            from
                trn_import_wh_factory a
            where
                a.supplier_id = ?
        ";
        $sqlParam[] = $supplierDeliveryId;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (null != $result) {
            return true;
        }

        return false;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function makeDataForFacEntity(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        $today  = date('Y-m-d', strtotime($today1));

        if (isset($param['import_wh_factory_id']) && $param['import_wh_factory_id'] > 0) {
            $importEntity = TrnImportWhFactory::find($param['import_wh_factory_id']);
            $this->updateRecordHeader($importEntity, $user, false);
            $importEntity->active_flg = 1;
        } else {

            if ($this->checkInImportFactory($param, 'supplier_delivery_id')) {
                return null;
            }

            $importEntity               = new TrnImportWhFactory();
            $importEntity->active_flg   = 0; // turn off for warehouseman turn on
            $importEntity->supplier_id  = $this->takeValueFromParam($param, 'supplier_delivery_id');
            $importEntity->warehouse_id = $this->takeValueFromParam($param, 'warehouse_id');
            $this->updateRecordHeader($importEntity, $user, true);
        }

        $importEntity->import_date = $today;
        $importEntity->notes       = $this->takeValueFromParam($param, 'notes');

        return $importEntity;
    }

/*
parameters:
+ user
+ param:
- detail : array [(product_id, amount)]
tables:
+  TrnWarehouseChange
Usage: Create record in TrnWarehouseChange
 */
    /**
     * @param $user
     * @param $param
     * @param $type
     * @return mixed
     */
    public function makeDataForWarehouseChange(
        $user,
        $param,
        $type,
        $warehouse_id
    ) {

        if (!isset($param['detail'])) {
            return null;
        }

        $today1           = Carbon::now();
        $today            = date('Y-m-d', strtotime($today1));
        $importDetail     = $param['detail'];
        $listImportDetail = array();

        foreach ($importDetail as $item) {
            $import                        = new TrnWarehouseChange();
            $import->product_id            = $item['product_id'];
            $import->changed_date          = $today;
            $import->warehouse_change_type = $type;
            $import->warehouse_id          = $warehouse_id;
            $import->branch_id             = $user->branch_id;
            $import->amount                = intval($item['amount']);
            $this->updateRecordHeader($import, $user, true);
            $listImportDetail[] = $import;
        }

        return $listImportDetail;
    }

/*
parameters:
+ user
+ param:
- import_wh_factory_id
- detail : array [(product_id, amount)]
- supplier_delivery_id
- notes
tables:
+  TrnWarehouseChange
+  TrnImportWhFactory
Usage:
+ Save infor in  TrnImportWhFactory
+ Save infor in  TrnWarehouseChange
 */
    /**
     * @param $user
     * @param $param
     * @return int
     */
    public function createImportForFac(
        $user,
        $param
    ) {
        $importEntity = $this->makeDataForFacEntity($user, $param);

        if (null == $importEntity) {
            return 0;
        }

        DB::transaction(function () use ($importEntity, $param) {
            $importEntity->save();
        });

        return 1;
    }

    /**
     * @param $param
     * @param $key
     * @return mixed
     */
    public function takeValueFromParam(
        $param,
        $key
    ) {

        if (isset($param[$key])) {
            return $param[$key];
        }

        return "";
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function makeDataForStoreEntity(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        $today  = date('Y-m-d', strtotime($today1));

        if (isset($param['import_wh_store_id']) && $param['import_wh_store_id'] > 0) {
            // Nội dung này chỉ được thực hiện 1 lần lúc accept => CẬp nhật lại đơn cũ
            $importEntity             = TrnImportWhStore::find($param['import_wh_store_id']);
            $importEntity->import_sts = 1; // Đã nhập
            $this->updateRecordHeader($importEntity, $user, false);
        } else {
            $importEntity              = new TrnImportWhStore();
            $importEntity->import_type = $this->takeValueFromParam($param, 'import_type');
            $importEntity->store_id    = $this->takeValueFromParam($param, 'store_id');
            // $importEntity->warehouse_id    = $this->takeValueFromParam($param, 'warehouse_id');
            $importEntity->import_date = $today;
            $importEntity->import_sts  = 0; // status 0 is new
            $importEntity->salesman_id = $this->takeValueFromParam($param, 'salesman_id');
            $this->updateRecordHeader($importEntity, $user, true);
        }

        $importEntity->warehouse_id = $this->takeValueFromParam($param, 'warehouse_id');
        $importEntity->notes        = $this->takeValueFromParam($param, 'notes');

        return $importEntity;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function makeDataForStoreDetail(
        $user,
        $param
    ) {
        $importDetail     = $param['detail'];
        $listImportDetail = array();

        foreach ($importDetail as $item) {
            $import             = new TrnImportWhStoreDetail();
            $import->product_id = $item['product_id'];
            $import->amount     = intval($item['amount']);
            $this->updateRecordHeader($import, $user, true);
            $listImportDetail[] = $import;
        }

        return $listImportDetail;
    }

/*
parameters:
+ user
+ param:
- import_wh_store_id
- detail : array [(product_id, amount)]
- import_type
- store_id
- salesman_id
- notes
 */
    /**
     * @param $user
     * @param $param
     * @return int
     */
    public function createImportForStore(
        $user,
        $param
    ) {
        $listImportDetail = $this->makeDataForStoreDetail($user, $param);
        $importEntity     = $this->makeDataForStoreEntity($user, $param);

        DB::transaction(function () use ($importEntity, $listImportDetail, $param) {
            $importEntity->save();

            if (isset($param['import_wh_store_id'])) {
                // Delete TrnStoreDeliveryDetail
                TrnImportWhStoreDetail::where('import_wh_store_id', $param['import_wh_store_id'])->delete();
            }

// Create detail
            foreach ($listImportDetail as $detail) {
                $detail->import_wh_store_id = $importEntity->import_wh_store_id;
                $detail->save();
            }

        });

        return 1;
    }

    /**
     * @param $importWhStoreId
     * @return mixed
     */
    public function getTrnImportWhStore($importWhStoreId)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.import_wh_store_id
                , a.warehouse_id
                , a.import_type
                , a.store_id
                , a.import_date
                , a.total
                , a.salesman_id
                , b.name salesman_name
                , a.notes
            from
                trn_import_wh_store a
                left join users b
                on a.salesman_id =b.id
            where
                a.active_flg = 1 and
                a.import_wh_store_id = ?
        ";
        $sqlParam[] = $importWhStoreId;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        return $result[0];
    }

    /**
     * @param $importWhStoreId
     * @return mixed
     */
    public function getTrnImportWhStoreDetail($importWhStoreId)
    {
        $sqlParam = array();
        $sql      = "
            select
                 a.product_id
                , a.amount
                , b.product_code
                , b.stock_code
                , b.name product_name
                , b.standard_packing
            from
                trn_import_wh_store_detail a
                left join mst_product b
                on a.product_id =b.product_id
            where
                a.active_flg = 1
                and a.import_wh_store_id = ?
        ";
        $sqlParam[] = $importWhStoreId;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

/*
đóng gói các sản phẩm request nhập kho ảo thành dạng string json và lưu vào note tương ứng
 */
    /**
     * @param $list
     * @return mixed
     */
    private function packProduct($list)
    {
        $newList = [];
        $ok      = true;
        foreach ($list as $item) {
            $newItem = [];
            if (isset($item["product_id"])) {
                $newItem["id"] = $item["product_id"];
            } else {
                $ok = false;
                break;
            }

            if (isset($item["amountImport"])) {
                $newItem["amount"] = $item["amountImport"];
            } else {
                $ok = false;
                break;
            }

            array_push($newList, $newItem);
        }

        $packData = json_encode($newList);
        $res      = [
            'data' => $packData,
            'sts'  => $ok,
        ];

        return $res;
    }

    /**
     * @param $type
     * @param $logonUser
     * @param $id
     */
    private function sendMailTo(
        $type,
        $logonUser,
        $id
    ) {
        $param = [];

        $recievedUsers = ['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com', 'khangduyth@gmail.com '];

        if (4 == $type) {
            $param['type'] = "Nhập hàng nhà máy vào kho ảo portal";
            $URL           = '/crm1630//' . '1/' . $id;
        } elseif (5 == $type) {
            $param['type'] = "Nhập hàng bảo hành vào kho ảo portal";
            $URL           = '/crm1630//' . '2/' . $id;
        } elseif (6 == $type) {
            $param['type'] = 'Nhập hàng trả lại vào kho ảo portal';
            $URL           = '/crm1630//' . '2/' . $id;
        }

        $param['notes']            = "";
        $param['user']             = $logonUser->name;
        $param['user_mail']        = $logonUser->email;
        $param['url']              = $URL;
        $param['store_order_code'] = "";
        // Send email
        Mail::queue('admin.emails.request_edit', ['param' => $param], function ($m) use ($recievedUsers, $logonUser, $param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to($recievedUsers, '[PKH-PORTAL]')->subject('[PHK-Portal] Y/c xu ly nhap kho #' . " - " . $logonUser->name);
        });
    }

/*
request type:
1: Huy đặt
2: Hủy phiếu xuất
3: Hủy hàng còn
4: Nhập từ nhà máy
5: Nhập bảo hành
6: Nhập trả lại
request sts:
0: pending
1: accept
2: deny
type:
1: factory
2: store
import_type:
1: bảo hành
2: trả lại
 */
    /**
     * @param $param
     */
    public function addRequestImport($param)
    {
        $type = 0;

// type=1 là request nhập hàng nhà máy , type =2 là request nhập trả lại, bảo hành
        if (1 == $param["type"]) {
            $type      = 4;
            $id        = $param["infoFac"]["import_wh_factory_id"];
            $arrayList = [4];
        } else {

// import_type= 1 là bảo hành, 2 là trả lại

// Trong order_edit_request thì type = 5 là bảo hành , 6 là trả lại
            if (1 == $param["import_type"]) {
                $type = 5;
            } else {
                $type = 6;
            }

            $arrayList = [5, 6];
            $id        = $param["infoStore"]["import_wh_store_id"];
        }

//Nếu không tồn tại loại thì không xử lý
        if (0 == $type) {
            return null;
        }

        //Đếm số lượng đơn đang pending
        $countPending =
        TrnOrderEditRequest::where('ref_id', $id)
            ->whereIn('request_type', $arrayList)
            ->where('request_sts', '0')->count();

        if ($countPending > 0) {
            return null;
        }

        //Đếm số lượng đơn đã accept
        $countAccept =
        TrnOrderEditRequest::where('ref_id', $id)
            ->whereIn('request_type', $arrayList)
            ->where('request_sts', '1')->count();

// Nếu tồn tại 1 request của đơn ở trạng thái pending hay accept thì không cho request nữa
        if ($countAccept > 0) {
            return null;
        }

        // Chuyển các sản phẩm request import thành dạng string json
        $res      = $this->packProduct($param["detail"]);
        $packData = $res['data'];
        $sts      = $res['sts'];

        if (false == $sts) {
            return [
                'sts' => false,
                'msg' => 'Please fill in the amount to import',
            ];
        }

        $logonUser            = $this->logonUser();
        $entity               = new TrnOrderEditRequest();
        $entity->request_type = $type;
        $entity->request_sts  = '0';
        // ref_id lưu thông tin id của import_wh_store
        $entity->ref_id = $id;
        //Đóng gói dữ liệu request nhập kho ảo lưu vào note để lúc init unpack ra sử dụng
        $entity->request_notes = $packData;
        $entity->request_date  = Carbon::today();
        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();
        $this->sendMailTo($type, $logonUser, $id);

        return [
            'sts' => true,
            'msg' => 'Create request successfully',
        ];
    }

/*
Chọn ra một list request với các type và ref_id tương ứng
type:
4: Nhập từ nhà máy
5: Nhập bảo hành
6: Nhập trả lại
ref_id lúc này sẽ trỏ vào id của TrnImportWhStore hoặc TrnImportWhFac
 */
    /**
     * @param $importId
     * @param $flag
     */
    public function selectRequestList(
        $importId,
        $flag
    ) {
        $sqlParam = [$importId];

        if (1 == $flag) {
            // Factory
            $arrayList = " (4) ";
        } else {
            // Store
            $arrayList = " (5,6) ";
        }

        $sql = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
            where
              ref_id = ?
              and request_type in " . $arrayList . "  and a.active_flg = '1'
        ";

        $sql .= "
            order by a.request_id desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

/*
Khi deny thì chuyển trạng thái request_sts sang 2 và return thông báo
 */
    /**
     * @param $params
     */
    public function deny($params)
    {
        $entity = TrnOrderEditRequest::find($params["request_id"]);

        if ($entity) {
            $logonUser              = $this->logonUser();          // get current user information
            $entity->response_notes = $params["notes"];            // response note
            $entity->request_sts    = 2;                           // 2 is deny
            $this->updateRecordHeader($entity, $logonUser, false); // update common information
            $entity->save();

            return [
                'rtnCd' => true,
                'msg'   => 'Cập nhật thành công.',
            ];
        }

    }

/*
Nhap dữ liệu vào kho ảo warehouse change
Return :
+ 0: Fail
+ 1: success
 */
    /**
     * @param $flag
     * @param $user
     * @param $param
     * @param $entityWhStore
     * @return int
     */
    public function createImportForWarehouseChange(
        $flag,
        $user,
        $param,
        $entityWhStore
    ) {

        if (2 == $flag) {
            $typeWhStore = $entityWhStore->import_type;
            $ref_id      = $entityWhStore->import_wh_store_id;

            if (1 != $typeWhStore && 2 != $typeWhStore) {
                return 0;
            }

            if (null == $ref_id) {
                return 0;
            }

            if (1 == $typeWhStore) {
                // Ứng với import_type trong TrnImportWhStore là 1 thì trong TrnImportWhChange là 5 (bảo hành)
                $type = 5;
            } elseif (2 == $typeWhStore) {
                // Ứng với import_type trong TrnImportWhStore là 2 thì trong TrnImportWhChange là 6 {Trả lại)}
                $type = 6;
            }

        } elseif (1 == $flag) {
            $ref_id = $entityWhStore->import_wh_factory_id;
            $type   = 1;
        }

        $warehouse_id = $entityWhStore->warehouse_id;

        $listImportDetail = $this->makeDataForWarehouseChange($user, $param, $type, $warehouse_id);

        if (!$listImportDetail) {
            return 0;
        }

        DB::transaction(function () use ($listImportDetail, $ref_id) {

// Create detail
            foreach ($listImportDetail as $detail) {
                $detail->import_wh_factory_id = $ref_id;
                $detail->save();
            }

        });

        return 1;
    }

/*
Lọc ra những phần tử chưa nhập kho ảo để tách ra một đơn mới
 */
    /**
     * @param $params
     * @param $entity
     * @return mixed
     */
    private function prepareDetaiForNewOrder(
        $params,
        $entity
    ) {
        $newsParam         = [];
        $detailForNewOrder = [];

        foreach ($params["detail"] as $item) {
            $newItem = [];

            if ($item["amount"] > $item["amountImport"]) {
                $newItem["product_id"] = $item["product_id"];
                $newItem["amount"]     = $item["amount"] - $item["amountImport"]; // get different amount between amount and amountImport
                array_push($detailForNewOrder, $newItem);
            }

        }

        $newsParam["detail"]       = $detailForNewOrder;
        $newsParam["warehouse_id"] = $entity->warehouse_id;
        $newsParam["store_id"]     = $entity->store_id;
        $newsParam["salesman_id"]  = $entity->salesman_id;
        $newsParam["import_type"]  = $entity->import_type;
        $newsParam["notes"]        = "Split from " . $entity->import_wh_store_id;

        return $newsParam;
    }

/*
Chuẩn bị thông tin để nhập kho ảo
 */
    /**
     * @param $params
     * @return mixed
     */
    private function prepareDetaiForImportWhChange($params)
    {
        $newsParam = [];
        $detail    = [];

        foreach ($params["detail"] as $item) {
            $newItem               = [];
            $newItem["product_id"] = $item["product_id"];

            if (isset($item["amountImport"])) {
                $newItem["amount"] = $item["amountImport"];
            } else {
                $newItem["amount"] = 0;
            }

            array_push($detail, $newItem);
        }

        $newsParam["detail"] = $detail;

        return $newsParam;
    }

/*
Update detail when aprove import to TrnWhChange
 */
    /**
     * @param $params
     * @param $entity
     * @return mixed
     */
    private function updateDetaiForOldOrder(
        $params,
        $entity
    ) {
        $detailForNewOrder = [];

        foreach ($params["detail"] as $item) {
            $newItem               = [];
            $newItem["product_id"] = $item["product_id"];

            if (isset($item["amountImport"])) {
                $newItem["amount"] = $item["amountImport"];
            } else {
                $newItem["amount"] = 0;
            }

            array_push($detailForNewOrder, $newItem);
        }

        $entity->detail = $detailForNewOrder;

        return $entity;
    }

    /**
     * @param $entity
     * @param $params
     */
    private function updateStatusAccept(
        $entity,
        $params
    ) {

        if ($entity) {
            $logonUser              = $this->logonUser();          // get current user information
            $entity->response_notes = $params["notes"];            // response note
            $entity->request_sts    = 1;                           // 2 is deny
            $this->updateRecordHeader($entity, $logonUser, false); // update common information
            $entity->save();

            return [
                'rtnCd' => true,
                'msg'   => 'Cập nhật thành công.',
            ];
        }

        return [
            'rtnCd' => false,
            'msg'   => 'Cập nhật thất bại.',
        ];
    }

    /**
     * @param $params
     * @param $entity
     * @return mixed
     */
    private function acceptForStore(
        $params,
        $entity
    ) {
        // Get information of record in TrnImportWhStore
        $entityWhStore = TrnImportWhStore::find($entity->ref_id);

        if (null == $entity || null == $entityWhStore) {
            // can not find request
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy yêu cầu',
            ];
        }

        $flag = 2;
        // update status accept for entity and save in db
        $updateMsg = $this->updateStatusAccept($entity, $params);

        if (false == $updateMsg["rtnCd"]) {
            // Không cập nhật trạng thái request thành công
            return $updateMsg;
        }

        // Chuẩn bị thông tin để tách 1 đơn nhập mới từ đơn cũ (nếu có)
        $newOrder = $this->prepareDetaiForNewOrder($params, $entityWhStore);
        // Lượng hàng sẽ cập nhật vào kho ảo
        $newParam = $this->prepareDetaiForImportWhChange($params);
        // Prepare information update for old record
        $entityWhStore = $this->updateDetaiForOldOrder($params, $entityWhStore);
        // Lấy thông tin user hiện hành
        $user = $this->logonUser();
        // Nhập lượng hàng request vào kho ảo
        $oke = $this->createImportForWarehouseChange($flag, $user, $newParam, $entityWhStore);

        if (0 == $oke) {
            return [
                'rtnCd' => false,
                'msg'   => 'Đã có lỗi xảy ra',
            ];
        }

        // Cập nhật lại lượng hàng ở đơn request
        $this->createImportForStore($user, $entityWhStore);

// Nếu có phần tử nào không nhập kho thì tách ra 1 đơn mới
        if (count($newOrder["detail"]) > 0) {
            // Tạo 1 đơn nhập hàng mới từ những mã hàng còn lại chưa nhập
            $this->createImportForStore($user, $newOrder);
        }

        return $updateMsg;
    }

    /**
     * @param $params
     * @param $entity
     * @return mixed
     */
    private function acceptForFac(
        $params,
        $entity
    ) {
        // Get information of record in TrnImportWhFac
        $entityWhFac = TrnImportWhFactory::find($entity->ref_id);

        if (null == $entity || null == $entityWhFac) {
            // can not find request
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy yêu cầu',
            ];
        }

        $flag = 1;

        // update status accept for entity and save in db
        $updateMsg = $this->updateStatusAccept($entity, $params);

        if (false == $updateMsg["rtnCd"]) {
            // Không cập nhật trạng thái request thành công
            return $updateMsg;
        }

        // Lượng hàng sẽ cập nhật vào kho ảo
        $newParam = $this->prepareDetaiForImportWhChange($params);
        // Lấy thông tin user hiện hành
        $user = $this->logonUser();
        // Nhập lượng hàng request vào kho ảo
        $oke = $this->createImportForWarehouseChange($flag, $user, $newParam, $entityWhFac);

        if (0 == $oke) {
            return [
                'rtnCd' => false,
                'msg'   => 'Đã có lỗi xảy ra',
            ];
        }

        // Cập nhật lại lượng hàng ở đơn request
        $this->createImportForFac($user, $entityWhFac);

        return $updateMsg;

    }

    /**
     * @param $params
     * @return mixed
     */
    public function accept($params)
    {
        $entity = TrnOrderEditRequest::find($params["request_id"]);

        if (5 == $entity->request_type || 6 == $entity->request_type) {
            return $this->acceptForStore($params, $entity);
        } elseif (4 == $entity->request_type) {
            return $this->acceptForFac($params, $entity);
        }

        return [
            'rtnCd' => false,
            'msg'   => 'Đã có lỗi xảy ra',
        ];
    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "crm1630";
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
        $locationName = "crm1630";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
    }

}
