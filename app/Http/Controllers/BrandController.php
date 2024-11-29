<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function ajaxdataTables()
    {
        $data = Brand::orderBy('updated_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                return view('utility.brands.button', ['data' => $data]);
            })
            ->make(true);
    }

    public function index()
    {
        $datas = [
            'headerTitle' => 'Brands',
            'pageTitle' => 'Brands Management',
        ];

        return view('utility.brands.index', $datas);
    }


    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'brand_name' => 'required',
            'brand_desc' => 'required',
        ], [
            'brand_name.required' => 'Brand Name is required.',
            'brand_desc.required' => 'Brand Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $dataDetailRegister = [
                'brand_name' => $request->input('brand_name'),
                'brand_desc' => $request->input('brand_desc'),
            ];
            Brand::create($dataDetailRegister);
            return response()->json(['success' => 'Successfully created new brand'], 200);
        }
    }

    public function show($id)
    {
        $brands = Brand::findOrFail($id);
        return response()->json([
            'messages' => 'Data berhasil di load',
            'data' => $brands
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'brand_name' => 'required',
            'brand_desc' => 'required',
        ], [
            'brand_name.required' => 'Brand Name is required.',
            'brand_desc.required' => 'Brand Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $brands = Brand::find($id);
            if (!$brands) {
                return response()->json(['message' => 'Brand not found'], 404);
            }
            $brands->update($request->all());
            return response()->json(['success' => 'Update brand successfully'], 200);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Brand::destroy($request->id);
            DB::commit();
            ToastrHelper::successMessage("Data brand berhasil dihapus");
            return redirect()->back();
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            if ($errorCode == 1451) {
                // Kesalahan terkait dengan foreign key constraint violation, beri pesan kesalahan yang sesuai
                DB::rollBack();
                ToastrHelper::errorMessage("Tidak dapat menghapus brand karena masih ada data yang terkait dengan brand ini.");
                return redirect()->back();
            } else {
                // Kesalahan lain, beri pesan kesalahan umum
                DB::rollBack();
                ToastrHelper::errorMessage("Terjadi kesalahan saat menghapus brand. Silakan coba lagi.");
                return redirect()->back();
            }
        }
    }
}
