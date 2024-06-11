<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\DeleteArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // articles
    public function index()
    {
        // get all articles
        return Article::paginate(
            request()->input('limit', 10)
        );
    }

    public function timeline()
    {
        // get all articles
        $articles = Article::with(['comments', 'author'])->where('is_published', true)->paginate(
            request()->input('limit', 10)
        );

        return view('articles.timeline', compact('articles'));
    }

    // get single article
    public function single($id)
    {
        return Article::findOrFail($id);
    }

    // create article
    public function create(CreateArticleRequest $request)
    {

        $article = Article::create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->id()]
            )
        );

        // Chekc if cover exists
        $file = $request->hasFile('cover');

        if ($file) {
            Storage::disk('public')->putFileAs('covers', $request->file('cover'), $article->id . '.jpg');
        }

        return response()->json($article, 201);
    }

    // update article
    public function update(UpdateArticleRequest $request)
    {
        $article = Article::find($request->input('id'));

        $article->update($request->validated());

        return response()->json($article, 200);
    }

    // publish/unpublish article
    public function publish(Request $request)
    {
        // validate request
        $request->validate([
            'id' => 'required|exists:articles,id',
            'is_published' => 'required|boolean'
        ]);

        $article = Article::find($request->input('id'));

        // ownership check
        if ($article->user_id !== auth()->id()) {
            return response()->json(['message' => 'Access Denied'], 403);
        }

        $article->update(['is_published' => $request->input('is_published')]);

        // Chekc if cover exists
        $file = $request->hasFile('cover');

        if ($file) {
            Storage::disk('public')->putFileAs('covers', $request->file('cover'), $article->id . '.jpg');
        }

        return response()->json($article, 200);
    }

    // delete article
    public function delete($id)
    {
        $article = Article::findOrFail($id);

        // ownership check
        if ($article->user_id !== auth()->id()) {
            return response()->json(['message' => 'Access Denied'], 403);
        }

        $article->delete();

        return response()->json(null, 204);
    }
}
