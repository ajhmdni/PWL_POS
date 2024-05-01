<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed get all categories.',
            'data' => [
                'categories' => KategoriModel::all()
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'kategori_kode' => 'required|unique:m_kategori,kategori_kode|max:10',
                'kategori_nama' => 'required|max:100'
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

        $category = KategoriModel::create($request->all());

        if (!$category) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'There is a problem with the server.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'status_code' => 201,
            'message' => 'Succeed create a new category.',
            'data' => [
                'category' => $category,
            ]
        ], 201);
    }

    public function show(int $category_id)
    {
        $findedCategory = KategoriModel::find($category_id);

        if (!$findedCategory) {
            return response()->json([
                'success' => false,
                'status_code' => 404,
                'message' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Category founded.',
            'data' => [
                'category' => $findedCategory,
            ]
        ], 200);
    }

    public function update(Request $request, int $category_id)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'kategori_kode' => 'unique:m_kategori,kategori_kode,' . $category_id . ',kategori_id|max:10',
                'kategori_nama' => 'max:100',
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
        

        KategoriModel::find($category_id)->update($request->all());

        return response()->json([
            'success'=> true,
            'status_code' => 200,
            'message' => 'Succeed update category.',
            'data' => [
                'category' => KategoriModel::find($category_id),
            ]
        ], 200);
    }

    public function destroy(int $category_id)
    {
        $category = KategoriModel::find($category_id);

        if (!$category) {
            return response()->json([
                'success'=> false,
                'status_code' => 404,
                'message' => 'Category not found.'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed delete category.',
        ], 200);
    }
}
