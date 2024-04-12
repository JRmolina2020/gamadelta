<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products as p')
            ->join('categories as c', 'c.id', '=', 'p.categorie_id')
            ->select(
                'p.id',
                'p.name',
                'p.price',
                'p.price_two',
                'p.cost',
                'p.stock',
                'c.name as type',
                'c.id as idc',
            )
            ->orderBy('p.stock', 'DESC')->get();
        return $products;
    }

    //LIST PRODUCTS STOCK 0
    public function index2()
    {
        $products = DB::table('products as p')
            ->join('categories as c', 'c.id', '=', 'p.categorie_id')
            ->select(
                'p.id',
                'p.name',
                'p.cost',
                'c.name as type',
            )
            ->orderBy('p.name', 'ASC')
            ->where('p.stock', 0)
            ->get();
        return $products;
    }
    public function index_three()
    {
        $products_r = DB::table('factures as f')
            ->join('facture_details as fd', 'f.id', '=', 'fd.facture_id')
            ->join('products as p', 'p.id', '=', 'fd.product_id')
            ->select(
                DB::raw('p.name,SUM(fd.tot) as tot'),
            )
            ->groupBy('p.name')
            ->where('f.status', 1)
            ->limit(10)
            ->get();
        return $products_r;
    }


    public function store(Request $request)
    {
        Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'price_two' => $request['price_two'],
            'cost' => $request['cost'],
            'categorie_id' => $request['categorie_id'],
        ]);
        return response()->json(['message' => 'El producto ha sido creado'], 200);
    }

    public function update($id)
    {
        $product = Product::find($id, ['id']);
        $product->fill([
            'name' => request('name'),
            'price' => request('price'),
            'price_two' => request('price_two'),
            'cost' => request('cost'),
            'categorie_id' => request('categorie_id'),

        ])->save();
        return response()->json(['message' => 'El producto ha sido modificado'], 201);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["message" => "Producto no encontrado"], 404);
        }
        $product->delete();
        return response()->json(["message" => "Producto eliminado"]);
    }
}
