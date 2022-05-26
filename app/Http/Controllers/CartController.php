<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.checkout"); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->get("product_id")){
            return['message'=>"items returned",'item'=>Cart::where("user_id", auth()->user()->id)->sum('quantity')];
        }
        
        // find all product
        $product = Product::where("id",$request->get("product_id"))->first();

        // cart  exist
        $cart_check = Cart::where("product_id", $request->get("product_id"))->pluck('id');
        // dd($product);
        if($cart_check -> isEmpty())
        {
            // first cart
            $cart  = Cart::create([
                "product_id" => $product->id,
                "quantity" => 1,
                "price" => $product->sale_price,
                "user_id" => auth()->user()->id
            ]);
        }
        else
        {
            //increment
            $cart = Cart::where("product_id",$request->get("product_id"))->increment("quantity");
        }
        // user count item
        $userItem = Cart::where("user_id", auth()->user()->id)->sum('quantity');
        if($cart){
            return['message'=>"cart created",'item'=>$userItem];
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function get_item_for_cart()
    {
        $final_data = [];
        $total_amount= 0;
        $carts = Cart::with("product")->where("user_id", auth()->user()->id)->get();
        if (isset($carts)){
            foreach($carts as $cart)
            {
                if($cart->product){
                    foreach ($cart->product as $cart_product){
                        if($cart_product->id == $cart->product_id){
                            $final_data[$cart->product_id]['name'] = $cart_product->name;
                            $final_data[$cart->product_id]['quantity'] = $cart->quantity;
                            $final_data[$cart->product_id]['total'] = $cart->quantity*$cart->price;
                            $final_data[$cart->product_id]['id'] = $cart_product->id;
                            $total_amount += $cart->quantity*$cart->price;


                        }
                    }
                }
            }
        }
        $final_data['total_amount'] = $total_amount;
        return response()->json($final_data); 
    }
}
