<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Deliveries;
Use App\Stocks;
Use App\Products;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sales_data = Sales::with("sales")->count();

        $sales_total = Sales::all();
        $priceProduct= Products::all();

        $display_sales=0;
        for($i=0;$i<$sales_total->count();$i++){

            $quantity= $sales_total[$i]['quantity'];

            $price= $priceProduct->find($sales_total[$i]['product_id'])['price'];

            $total_price=$quantity*$price;
            $display_sales=$display_sales+$total_price;

        }


        $deliveries_data = Deliveries::with("deliveries")->count();
        $products_data = Products::with("products")->count();

        return view("dashboard", compact("sales_data", "sales_data", "deliveries_data", "display_sales", "products_data"));
    }
}
