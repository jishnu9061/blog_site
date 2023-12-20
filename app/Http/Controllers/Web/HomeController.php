<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\Article;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Constants\PageConstants;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageData = Page::where('name', PageConstants::HOME)->first();
        $articles = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->join('article_tags', 'articles.id', '=', 'article_tags.article_id')
            ->join('tags', 'article_tags.tag_id', '=', 'tags.id')
            ->select('articles.*', 'categories.category_name', DB::raw('GROUP_CONCAT(tags.name) as tag_names'))
            ->groupBy('articles.id', 'articles.title', 'categories.category_name', 'articles.category_id', 'articles.description', 'articles.image', 'articles.created_at', 'articles.updated_at')
            ->get();
        return $this->renderView($this->getView('index'), compact('pageData', 'articles'), 'Home');
    }
}
