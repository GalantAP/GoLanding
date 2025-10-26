<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Menampilkan halaman cart
     * User harus login untuk akses cart
     */
    public function index()
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang!');
        }

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        // Normalisasi item (tambahkan subtotal per item)
        $total = 0;
        $grandQty = 0;

        foreach ($cart as $key => $item) {
            $qty = isset($item['quantity']) ? max(0, (int) $item['quantity']) : 0;
            $price = isset($item['price']) ? (float) $item['price'] : 0.0;
            $subtotal = $qty * $price;

            $cart[$key]['quantity'] = $qty;
            $cart[$key]['price'] = $price;
            $cart[$key]['subtotal'] = $subtotal;

            $total += $subtotal;
            $grandQty += $qty;
        }

        // Simpan kembali jika ada normalisasi
        session()->put('cart', $cart);

        // Hitung cart count (jumlah item berbeda, bukan total qty)
        $cartCount = count($cart);

        // Get categories untuk navbar/filter
        $categories = Category::all();

        return view('cart.index', compact('cart', 'total', 'cartCount', 'categories', 'grandQty'));
    }

    /**
     * Menambahkan produk ke cart
     * User HARUS LOGIN untuk menambahkan ke cart
     *
     * Optional: request('qty') untuk menambah lebih dari 1
     */
    public function add(Request $request, $productId)
    {
        // Cek login
        if (!auth()->check()) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang!');
        }

        try {
            $product = Product::findOrFail($productId);

            // Validasi qty (opsional)
            $qty = (int) $request->input('qty', 1);
            if ($qty < 1) {
                $qty = 1;
            }
            if ($qty > 99) {
                $qty = 99;
            }

            $cart = session()->get('cart', []);

            // Cek apakah produk sudah ada di cart
            if (isset($cart[$productId])) {
                // Tambah quantity
                $cart[$productId]['quantity'] = min(99, (int) $cart[$productId]['quantity'] + $qty);
            } else {
                // Tambahkan produk baru ke cart
                $effectivePrice = $product->discount_price ?? $product->price;

                $cart[$productId] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'price'    => (float) $effectivePrice,
                    'image'    => $product->image ?? null,
                    'quantity' => $qty,
                    'slug'     => $product->slug ?? null,
                ];
            }

            session()->put('cart', $cart);

            if ($request->ajax()) {
                [$total, $grandQty, $cartCount] = $this->recalcTotals($cart);

                return response()->json([
                    'success'   => true,
                    'message'   => 'Produk berhasil ditambahkan ke keranjang!',
                    'cartCount' => $cartCount,
                    'total'     => $total,
                    'grandQty'  => $grandQty,
                ]);
            }

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        } catch (\Exception $e) {
            Log::error('Cart add error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan produk ke keranjang!',
                ], 500);
            }
            return redirect()->back()->with('error', 'Gagal menambahkan produk ke keranjang!');
        }
    }

    /**
     * Update quantity produk di cart
     * User harus login
     */
    public function update(Request $request, $productId)
    {
        // Cek login
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu!',
                ], 401);
            }
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu!');
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:0|max:99',
        ], [
            'quantity.required' => 'Quantity wajib diisi.',
            'quantity.integer'  => 'Quantity harus berupa angka.',
            'quantity.min'      => 'Quantity minimal 0.',
            'quantity.max'      => 'Quantity maksimal 99.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $quantity = (int) $request->input('quantity', 1);

            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);

                if ($request->ajax()) {
                    [$total, $grandQty, $cartCount] = $this->recalcTotals($cart);
                    $itemSubtotal = $cart[$productId]['quantity'] * (float) $cart[$productId]['price'];

                    return response()->json([
                        'success'      => true,
                        'message'      => 'Quantity berhasil diupdate',
                        'itemSubtotal' => $itemSubtotal,
                        'total'        => $total,
                        'grandQty'     => $grandQty,
                        'cartCount'    => $cartCount,
                    ]);
                }

                return redirect()->back()->with('success', 'Quantity berhasil diupdate!');
            } else {
                // Quantity 0 -> hapus item
                unset($cart[$productId]);
                session()->put('cart', $cart);

                if ($request->ajax()) {
                    [$total, $grandQty, $cartCount] = $this->recalcTotals($cart);

                    return response()->json([
                        'success'   => true,
                        'message'   => 'Produk dihapus dari keranjang!',
                        'total'     => $total,
                        'grandQty'  => $grandQty,
                        'cartCount' => $cartCount,
                    ]);
                }

                return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang!',
            ], 404);
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang!');
    }

    /**
     * Hapus produk dari cart
     * User harus login
     */
    public function remove(Request $request, $productId)
    {
        // Cek login
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu!',
                ], 401);
            }
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            if ($request->ajax()) {
                [$total, $grandQty, $cartCount] = $this->recalcTotals($cart);

                return response()->json([
                    'success'   => true,
                    'message'   => 'Produk berhasil dihapus dari keranjang!',
                    'total'     => $total,
                    'grandQty'  => $grandQty,
                    'cartCount' => $cartCount,
                ]);
            }

            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang!',
            ], 404);
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang!');
    }

    /**
     * Kosongkan semua cart
     * User harus login
     */
    public function clear(Request $request)
    {
        // Cek login
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu!',
                ], 401);
            }
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu!');
        }

        session()->forget('cart');

        if ($request->ajax()) {
            return response()->json([
                'success'   => true,
                'message'   => 'Keranjang berhasil dikosongkan!',
                'total'     => 0,
                'grandQty'  => 0,
                'cartCount' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }

    /**
     * Get cart count (helper method)
     * Mengembalikan jumlah jenis item (bukan total quantity)
     */
    public static function getCartCount()
    {
        // Hanya tampilkan cart count jika user login
        if (!auth()->check()) {
            return 0;
        }

        $cart = session()->get('cart', []);
        return is_array($cart) ? count($cart) : 0;
    }

    /**
     * Get total quantity (helper method)
     * Mengembalikan total quantity semua item
     */
    public static function getCartQuantity()
    {
        if (!auth()->check()) {
            return 0;
        }

        $cart = session()->get('cart', []);
        if (!is_array($cart)) {
            return 0;
        }

        $qty = 0;
        foreach ($cart as $item) {
            $qty += (int) ($item['quantity'] ?? 0);
        }
        return $qty;
    }

    /**
     * Helper: Recalculate totals quickly
     * @param array $cart
     * @return array [total, grandQty, cartCount]
     */
    protected function recalcTotals(array $cart): array
    {
        $total = 0.0;
        $grandQty = 0;

        foreach ($cart as $item) {
            $q = (int) ($item['quantity'] ?? 0);
            $p = (float) ($item['price'] ?? 0);
            $total += $q * $p;
            $grandQty += $q;
        }

        $cartCount = count($cart);
        return [$total, $grandQty, $cartCount];
    }
}
