<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{

    public function ajaxdataTables()
    {
        $data = Menu::orderBy('updated_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                return view('utility.menus.button', ['data' => $data]);
            })
            ->make(true);
    }

    public function index()
    {
        $datas = [
            'headerTitle' => 'Menus',
            'pageTitle' => 'Menus Management',
        ];

        return view('utility.menus.index', $datas);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'menu_name' => 'required',
            'menu_desc' => 'required',
        ], [
            'menu_name.required' => 'Menu Name is required.',
            'menu_desc.required' => 'Menu Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $data = [
                'menu_name' => $request->input('menu_name'),
                'menu_desc' => $request->input('menu_desc'),
            ];
            Menu::create($data);
            return response()->json(['success' => 'Successfully created new menu'], 200);
        }
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json([
            'messages' => 'Data berhasil di load',
            'data' => $menu
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'menu_name' => 'required',
            'menu_desc' => 'required',
        ], [
            'menu_name.required' => 'Menu Name is required.',
            'menu_desc.required' => 'Menu Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $menus = Menu::find($id);
            if (!$menus) {
                return response()->json(['message' => 'Menu not found'], 404);
            }
            $menus->update($request->all());
            return response()->json(['success' => 'Update menu successfully'], 200);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Menu::destroy($request->id);
            DB::commit();
            ToastrHelper::successMessage("Data menu berhasil dihapus");
            return redirect()->back();
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            if ($errorCode == 1451) {
                // Kesalahan terkait dengan foreign key constraint violation, beri pesan kesalahan yang sesuai
                DB::rollBack();
                ToastrHelper::errorMessage("Tidak dapat menghapus menu karena masih terkait dengan data lainnya.");
                return redirect()->back();
            } else {
                // Kesalahan lain, beri pesan kesalahan umum
                DB::rollBack();
                ToastrHelper::errorMessage("Terjadi kesalahan saat menghapus menu. Silakan coba lagi.");
                return redirect()->back();
            }
        }
    }
}
