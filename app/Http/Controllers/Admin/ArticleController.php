<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Constants\PageConstants;
use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleTag;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('admin.article');
        $this->addBaseView('admin.article');
    }

    /**
     * Show All Articles
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $path = $this->getView('index');
        $article = Article::paginate(PageConstants::PAGINATE);
        $title = 'Article';
        return $this->renderView($path, ['articles' => $article], $title);
    }

    /**
     * Create Article
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $path = $this->getView('create');
        $title = 'Create Article';
        return $this->renderView($path, ['categories' => Category::pluck('category_name', 'id'), 'tags' => Tag::pluck('name', 'id')], $title);
    }

    /**
     * Store Article
     *
     * @param ArticleStoreRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ArticleStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create and store the article
            $article = new Article();
            $article->category_id = $request->input('category');
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->save();

            // Store tags manually within the transaction
            $tags = $request->input('tags', []);
            foreach ($tags as $tagId) {
                DB::table('article_tags')->insert([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }

            // Upload and store the image
            $res = FileManager::upload(FileDestinations::ARTICLE_IMAGE, 'image', FileManager::FILE_TYPE_IMAGE);
            if ($res['status']) {
                $article->image = $res['data']['fileName'];
                $article->save();
            }

            // Commit the transaction if everything is successful
            DB::commit();

            Toastr::success('Article Created Successfully');
            return redirect()->route($this->getRoute('index'));
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();
            // Handle the error, log it, or redirect with an error message
            return redirect()->back()->with('error', 'An error occurred while saving the article.');
        }
    }

    /**
     * Edit Article
     *
     * @param Article $article
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Article $article)
    {
        $path = $this->getView('edit');
        $title = 'Edit Suite Amenities';
        $articleTags = ArticleTag::where('article_id', $article->id)->pluck('tag_id')->toArray();
        return $this->renderView($path, ['article' => $article, 'categories' => Category::pluck('category_name', 'id'), 'tags' => Tag::pluck('name', 'id'), 'selectedTags' => $articleTags,], $title);
    }

    /**
     * Update Article
     *
     * @param ArticleUpdateRequest $request
     * @param Article $article
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update the article
            $article->category_id = $request->input('category');
            $article->title = $request->input('title');
            $article->description = $request->input('description');

            // Save the article first to get its ID
            $article->save();

            // Update tags manually within the transaction
            $tags = $request->input('tags', []);

            // Remove existing tags for the article
            ArticleTag::where('article_id', $article->id)->delete();

            // Insert the selected tags
            foreach ($tags as $tagId) {
                // Assuming 'article_tags' is your pivot table
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }

            // Upload and update the image
            $res = FileManager::upload(FileDestinations::ARTICLE_IMAGE, 'image', FileManager::FILE_TYPE_IMAGE);
            if ($res['status']) {
                $article->image = $res['data']['fileName'];
                $article->save();
            }

            // Commit the transaction if everything is successful
            DB::commit();

            Toastr::success('Article Updated Successfully');
            // Redirect or return a response as needed
            return redirect()->route($this->getRoute('index'));
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Handle the error, log it, or redirect with an error message
            return redirect()->back()->with('error', 'An error occurred while updating the article.');
        }
    }

    /**
     * Destroy Article
     *
     * @param Article $article
     *
     * @return \Illuminate\Support\Facades\Response|\Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        $tag->delete();
        Toastr::success('Tag Deleted Successfully');
        return Response::json(['success' => 'Tag Deleted Successfully']);
    }
}
