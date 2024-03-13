<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Favorite;

class HomeController extends Controller
{
    public function index()
    {
        $topBanner = Banner::getBanner()->first();
        $gallerys = Banner::getBanner('gallery')->get();

        $new_products = Product::orderBy('created_at','DESC')->limit(2)->get(); 
        $sale_products = Product::orderBy('created_at','DESC')->where('sale_price','>','0')->limit(3)->get(); 
        $featured_products = Product::inRandomOrder()->limit(4)->get(); 

        return view('home.index',compact('topBanner','gallerys','new_products','sale_products','featured_products'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function category(Category $cat)
    {
        // $products = Product::where('category_id', $cat->id)->get(); 
        $products = $cat->products()->paginate(9);
        $new_products = Product::orderBy('created_at','DESC')->limit(3)->get(); 
        return view('home.category', compact('cat','products','new_products'));
    }

    public function product(Product $product)
    {
        $products = Product::where('category_id',$product->category_id)->limit(12);
        return view('home.product', compact('product','products'));
    }

    public function favorite($product_id)
    {
        $data = [
            'product_id' => $product_id,
            'customer_id' => auth('cus')->id()
        ];

        $favorited = Favorite::where(['product_id' => $product_id, 'customer_id' => auth('cus')->id()])->first();
        if($favorited){
            $favorited->delete();
            return redirect()->back()->with('ok','Bạn đã bỏ yêu thích sản phẩm');
        }else{
            Favorite::create($data);
            return redirect()->back()->with('ok','Bạn đã yêu thích sản phẩm');
        }
        
    }
}
