<?php

namespace App\Repository;

use App\Interfaces\SettingInterface;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SettingRepository implements SettingInterface
{

    public function showEditSetting()
    {
        $setting = Setting::first();


         $settingData = $setting->only(['id', 'point_video', 'auction_vat_description', 'logo', 'about_us', 'privacy', 'phones', 'whatsapp', 'fcm_server']) ;

        return view('admin/settings/index', compact('settingData'));
    }

    public function updateSetting($request)
    {


        $id = $request->id;
        try {
            $setting = Setting::findOrFail($id);

            $inputs = $request->except('id');
            $path = $setting->logo;

            $this->uploadImage($request,$inputs);
            $this->deleteImage($request, $path);


            $setting->update($inputs);

            toastr()->addSuccess('تم التعديل الاعدادات بنجاح');
        } catch (\Exception $e) {
            toastr()->addError('هناك خطأ: ' . $e->getMessage());
        }
        return redirect()->route('setting.index')->send();

    }


    private function uploadImage($request, &$inputs)
    {
        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('uploads/setting', 'public');
            $inputs['logo'] = $imagePath;
        } else {
            unset($inputs['logo']);
        }
    }

    private function deleteImage($request, $path)
    {
        if ($request->hasFile('logo')) {

            $imagePath = asset('storage/' . $path);
            if (Storage::disk('public')->exists($path)) {

                Storage::disk('public')->delete($path);
            }

        }
    }
}
