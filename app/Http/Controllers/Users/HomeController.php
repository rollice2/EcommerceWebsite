<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Categories;
use App\Models\Users\Products;
use App\Models\Users\ProductImage;
use App\Models\Users\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Hiện tại mối quan hệ đang bị lỗi ... Không xuất hình được ở rated product và comments
        $products = ProductImage::join('products', 'products.id', 'product_image.product_id')->where('type', '=', 1)->orderBy('products.created_at', 'DESC')->limit(3)->get();
        $new_products = ProductImage::join('products', 'products.id', 'product_image.product_id')->where('type', '=', 1)->orderBy('products.created_at', 'DESC')->limit(6)->get();
        $categories = Categories::all();
        $tree = [];
        foreach ($categories as $key => $category) {
            if ($category->parent_id == 0) {
                $tree[$category->id] = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "children" => [],
                ];
            }
        }
        foreach ($categories as $key => $category) {
            if ($category->parent_id != 0) {
                $tree[$category->parent_id]['children'][] = [
                    "id" => $category->id,
                    "name" => $category->name,
                ];
            }
        }
        $random_products = Products::join('product_image', 'products.id', 'product_image.product_id')->where('type', '=', 1)
            ->join('comments', 'products.id', 'comments.product_id')->inRandomOrder()->limit(6)->get()->chunk(2);
        $highest_star_products = Comments::select(DB::raw('products.name,products.price,product_id,count(product_id) as total_comments, AVG(star_value) as avg_star_value'))
            ->join('products', 'products.id', 'comments.product_id')
            ->groupBy('product_id')->orderBy('avg_star_value', 'DESC')->orderBy('total_comments', 'DESC')->limit(6)->get()->chunk(2);
        $latest_comments = Comments::select('star_value', 'users.name as user_name', 'image', 'products.name', 'comments.created_at', 'content')
            ->orderBy('comments.created_at', 'DESC')
            ->join('product_image', 'product_image.id', 'comments.product_id')
            ->join('products', 'products.id', 'comments.product_id')
            ->join('users', 'users.id', 'comments.user_id')
            ->limit(4)->get();

        $sales_items = Products::with('coverImage', 'discount')->get();
        $params = [
            "products" => $products,
            "new_products" => $new_products,
            "categories" => $tree,
            "random_products" => $random_products,
            "highest_star_products" => $highest_star_products,
            "latest_comments" => $latest_comments,
            "sales_items" => $sales_items
        ];
        return view('Website.index', $params);
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
        //
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
}
