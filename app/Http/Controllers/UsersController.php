<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\Brand;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
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
            'pageTitle' => 'Created user',
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
            'brands_selected' => $users->first()->user_brand->pluck('id')->toArray(),
        ];

        return view('pages.utility.users.edit', $datas);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'roles' => function ($attribute, $value, $fail) {
                if ($value === null || $value === 'undefined') {
                    $fail('The role field is required.');
                }
            },
            'nik' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'address' => 'nullable',
            'brand_lists' => 'required',
            'menu_lists' => [
                'required',
                function ($attribute, $value, $fail) {
                    $menuLists = json_decode($value, true);
                    if (
                        !is_array($menuLists) ||
                        empty($menuLists['add']) && empty($menuLists['edit']) && empty($menuLists['view'])
                    ) {
                        $fail('The menu lists field must have at least one menu selected.');
                    }
                },
            ],
        ], [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'roles.required' => 'Role is required.',
            'nik.required' => 'Nik is required.',
            'dob.required' => 'Dob is required.',
            'email.required' => 'Email is required.',
            'gender.required' => 'Gender is required.',
            'brand_lists.required' => 'Brand is required.',
            'menu_lists.required' => 'Menu is required.',
        ]);

        // Tambahkan validasi password jika ada input
        if ($request->filled('password')) {
            $passwordValidation = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password',
            ], [
                'password.required' => 'Password is required.',
                'password.min' => 'The minimum password allowed is 6 characters.',
                'password_confirm.required' => 'Password confirmation is required.',
                'password_confirm.same' => 'Password confirmation is not the same as password.',
            ]);

            if ($passwordValidation->fails()) {
                return response()->json([
                    'errors' => $passwordValidation->errors(),
                    'messages' => "Password validation failed!"
                ], 400);
            }
        }

        // Jika validasi lainnya gagal
        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        }

        $user = User::with('user_menu', 'user_brand')->findOrFail($id);

        // Update data utama
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = $request->input('roles');

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        // Update user detail
        $dob = $request->input('dob');
        $dob_format = Carbon::createFromFormat('m/d/Y', $dob)->format('Y-m-d');

        $user->user_detail->update([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'nik' => $request->input('nik'),
            'dob' => $dob_format,
            'address' => $request->input('address'),
        ]);

        // **Update user_menu**
        $menuData = $request->input('menu_lists');
        if ($menuData) {
            $menus = json_decode($menuData, true);
            if ($menus) {
                // Hapus data sebelumnya
                $user->user_menu()->detach();

                // Siapkan data baru
                $menuIds = collect($menus['add'])
                    ->merge($menus['edit'])
                    ->merge($menus['view'])
                    ->unique()
                    ->values();

                $userMenus = $menuIds->mapWithKeys(function ($menuId) use ($menus) {
                    return [
                        $menuId => [
                            'can_add' => in_array($menuId, $menus['add']),
                            'can_edit' => in_array($menuId, $menus['edit']),
                            'can_view' => in_array($menuId, $menus['view']),
                        ],
                    ];
                });

                // Tambahkan data baru
                $user->user_menu()->attach($userMenus);
            }
        }

        // **Update user_brand**
        $brandLists = $request->input('brand_lists');
        if ($brandLists) {
            $brandIds = explode(',', $brandLists);

            // Hapus data sebelumnya
            $user->user_brand()->detach();

            // Tambahkan data baru
            $user->user_brand()->attach($brandIds);
        }

        return response()->json(['success' => 'User updated successfully'], 200);
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
            'nik' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'address' => 'nullable',
            'brand_lists' => 'required',
            'menu_lists' => [
                'required',
                function ($attribute, $value, $fail) {
                    $menuLists = json_decode($value, true);
                    if (
                        !is_array($menuLists) ||
                        empty($menuLists['add']) && empty($menuLists['edit']) && empty($menuLists['view'])
                    ) {
                        $fail('The menu lists field must have at least one menu selected.');
                    }
                },
            ],
        ], [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'The minimum password allowed is 6 characters.',
            'password_confirm.required' => 'Password confirmation is required.',
            'password_confirm.same' => 'Password confirmation is not the same as password.',
            'roles.required' => 'Role is required.',
            'nik.required' => 'Nik is required.',
            'dob.required' => 'Dob is required.',
            'email.required' => 'Email is required.',
            'gender.required' => 'Gender is required.',
            'brand_lists.required' => 'Brand is required.',
            'menu_lists.required' => 'Menu is required.',
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

            // Format tahun_pendidikan
            $dob = $request->input('dob');
            $dob_format = Carbon::createFromFormat('m/d/Y', $dob)->format('Y-m-d');

            $dataDetailRegister = [
                'user_id' => $user->id,
                'name' => $request->input('name'),
                'gender' => $request->input('gender'),
                'nik' => $request->input('nik'),
                'dob' => $dob_format,
                'address' => $request->input('address'),
            ];
            UserDetail::create($dataDetailRegister);

            //? Menu List Process
            $userId = $user->id;
            $menuData = $request->input('menu_lists'); // Data menu (JSON)
            $menus = json_decode($menuData, true); // Decode JSON ke array

            if (!$menus || (empty($menus['add']) && empty($menus['edit']) && empty($menus['view']))) {
                return response()->json(['errors' => 'Invalid or empty menu data'], 422);
            }

            $menuIds = collect($menus['add'])
                ->merge($menus['edit'])
                ->merge($menus['view'])
                ->unique()
                ->values();

            $userMenus = $menuIds->map(function ($menuId) use ($menus, $userId) {
                return [
                    'user_id' => $userId,
                    'menu_id' => $menuId,
                    'can_add' => in_array($menuId, $menus['add']),
                    'can_edit' => in_array($menuId, $menus['edit']),
                    'can_view' => in_array($menuId, $menus['view']),
                ];
            })->sortBy(function ($item) {
                return (int) $item['menu_id'];
            })->values();

            DB::table('user_menu')->insert($userMenus->toArray());

            //? Brand List Process
            $brand_lists = $request->input('brand_lists');
            $dt_brandList = explode(",", $brand_lists);

            if (!empty($dt_brandList)) {
                $data = [];
                foreach ($dt_brandList as $dm) {
                    $data[] = [
                        'user_id' => $user->id,
                        'brand_id' => intval($dm)
                    ];
                }
                DB::table('user_brand')->insert($data);
            } else {
                return response()->json(['errors' => 'No brand selected'], 422);
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
