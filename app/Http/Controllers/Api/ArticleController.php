<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleDetail;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        try {
<<<<<<< HEAD
            $data = Article::with('detail')->latest()->paginate($request->perpage);
=======
            $data = Article::get();
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function show(Request $request)
    {
        try {

<<<<<<< HEAD
            $data = ArticleDetail::with('article')->where('article_id', $request->id)->first();
=======
            $data = ArticleDetail::where('article_id', $request->id)->first();
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
}
