<?php namespace App\Services;

class StatusService
{
    /**
     * @param $type
     * @return mixed
     */
    public function getStatus($type)
    {

        switch ($type) {
            case 1:
                return $this->getOrderStatus();
                break;
            case 2:
                return $this->getDeliveryStatus();
                break;
            case 3:
                return $this->getWarehouseExportStatus();
                break;
            case 4:
                return $this->getWarehouseImportStatus();
                break;
            default:
                return null;
        }

    }

    public function getOrderStatus()
    {
        return [
            ["status_id" => "0", "descript" => "Mới", "label" => "label label-success"],
            ["status_id" => "1", "descript" => "unKnown", "label" => "label label-primary"],
            ["status_id" => "2", "descript" => "Đang xử lý", "label" => "label label-warning"],
            ["status_id" => "4", "descript" => "Hoàn tất", "label" => "label label-info"],
            ["status_id" => "5", "descript" => "Hủy", "label" => "label label-default"],
            ["status_id" => "6", "descript" => "Hủy còn lại", "label" => "label label-default"],
            ["status_id" => "7", "descript" => "Temp_new", "label" => "label label-default"],
            ["status_id" => "8", "descript" => "Xác nhận", "label" => "label label-primary"],
        ];
    }

    public function getDeliveryStatus()
    {
        return [
            ["status_id" => "0", "descript" => "Mới", "label" => "label label-success"],
            ["status_id" => "6", "descript" => "Đóng gói", "label" => "label label-warning"],
            ["status_id" => "7", "descript" => "Xác nhận", "label" => "label label-warning"],
            ["status_id" => "1", "descript" => "Xuất kho", "label" => "label label-warning"],
            ["status_id" => "8", "descript" => "Vận chuyển", "label" => "label label-warning"],
            ["status_id" => "9", "descript" => "Khách nhận", "label" => "label label-warning"],
            ["status_id" => "4", "descript" => "Hoàn tất", "label" => "label label-info"],
            ["status_id" => "5", "descript" => "Hủy", "label" => "label label-default"],
        ];
    }

    public function getWarehouseEximStatus()
    {
        return [
            ["status_id" => "0", "descript" => "Mới", "label" => "label label-success"],
            ["status_id" => "1", "descript" => "Xuất", "label" => "label label-info"],
            ["status_id" => "2", "descript" => "Nhập", "label" => "label label-info"],
            ["status_id" => "5", "descript" => "Hủy", "label" => "label label-default"],
        ];
    }

}
