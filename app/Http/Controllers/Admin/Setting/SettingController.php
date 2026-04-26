<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.setting');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $request->validated();
        try{
            DB::beginTransaction();
$setting = Setting::findOrFail($request->id);


        if ($request->hasFile('favicon')) {
            if (File::exists(public_path($setting->favicon))) {
                File::delete(public_path($setting->favicon));
            }
            $favicon = $request->file('favicon');
            $filename = Str::uuid() . time() . '.' . $favicon->getClientOriginalExtension();
            $favicon_path = $favicon->storeAs('uploads/setting/favicon', $filename, ['disk' => 'uploads']);
            $setting->favicon = $favicon_path;
        }
        if ($request->hasFile('logo')) {
            if (File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }
            $logo = $request->file('logo');
            $filename = Str::uuid() . time() . '.' . $logo->getClientOriginalExtension();
            $logo_path = $logo->storeAs('uploads/setting/logo', $filename, ['disk' => 'uploads']);
            $setting->logo = $logo_path;
        }
        $setting->save();
        $setting = $setting->update($request->except('logo', 'favicon'));
        if (!$setting) {
            flash()->error('Please Try Again');
            return redirect()->back();
        }
        flash()->success('Setting Updated Successfuly');
        DB::commit();
        return redirect()->back();
        }catch(\Exception $e){
     DB::rollBack();
     return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
