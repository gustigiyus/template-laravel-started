<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\Brand;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function ajaxdataTables()
    {
        $data = User::with('roles', 'user_detail')->orderBy('updated_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                return view('pages.utility.users.button', ['data' => $data]);
            })
            ->make(true);
    }

    public function index()
    {
        $datas = [
            'headerTitle' => 'Users',
            'pageTitle' => 'Users Management',
            'users' => User::with('roles', 'user_detail')->get(),
            'roles' => Role::all(),
        ];

        return view('pages.utility.users.index', $datas);
    }

    public function create()
    {
        $datas = [
            'headerTitle' => 'Users',
            'pageTitle' => 'Created users',
            'users' => User::with('roles', 'user_detail')->get(),
            'roles' => Role::all(),
            'menus' => Menu::all(),
            'brands' => Brand::all(),
        ];

        return view('pages.utility.users.create', $datas);
    }

    public function edit($userId)
    {
        $users = User::with('user_detail', 'user_menu', 'user_brand')
            ->where(function ($query) use ($userId) {
                $query->whereHas('user_detail', function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', $userId);
                })
                    ->orWhereHas('user_menu', function ($subQuery) use ($userId) {
                        $subQuery->where('user_id', $userId);
                    })
                    ->orWhereHas('user_brand', function ($subQuery) use ($userId) {
                        $subQuery->where('user_id', $userId);
                    });
            })
            ->get();

        $datas = [
            'headerTitle' => 'Users',
            'pageTitle' => 'Edit users',
            'users' => $users,
            'roles' => Role::all(),
            'menus' => Menu::all(),
            'brands' => Brand::all(),
        ];

        return view('utility.users.edit', $datas);
    }

    public function update(Request $request)
    {
        if ($request->password === null && $request->password_confirm === null) {
            $validasi = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'roles' => function ($attribute, $value, $fail) {
                    if ($value === null || $value === 'undefined') {
                        $fail('The role field is required.');
                    }
                },
            ], [
                'name.required' => 'Name is required.',
                'username.required' => 'Username is required.',
                'roles.required' => 'Role is required.',
            ]);
        } else {
            $validasi = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password',
                'roles' => function ($attribute, $value, $fail) {
                    if ($value === null || $value === 'undefined') {
                        $fail('The role field is required.');
                    }
                },
            ], [
                'name.required' => 'Name is required.',
                'username.required' => 'Username is required.',
                'password.required' => 'Password is required.',
                'password.min' => 'The minimum password allowed is 6 characters.',
                'password_confirm.required' => 'Password confirmation is required.',
                'password_confirm.same' => 'Password confirmation is not the same as password.',
                'roles.required' => 'Role is required.',
            ]);
        }

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            if ($request->password === null && $request->password_confirm === null) {
                $dataRegister = [
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'role_id' => $request->input('roles'),
                ];
                User::where('id', $request->id)->update($dataRegister);
            } else {
                $dataRegister = [
                    'username' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'email' => $request->input('email'),
                    'role_id' => $request->input('roles'),
                ];
                User::where('id', $request->id)->update($dataRegister);
            }

            $dataDetailRegister = [
                'name' => $request->input('name'),
                'nik' => $request->input('nik'),
                'dob' => $request->input('dob'),
                'address' => $request->input('address'),
            ];
            UserDetail::where('user_id', $request->id)->update($dataDetailRegister);

            //? Menu List check
            $menu_lists = $request->input('menu_lists');
            $dt_menuList = explode(",", $menu_lists);

            if ($menu_lists) {
                $listMenuExists = DB::table('user_menu')->where('user_id', $request->id)->exists();
                $data = [];
                if ($listMenuExists) {
                    DB::table('user_menu')->where('user_id', $request->id)->delete();

                    foreach ($dt_menuList as $dm) {
                        $data[] = ['user_id' => $request->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_menu')->insert($data);
                } else {
                    foreach ($dt_menuList as $dm) {
                        $data[] = ['user_id' => $request->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_menu')->insert($data);
                }
            } else {
                $listMenuExists = DB::table('user_menu')->where('user_id', $request->id)->exists();
                if ($listMenuExists) {
                    DB::table('user_menu')->where('user_id', $request->id)->delete();
                }
            }

            //? Brand List check
            $brand_lists = $request->input('brand_lists');
            $dt_brandList = explode(",", $brand_lists);

            if ($brand_lists) {
                $listBrandExists = DB::table('user_brand')->where('user_id', $request->id)->exists();
                $data = [];
                if ($listBrandExists) {
                    DB::table('user_brand')->where('user_id', $request->id)->delete();

                    foreach ($dt_brandList as $dm) {
                        $data[] = ['user_id' => $request->id, 'brand_id' => intval($dm)];
                    }

                    DB::table('user_brand')->insert($data);
                } else {
                    foreach ($dt_brandList as $dm) {
                        $data[] = ['user_id' => $request->id, 'brand_id' => intval($dm)];
                    }

                    DB::table('user_brand')->insert($data);
                }
            } else {
                $listMenuExists = DB::table('user_brand')->where('user_id', $request->id)->exists();
                if ($listMenuExists) {
                    DB::table('user_brand')->where('user_id', $request->id)->delete();
                }
            }

            return response()->json(['success' => 'Successfully updated user'], 200);
        }
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'roles' => function ($attribute, $value, $fail) {
                if ($value === null || $value === 'undefined') {
                    $fail('The role field is required.');
                }
            },
        ], [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'The minimum password allowed is 6 characters.',
            'password_confirm.required' => 'Password confirmation is required.',
            'password_confirm.same' => 'Password confirmation is not the same as password.',
            'roles.required' => 'Role is required.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        } else {
            $dataRegister = [
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'email' => $request->input('email'),
                'role_id' => $request->input('roles'),
            ];
            $user = User::create($dataRegister);

            $dataDetailRegister = [
                'user_id' => $user->id,
                'name' => $request->input('name'),
                'nik' => $request->input('nik'),
                'dob' => $request->input('dob'),
                'address' => $request->input('address'),
            ];
            UserDetail::create($dataDetailRegister);

            //? Menu List check
            $menu_lists = $request->input('menu_lists');
            $dt_menuList = explode(",", $menu_lists);

            if ($menu_lists) {
                $listMenuExists = DB::table('user_menu')->where('user_id', $user->id)->exists();
                $data = [];
                if ($listMenuExists) {
                    DB::table('user_menu')->where('user_id', $user->id)->delete();

                    foreach ($dt_menuList as $dm) {
                        $data[] = ['user_id' => $user->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_menu')->insert($data);
                } else {
                    foreach ($dt_menuList as $dm) {
                        $data[] = ['user_id' => $user->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_menu')->insert($data);
                }
            }

            //? Brand List check
            $brand_lists = $request->input('brand_lists');
            $dt_brandList = explode(",", $brand_lists);

            if ($brand_lists) {
                $listBrandExists = DB::table('user_brand')->where('user_id', $user->id)->exists();
                $data = [];
                if ($listBrandExists) {
                    DB::table('user_brand')->where('user_id', $user->id)->delete();

                    foreach ($dt_brandList as $dm) {
                        $data[] = ['user_id' => $user->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_brand')->insert($data);
                } else {
                    foreach ($dt_brandList as $dm) {
                        $data[] = ['user_id' => $user->id, 'menu_id' => intval($dm)];
                    }

                    DB::table('user_brand')->insert($data);
                }
            }

            return response()->json(['success' => 'Successfully created new user'], 200);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            UserDetail::where('user_id', $request->id)->delete();
            DB::table('user_menu')->where('user_id', $request->id)->delete();
            User::destroy($request->id);

            DB::commit();
            ToastrHelper::successMessage("Data user berhasil dihapus");
            return redirect()->back();
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            if ($errorCode == 1451) {
                // Kesalahan terkait dengan foreign key constraint violation, beri pesan kesalahan yang sesuai
                DB::rollBack();
                ToastrHelper::errorMessage("Tidak dapat menghapus user karena pengguna terkait dengan data lain.");
                return redirect()->back();
            } else {
                // Kesalahan lain, beri pesan kesalahan umum
                DB::rollBack();
                ToastrHelper::errorMessage("Terjadi kesalahan saat menghapus user. Silakan coba lagi.");
                return redirect()->back();
            }
        }
    }
}
