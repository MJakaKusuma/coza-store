<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk di dashboard admin
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        $categories = Category::all();
        $genders = Product::GENDERS; // Asumsikan konstanta static array ['unisex', 'men', 'woman']
        return view('admin.products.create', compact('categories', 'genders'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'gender' => 'required|in:unisex,men,woman',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload file jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $genders = Product::GENDERS;
        return view('admin.products.edit', compact('product', 'categories', 'genders'));
    }

    /**
     * Proses update data produk
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'gender' => 'required|in:unisex,men,woman',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika gambar baru diunggah, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk beserta gambar
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * (Opsional) Tampilkan produk ke tampilan customer
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('shop.detail', compact('product'));
    }
    public function customerIndex(Request $request)
    {
        $sort = $request->query('sort');    // 'price_asc', 'price_desc', 'latest', etc
        $price = $request->query('price');  // format '50-100'
        $categoryId = $request->query('category'); // kategori opsional

        $query = Product::with('category');

        // Filter harga
        if ($price) {
            [$min, $max] = explode('-', $price);
            $query->whereBetween('price', [(float) $min, (float) $max]);
        }

        // Filter kategori
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Sort
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query->orderBy('sold', 'desc'); // asumsi ada kolom `sold`
                break;
            default:
                $query->latest(); // default: terbaru
        }

        $products = $query->paginate(12);
        $categories = Category::all(); // untuk filter kategori

        return view('shop.index', compact('products', 'categories', 'sort', 'price', 'categoryId'));
    }
}
