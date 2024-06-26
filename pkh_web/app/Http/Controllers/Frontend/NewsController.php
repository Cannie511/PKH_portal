<?php namespace App\Http\Controllers\Frontend;

use View;
use App\Services\NewsService;
use App\Http\Controllers\Frontend\FrontendController;

/**
 * News Controller
 */
class NewsController extends FrontendController
{
    /**
     * @var mixed
     */
    private $newsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
        $this->middleware('guest');
    }

    /**
     * Display a listing of the news.
     *
     * @return Response
     */
    public function index()
    {

        $listNews = $this->newsService->selectList();

        $latestNews  = array_slice($listNews, 0, 4);
        $relatedNews = array_slice($listNews, 4);

        $data = [
            'listNews'    => $listNews,
            'latestNews'  => $latestNews,
            'relatedNews' => $relatedNews,
        ];

        return view($this->viewFolder . $this->currentTheme . '.news.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($slug)
    {
        // $viewPage = $this->viewFolder  . 'news.' .  $slug;
        $viewPage = $this->viewFolder . $this->currentTheme . '.news.' . $slug;

        if (View::exists($viewPage)) {
            return view($viewPage);
        }

        // TODO: Load from DB
        $news = $this->newsService->selectBySlug($slug);

        if (null != $news) {
            $viewPage = $this->viewFolder . $this->currentTheme . '.news.db-template';

            return view($viewPage)->with('data', $news);
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getPreview($slug)
    {
        // $viewPage = $this->viewFolder  . 'news.' .  $slug;
        $viewPage = $this->viewFolder . $this->currentTheme . '.news.' . $slug;

        if (View::exists($viewPage)) {
            return view($viewPage);
        }

        // TODO: Load from DB
        $news = $this->newsService->selectBySlug($slug, true);

        if (null != $news) {
            $viewPage = $this->viewFolder . $this->currentTheme . '.news.db-template';

            return view($viewPage)->with('data', $news);
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getPreviewById($id)
    {
        // TODO: Load from DB
        $news = $this->newsService->selectByIdForPreview($id, true);

        if (null != $news) {
            $viewPage = $this->viewFolder . $this->currentTheme . '.news.db-template';

            return view($viewPage)->with('data', $news);
        }

        abort(404);
    }

}
