<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Article;
use App\Image;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Http\Requests\RemoveArticleRequest;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
        $this->middleware('articleOwner', ['only' => ['edit', 'destroyConfirm']]);
    }

    /**
     * Display a listing of articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->paginate(3);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a article.
     *
     * @return Response
     */
    public function create()
    {
        $tags = Tag::lists('name', 'id');

        return view('articles.create', compact('tags'));
    }

    /**
     * Store a article.
     *
     * @param CreateArticleRequest $request
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $this->createArticle($request);

        flash()->success('Article has been created.')->important();

        return redirect()->route('articles.index');
    }

    /**
     * Show a article.
     *
     * @param  Article $article
     * @return Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing a article.
     *
     * @param  Article $article
     * @return Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
    }

    /**
     * Update a article.
     *
     * @param Article $article
     * @param EditArticleRequest $request
     * @return Response
     */
    public function update(Article $article, EditArticleRequest $request)
    {
        $article->update($request->all());

        $this->manageTags($article, $request->input('tag_list'));

        flash()->success('Your article has been updated')->important();

        return redirect()->route('articles.index');
    }

    /**
     * Remove a article.
     *
     * @param  Article $article
     * @param  RemoveArticleRequest $request
     * @return Response
     */
    public function destroy(Article $article, RemoveArticleRequest $request)
    {
        $article->delete();

        flash()->success('Article has been removed');

        return redirect()->route('articles.index');
    }

    /**
     * Confirm to remove a article.
     *
     * @param Article $article
     * @return Response
     */
    public function destroyConfirm(Article $article)
    {
        return view('articles.destroy', compact('article'));
    }

    /**
     * Sync up the list of tags in the database.
     *
     * @param $article
     * @param $tags
     */
    private function syncTags($article, $tags)
    {
        $article->tags()->sync($tags);
    }

    /**
     * Remove tag
     * @param Article $article
     */
    private function removeTag(Article $article)
    {
        $article->tags()->detach($article->getTagListAttribute());
    }

    /**
     * Save a article.
     *
     * @param CreateArticleRequest $request
     */
    private function createArticle(CreateArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->manageTags($article, $request->input('tag_list'));
    }

    /**
     * Manage what to do with tags.
     *
     * @param Article $article
     * @param $tag_list
     */
    private function manageTags(Article $article, $tag_list)
    {
        if ($tag_list == null)
        {
            if ($article->hasATag())
            {
                $this->removeTag($article);
            }
        }
        else
        {
            $this->syncTags($article, $tag_list);
        }
    }
}
