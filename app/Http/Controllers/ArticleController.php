<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    // SELESAI
    public function list() {
        $article = new Article;

        return response()->json(
            [
                'status' => 200,
                'message' => null,
                'data' => $article->all()
            ]
        );

    }

    // SELESAI
    public function create() {
        $fileName = request() -> file('imageFile') -> getClientOriginalName();
        request() -> file('image') -> storeAs('post-image', $fileName);
        
        $article = new Article;
        $article -> title = request('title');
        $article -> content = request('content');
        $article -> image = $fileName;
        $article -> save();

        return response()->json(
            [
                'status' => 200,
                'message' => "Article has been successfully posted",
                'data' => $article -> latest() -> first()
            ]
        );
    }

    // SELESAI
    public function getById($id) {
        $article = new Article;
        return response()->json(
            [
                'status' => 200,
                'message' => null,
                'data' => $article->find($id)
            ]
        );
    }

    // belum selesai
    public function update($id) {
        $fileName = request() -> file('imageFile') -> getClientOriginalName();
        request() -> file('image') -> storeAs('post-image', $fileName);
        
        $article = new Article;
        $article -> find($id) -> update([
            'title' => request('title'),
            'content' => request('content'),
            'image' => $fileName
        ]);

        return response()->json(
            [
                'status' => 200,
                'message' => "Article has been successfully updated",
                'data' => $article -> find($id)
            ]
        );
    }

    // belum selesai
    public function delete($id) {
        $article = new Article;
        $article -> find($id) -> delete();

        return response()->json(
            [
                'status' => 200,
                'message' => "Article has been successfully deleted",
                'data' => null
            ]
        );
    }

}