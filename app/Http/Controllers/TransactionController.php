<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Uasoft\Badaso\Controllers\BadasoBaseController;
use Uasoft\Badaso\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return response()->json($product);
    }

    public function name(Request $request)
    {
        $name = User::where('id', $request->idCustomer)->get();
        return response()->json($name);
    }
    

}
