<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed get all product.',
            'data' => [
                'products' => BarangModel::all(),
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'kategori_id' => 'exists:m_kategori,kategori_id',
                'barang_kode' => 'required|unique:m_barang,barang_kode|max:10',
                'barang_nama' => 'required|max:100',
                'harga_beli' => 'required|integer',
                'harga_jual' => 'required|integer',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status_code' => 400,
                'message' => 'Bad Request.',
                'errors' => $validator->errors()
            ], 400);
        }
        
        $product = BarangModel::create($request->all());

        if (!$product) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'There is a problem with the server.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'status_code' => 201,
            'message' => 'Succeed create a new product',
            'data' => [
                'product' => $product,
            ]
        ], 201);
    }

    public function show(int $product_id)
    {   
        $findedProduct = BarangModel::find($product_id);

        if (!$findedProduct) {
            return response()->json([
                'success' => false,
                'status_code' => 404,
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Product founded.',
            'data' => [
                'product' => $findedProduct,
            ]
        ], 200);
    }

    public function update(Request $request, int $product_id)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'kategori_id' => 'exists:m_kategori,kategori_id',
                'barang_kode' => 'unique:m_barang,barang_kode,' . $product_id . ',barang_id|max:10',
                'barang_nama' => 'max:100',
                'harga_beli' => 'integer',
                'harga_jual' => 'integer',
            ]
        );

        if ( $validator->fails() ) {
            return response()->json([
                'success' => false,
                'status_code' => 400,
                'message' => 'Bad Request.',
                'errors' => $validator->errors()
            ], 400);
        }

        BarangModel::find($product_id)->update( $request->all());

        return response()->json([
            'success'=> true,
            'status_code' => 200,
            'message' => 'Succeed update product.',
            'data' => [
                'product' => BarangModel::find($product_id)
            ]
        ], 200);
    }

    public function destroy(int $product_id)
    {
        $product = BarangModel::find($product_id);

        if (!$product) {
            return response()->json([
                'success'=> false,
                'status_code' => 404,
                'message' => 'Product not found.'
            ], 404);
        }

        $product->delete();
        
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed delete product.',
        ], 200);
    }
}
