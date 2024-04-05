<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleDetail;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('detail')->get();
        return view("admin.articles.index", compact("articles"));
    }
    public function save(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);
        $article = new Article();
        $article->title = $data['title'];
        $article->user_id = auth()->id();
        $article->save();
        $articleD = new ArticleDetail();
        $articleD->article_id = $article->id;
        $articleD->content = $data['content'];
        $file = $request->file('image');
        if (isset($file)) {
            $mainpath = date("Y-m-d") . '/';
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $name = $this->generateCode();
            $imageName = $name . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
            $articleD->image = url('') . '/storage/categories/' . $mainpath . $imageName;
        }
        $articleD->save();
        return back()->with("success", "artilce added successfully");
    }
    function generateCode()
    {
        $code = mt_rand(100000, 999999);
        if ($this->codeExists($code)) {
            return $this->generateCode();
        }
        return $code;
    }

    function codeExists($code)
    {
        return ArticleDetail::where('image', $code)->exists();
    }
    public function delete(Request $request)
    {
        $article = Article::find($request->id);
        $article->delete();
        return back()->with("success", "artilce deleted successfully");
    }
public function update(Request $request)
{
    $data = $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $article = Article::findOrFail($request->id); // Fetch the article by ID
    $articleD = ArticleDetail::where("article_id", $request->id)->first(); // Fetch the article detail

    $article->title = $data['title'];
    $articleD->content = $data['content'];

    // Handle image upload
    $file = $request->file('image');
    if ($file) {
        $mainpath = date("Y-m-d") . '/';
        $fileNameWithExtension = $file->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $name = $this->generateCode();
        $imageName = $name . '_' . time() . '.' . $extension;
        $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
        $articleD->image = url('') . '/storage/categories/' . $mainpath . $imageName;
    }

    $article->save();
    $articleD->save();

    return back()->with("success", "Article edited successfully");
}
}
