<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->input('keyword');

        $sort = $request->input('sort'); 

        $query = Product::query();

        if($keyword) {
            $query->where('name','like',"%{$keyword}%");
        }

        if($sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products', 'keyword', 'sort'));
    }

     /**
     * 商品詳細・編集ページ
     */
public function detail($productId){
    // 商品と紐づく季節（seasons）をロード
        $product = Product::with('seasons')->findOrFail($productId);

    // 全ての季節（春・夏・秋・冬）を取得
        $seasons = Season::all();

        return view('products.detail', compact('product', 'seasons'));
    }


    /**
     * 更新処理
     */
    public function update(ProductRequest $request, $productId)
{
    $product = Product::findOrFail($productId);

    // 値の更新（必須）
    $product->name        = $request->name;
    $product->price       = $request->price;
    $product->description = $request->description;

    // 季節の更新（フォームで未選択の場合は以前の値を保持）
    if ($request->has('season')) {
        $product->season = json_encode($request->season);
    }

    // 画像の更新（ファイルがアップロードされた場合のみ）
    if ($request->hasFile('image')) {
        if ($product->image && Storage::exists('public/images/' . $product->image)) {
            Storage::delete('public/images/' . $product->image);
        }
        $filename = time() . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('public/images', $filename);
        $product->image = $filename;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', '更新が完了しました');
}



    /**
     * 商品削除
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 画像削除
        if ($product->image && Storage::exists('public/images/' . $product->image)) {
            Storage::delete('public/images/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', '商品を削除しました');
    }   
     // 商品登録ページ表示
    public function register()
    {
        return view('products.register');
    }


    // 画像ファイルの保存
   public function store(ProductRequest $request)
{
    $validated = $request->validated();

    // 画像保存
    $filename = time() . '_' . $request->image->getClientOriginalName();
    $request->image->storeAs('public/images', $filename);

    // 商品保存
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $filename,
        'description' => $request->description,
    ]);

    // 季節を紐付け
    if (method_exists($product, 'seasons')) {
        $product->seasons()->sync($request->season);
    }

    return redirect()->route('products.index');
}


}