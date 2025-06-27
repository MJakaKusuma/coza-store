<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Validasi produk dulu
        $product = Product::findOrFail($productId);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'content' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

}
