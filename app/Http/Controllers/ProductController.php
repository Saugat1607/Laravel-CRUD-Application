<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // User sees ONLY own products
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
            'image' => $imageName,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index');
    }

    // 🔐 Allow OWNER or ADMIN
    private function authorizeProduct(Product $product)
    {
        if (!session()->has('is_admin') && $product->user_id !== Auth::id()) {
            abort(403);
        }
    }

    public function show(Product $product)
    {
        $this->authorizeProduct($product);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
                unlink(public_path('uploads/products/'.$product->image));
            }

            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
            unlink(public_path('uploads/products/'.$product->image));
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}
