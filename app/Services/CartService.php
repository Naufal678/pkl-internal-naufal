<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Mendapatkan atau membuat keranjang aktif.
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        return Cart::firstOrCreate(['session_id' => Session::getId()]);
    }

    /**
     * Menambahkan produk ke keranjang dengan proteksi stok.
     */
    public function addProduct(Product $product, int $quantity = 1): void
    {
        $cart = $this->getCart();

        $existingItem = $cart->items()->where('product_id', $product->id)->first();
        $currentQtyInCart = $existingItem ? $existingItem->quantity : 0;
        $newTotalQty = $currentQtyInCart + $quantity;

        if ($newTotalQty > $product->stock) {
            throw new \Exception("Stok terbatas. Anda hanya bisa menambah " . ($product->stock - $currentQtyInCart) . " lagi.");
        }

        if ($existingItem) {
            $existingItem->update(['quantity' => $newTotalQty]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $cart->touch();
    }

    /**
     * Update jumlah item dengan verifikasi kepemilikan.
     */
    public function updateQuantity(int $itemId, int $quantity): void
    {
        $item = CartItem::with('product', 'cart')->findOrFail($itemId);
        
        $this->verifyCartOwnership($item->cart);

        if ($quantity <= 0) {
            $item->delete();
            return;
        }

        if ($quantity > $item->product->stock) {
            throw new \Exception("Stok tidak mencukupi.");
        }

        $item->update(['quantity' => $quantity]);
    }

    /**
     * Gabungkan keranjang guest ke user saat login.
     */
    public function mergeCartOnLogin(): void
    {
        $guestSessionId = Session::getId();
        $guestCart = Cart::where('session_id', $guestSessionId)->with('items')->first();

        if (!$guestCart || $guestCart->items->isEmpty()) return;

        DB::transaction(function () use ($guestCart) {
            $userCart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            foreach ($guestCart->items as $item) {
                $existingUserItem = $userCart->items()
                    ->where('product_id', $item->product_id)
                    ->first();

                if ($existingUserItem) {
                    $existingUserItem->increment('quantity', $item->quantity);
                    $item->delete();
                } else {
                    $item->update(['cart_id' => $userCart->id]);
                }
            }
            $guestCart->delete();
        });
    }

    /**
     * Helper: Memastikan user tidak mengedit cart orang lain.
     */
    private function verifyCartOwnership(Cart $cart): void
    {
        if (Auth::check()) {
            if ($cart->user_id !== Auth::id()) abort(403);
        } else {
            if ($cart->session_id !== Session::getId()) abort(403);
        }
    }
}