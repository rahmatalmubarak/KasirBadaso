<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\transaction;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Database\Eloquent\Collection;
use Tymon\JWTAuth\Http\Middleware\Check;
use Uasoft\Badaso\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('stock','>=',1)->get();
        return response()->json($product);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'product' => 'required',
            'total' => 'required'
        ]);
        $carts = Product::where('id', $request->input('product'))->first();
        $data = [
            'product_id' => $request->input('product'),
            'total' => $request->input('total'),
            'total_price' => $request->input('total') * $carts->capital
        ];
        $carts->stock = $carts->stock - $request->input('total');
        $carts->save();
        Cart::create($data);
        if ($carts->stock >= $request->input('total') ) {
            DB::commit();
            return response()->json([
                'status' => 'success',
                'result' => $data
            ], 200);
        }
        else
        {
            DB::rollBack();
            return response()->json([
                'status' => 'Stock Tidak Cukup',
                'result' => $data
            ]); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $carts = DB::table('carts')
            ->Join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.id', 'products.name', 'carts.total','carts.total_price', 'products.capital')
            ->get();
        $total_Price = DB::table('carts')->sum('total_price');
        return response()->json(['status' => 'success',
            'result' => $carts,
            'total_price' => $total_Price

        ], 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteDetail($id)
    {
        $cart = Cart::findOrFail($id);
        $produk = Product::where('id', $cart->product_id)->first();
        // dd($produk);
        $produk->stock = $produk->stock + $cart->total;
        $produk->save();

        $cart->delete();
        return response()->json([
            'status' => 'success',
            'result' => $produk
        ], 200);
    }

    public function transaction(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'idc' => 'required'
        ]);
        $ids =0;
        $idt = transaction::latest()->first();
        if ($idt['id'] >=0) {
            $ids = $idt['id'] +1;
        }
        else{
            $ids = 1;
        }
       
        $profit = 0;
        $cart  = Cart::all();
        
        
        $customer = $request->input('idc');
        foreach ($cart as $key) {
            $profit  += $key->total_price;
        }
        
        if ($cart->isNotEmpty()) { 
        transaction::create([
            'id' => $ids,
            'users_id' =>$customer,
            'date' => date('Y-m-d'),
            'profit' => $profit
        ]);
        
        foreach ($cart as $key ) {
            $data = [
                'transaction_id' => $ids,
                'product_id' => $key->product_id,
                'total' => $key->total,
                'total_price' => $key->total_price
            ];
            detail::create($data);
        }
            DB::table('carts')->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'result' => $data
            ], 200); 
        }else{
            return response()->json([
                'status' => 'failed',
                'result' => 'Transaksi Kosong'
            ], 500); 
        }
    }

    public function cancel()    
    {
        $cart = Cart::all();
        foreach ($cart as $key) {
            $product = Product::where('id', $key['product_id'])->first();
            $product->stock = $product->stock + $key['total'];
            $product->save();
        }        

        DB::table('carts')->delete();
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function details(Request $request)
    {
        $detail = DB::table('details')->Join('products', 'details.product_id', '=', 'products.id')
            ->select('details.id', 'products.name', 'details.total','details.total_price', 'products.capital')
            ->where('transaction_id', $request->id)
            ->get();
        $users = DB::table('transactions')->join('users', 'transactions.users_id', '=', 'users.id')
        // ->select('users.name')
        ->where('transactions.id', $request->id);
        $total_Price = DB::table('details')->where('transaction_id', $request->id)->sum('total_price');
        return response()->json([
            'status' => 'Success',
            'result' => $detail,
            'total_price' => $total_Price,
            'users' => $users
        ],200);
    }
    public function name(Request $request)
    {   
        $show = User::where('id', $request->idc)->first();
        if ($show['id'] != null) {
            return response()->json([
                'status' => 'success',
                'result' => $show->name,
            ],200);
        }
    }
}
