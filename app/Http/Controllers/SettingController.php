<?php

namespace App\Http\Controllers;

use App\Models\SettingApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function ajaxdataTables()
    {
        $data = SettingApp::orderBy('updated_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                return view('pages.setting.app.button', ['data' => $data]);
            })
            ->make(true);
    }

    public function index()
    {
        $datas = [
            'headerTitle' => 'Setting App',
            'pageTitle' => 'Setting App',
        ];

        return view('pages.setting.app.index', $datas);
    }

    public function edit()
    {
        $setting_app = SettingApp::get();

        $datas = [
            'headerTitle' => 'Setting App',
            'pageTitle' => 'Edit App Configure',
            'setting_app' => $setting_app,
        ];

        return view('pages.setting.app.edit', $datas);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'name_app' => 'required',
            'desc_app' => 'required',
            'logo_app' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ], [
            'name_app.required' => 'App Name is required.',
            'desc_app.required' => 'App Description is required.',
            'logo_app.image' => 'File must be an image.',
            'logo_app.mimes' => 'Image must be of type: jpg, png, jpeg.',
            'logo_app.max' => 'Image size must not exceed 1MB.',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors(),
                'messages' => "Data is not valid!"
            ], 400);
        }

        $setting_app = SettingApp::find($id);
        if (!$setting_app) {
            return response()->json(['notFound' => 'Setting app not found'], 404);
        }

        DB::beginTransaction();
        try {
            $updateData = [
                'name_app' => $request->input('name_app'),
                'desc_app' => $request->input('desc_app'),
            ];

            if ($request->hasFile('logo_app')) {
                // Hapus logo lama jika ada
                if ($setting_app->logo_app) {
                    $oldImagePath = storage_path('app/public/logo/' . $setting_app->logo_app);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Simpan logo baru
                $file = $request->file('logo_app');
                $extension = $file->getClientOriginalExtension();

                $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $request->input('name_app'));
                $filename = $cleanFileName . '.' . $extension;
                $file->storeAs('logo', $filename, 'public');

                $updateData['logo_app'] = $filename;
            }

            // Perbarui data di database
            $setting_app->update($updateData);

            DB::commit();

            // Perbarui ENV untuk nama aplikasi dan logo
            $this->updateEnv('APP_NAME', $request->input('name_app'));
            $this->updateEnv('APP_LOGO', $updateData['logo_app'] ?? '');

            // Perbarui runtime config dan clear cache
            config(['app.name' => $request->input('name_app')]);
            config(['app.logo' => $updateData['logo_app'] ?? '']);

            Artisan::call('optimize:clear');

            return response()->json(['success' => 'Successfully updated setting app'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Update failed!',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    private function updateEnv($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            // Tambahkan tanda kutip ke value
            $quotedValue = '"' . addslashes($value) . '"';

            file_put_contents(
                $path,
                preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$quotedValue}",
                    file_get_contents($path)
                )
            );
        }
    }
}
