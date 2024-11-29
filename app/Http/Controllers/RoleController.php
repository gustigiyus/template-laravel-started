<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function ajaxdataTables()
    {
        $data = Role::orderBy('updated_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                return view('utility.roles.button', ['data' => $data]);
            })
            ->make(true);
    }

    public function index()
    {
        $datas = [
            'headerTitle' => 'Roles',
            'pageTitle' => 'Roles Management',
        ];

        return view('utility.roles.index', $datas);
    }


    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'role_name' => 'required',
            'role_desc' => 'required',
        ], [
            'role_name.required' => 'Role Name is required.',
            'role_desc.required' => 'Role Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $dataDetailRegister = [
                'role_name' => $request->input('role_name'),
                'role_desc' => $request->input('role_desc'),
            ];
            Role::create($dataDetailRegister);
            return response()->json(['success' => 'Successfully created new role'], 200);
        }
    }

    public function show($id)
    {
        $roles = Role::findOrFail($id);
        return response()->json([
            'messages' => 'Data berhasil di load',
            'data' => $roles
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'role_name' => 'required',
            'role_desc' => 'required',
        ], [
            'role_name.required' => 'Role Name is required.',
            'role_desc.required' => 'Role Description is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $roles = Role::find($id);
            if (!$roles) {
                return response()->json(['message' => 'Role not found'], 404);
            }
            $roles->update($request->all());
            return response()->json(['success' => 'Update role successfully'], 200);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Role::destroy($request->id);
            DB::commit();
            ToastrHelper::successMessage("Data role berhasil dihapus");
            return redirect()->back();
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            if ($errorCode == 1451) {
                // Kesalahan terkait dengan foreign key constraint violation, beri pesan kesalahan yang sesuai
                DB::rollBack();
                ToastrHelper::errorMessage("Tidak dapat menghapus role karena masih ada pengguna yang terkait dengan role ini.");
                return redirect()->back();
            } else {
                // Kesalahan lain, beri pesan kesalahan umum
                DB::rollBack();
                ToastrHelper::errorMessage("Terjadi kesalahan saat menghapus role. Silakan coba lagi.");
                return redirect()->back();
            }
        }
    }
}
