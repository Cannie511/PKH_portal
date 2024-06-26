<?php namespace App\Services;

use DB;
use Log;
use PDF;
use Auth;
use File;
use Cache;
use Excel;
use App\Models\DownloadManagement;

/**
 * Order Service
 */
class DownloadService extends BaseService
{
    /**
     * @param $param
     */
    private function recordDownloadActivities($param)
    {
        $user                     = Auth::user();
        $entityDownload           = new DownloadManagement();
        $entityDownload->descript = $param["descript"];
        $entityDownload->screen   = $param["view"];
        //$entityDownload->note = $param[];
        $this->updateRecordHeader($entityDownload, $user, true);

        DB::transaction(function () use ($entityDownload) {
            $entityDownload->save();
        });
    }

    /**
     * @param $param
     * @return mixed
     */
    public function downloadPDFFile($param)
    {

// 0: 'landscape'
        // 1: 'portrait'
        $paper = $param["paper"];
        $type  = 0 == $param["type"] ? "landscape" : "portrait";

        $view       = $param["view"];
        $data       = $param["data"];
        $fileName   = $param["file_name"];
        $folderName = $param["folder_name"];
        Log::debug($param);
        // TODO: set password
        // $pdf->getDomPDF()->get_canvas()->get_cpdf()->setEncryption('test');
        // $pdfInstance = PDF::getDomPDF();
        $pdf = PDF::loadView('admin.pdfs.' . $view, $data)

// ->set_option('isPhpEnabled', true)
        // ->setOptions('isPhpEnabled', true)
            ->setPaper($paper, $type);


        // $pdf->getDomPDF()->get_canvas()->get_cpdf()->setEncryption('userpass', 'ownerpass', array('print', 'copy'));

// $pdf->set_option('isPhpEnabled', true);
        // $pdf->getDomPDF()->set_option('isPhpEnabled', true);

        $pdfName = 'PKH_' . $fileName . "_" . uniqid(true) . ".pdf";

        // Create path if not exist
        $path = storage_path('app/pdf/' . $folderName . '/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        
        // Save file
        $pdf->save($path . $pdfName);

        $result = [
            'url'   => ['/pdf/' . $folderName . '/' . $pdfName],
            'rtnCd' => true,
        ];

        $param["descript"] = "pdf";
        $this->recordDownloadActivities($param);
        //$this->recordDownloadActivities($param);

        return $result;
    }

    /**
     * [Download excel file description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function downloadExcelFile($param)
    {
        $data = $param["data"];

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName  = 'PKH_' . $param["file_name"] . "_" . date('ymdhis');
        $ext       = "xlsx";
        $sheetName = $param["file_name"];
        $view      = $param['view'];

        ob_end_clean();
        ob_start();
        Excel::create($fileName, function ($excel) use ($data, $sheetName, $view) {
            $excel->sheet($sheetName, function ($sheet) use ($data, $view) {
                $sheet->loadView('admin.excels.' . $view)
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

        $param["descript"] = "excel";
        $this->recordDownloadActivities($param);

        return $result;
    }

    /**
     * Export excel with multple sheet
     *
     * @param [type] $params
     *  + file_name: Filename
     *  + sheets: array
     *      + name: sheet name
     *      + data: array of data
     *      + view: view of sheet
     * @return void
     */
    public function downloadExcelFileMultiSheets($params)
    {
        $sheetsData = $params["sheets"];

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = 'PKH_' . $params["file_name"] . "_" . date('ymdhis');
        $ext      = "xlsx";

        ob_end_clean();
        ob_start();
        Excel::create($fileName, function ($excel) use ($sheetsData) {

            foreach ($sheetsData as $sheetData) {
                $sheetName = $sheetData["name"];
                $view      = $sheetData["view"];
                $data      = $sheetData["data"];

                $excel->sheet($sheetName, function ($sheet) use ($data, $view) {
                    $data["sheet"] = $sheet;
                    $sheet->loadView('admin.excels.' . $view)
                        ->with('data', $data);
                });
            }

        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        $params["descript"] = "excel";
        $this->recordDownloadActivities($params);

        return $result;
    }
}
