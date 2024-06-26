<?php

namespace App\Services;

use DB;
use Image;
use Carbon\Carbon;
use App\Models\MstNews;
use Illuminate\Support\Str;
use App\Services\ImageService;

/**
 * Cms0210Service class
 */
class Cms0210Service extends BaseService
{
    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $newsId
     */
    public function loadNews($newsId)
    {
        $sqlParam = array();
        $sql      = "
                select
                a.id
                , a.title
                , a.publish_date
                , a.slug
                , a.title
                , a.description
                , a.keywords
                , a.content
                , a.short_content
                , a.feature_image_path
                , a.show_flg
                from
                mst_news a
                where
                a.id = ?
            ";
        $sqlParam[] = $newsId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $slug
     * @param $id
     */
    public function selectSlug(
        $slug,
        $id
    ) {
        $sqlParam = [];
        $sql      = "
            select
              count(a.slug) as countSlug
            from
              mst_news a
            where
              a.slug like ? and a.id <> ?
        ";
        $sqlParam[] = $slug . '%';
        $sqlParam[] = $id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $news
     * @return mixed
     */
    public function createNews($news)
    {
        $user         = $this->logonUser();
        $entityNews   = null;
        $isUpdateMode = false;

        if ($news['id'] > 0) {
            $isUpdateMode = true;
        }

        if (true == $isUpdateMode) {
            // Update
            $entityNews               = MstNews::find($news['id']);
            $entityNews->id           = $news['id'];
            $entityNews->publish_date = $news['publishDate'];
            $entityNews->title        = $news['title'];

            if (!empty($news['slug'])) {
                $entityNews->slug = Str::lower($news['slug']);
            } else {
                $entityNews->slug = Str::lower(str_slug($news['title'], '-'));
            }

            $count = $this->selectSlug($entityNews->slug, $news['id']);

            if ($count[0]->countSlug > 0) {
                $entityNews->slug = $entityNews->slug . '_' . $count[0]->countSlug;
            }

            if (isset($news['description'])) {
                $entityNews->description = $news['description'];
            }

            if (isset($news['keywords'])) {
                $entityNews->keywords = $news['keywords'];
            }

            if (isset($news['content'])) {
                $entityNews->content = $news['content'];
            }

            if (isset($news['short_content'])) {
                $entityNews->short_content = $news['short_content'];
            }

            $this->updateRecordHeader($entityNews, $user, false);
            $entityNews->show_flg   = 1;
            $entityNews->active_flg = 1;
            $entityNews->created_at = Carbon::today();
        } else {
            // Create
            $entityNews               = new MstNews();
            $entityNews->publish_date = $news['publishDate'];
            $entityNews->title        = $news['title'];

            if (!empty($news['slug'])) {
                $entityNews->slug = Str::lower($news['slug']);
            } else {
                $entityNews->slug = Str::lower(str_slug($news['title'], '-'));
            }

            $count = $this->selectSlug($entityNews->slug, -1);

            if ($count[0]->countSlug > 0) {
                $entityNews->slug = $entityNews->slug . '_' . $count[0]->countSlug;
            }

            if (isset($news['description'])) {
                $entityNews->description = $news['description'];
            }

            if (isset($news['keywords'])) {
                $entityNews->keywords = $news['keywords'];
            }

            if (isset($news['content'])) {
                $entityNews->content = $news['content'];
            }

            if (isset($news['short_content'])) {
                $entityNews->short_content = $news['short_content'];
            }

            $this->updateRecordHeader($entityNews, $user, true);
            $entityNews->show_flg   = 0;
            $entityNews->active_flg = 1;
            $entityNews->created_at = Carbon::today();
        }

        $entityNews->save();

        if (isset($news['file'])) {
            $thumbFilePath = $this->imageService->saveNewsFeatureThumb($entityNews->id, $news['file'], 512, 340);

            // $entityNews->feature_image_path = "/frontend/img/news/thumb/" . $imageFileName;
            $entityNews->feature_image_path = $thumbFilePath;
            $entityNews->save();
        }

        return $entityNews->id;
    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "news";
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
        $locationName = "news";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
    }

    /**
     * @param $param
     */
    public function removeImage($param)
    {
        $this->imageService->removeNewsImage($param['id'], $param['file']);

        return [
            "rtnCd" => true,
        ];
    }

}
