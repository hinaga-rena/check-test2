<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;



class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 商品名検索（部分一致）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え（高い順 or 低い順）
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // 編集画面を表示
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // 更新処理
    public function update( UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('public/images');
        $filename = basename($path);
        $product->image = $filename;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->season = implode(',', $request->season ?? []);
        $product->save();

        return redirect()->route('products.index');
    }

    // 削除処理
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $filename = basename($path);
        }else {
            $filename = null;
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'season'      => implode(',', $request->season ?? []),
            'description' => $request->description,
            'image'       => $filename ?? null,
        ]);

        return redirect()->route('products.index');
    }
}