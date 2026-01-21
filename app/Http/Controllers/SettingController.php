<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Exclude inputs that shouldn't be saved directly as simple key-values
        $inputs = $request->except(['_token', 'logo', 'favicon', 'logo_remove', 'favicon_remove', 'active_tab']);

        // 1. Handle Inputs (Text & Arrays)
        foreach ($inputs as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            Setting::set($key, $value);
        }

        // 2. Handle Logo Upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            Setting::set('logo', 'uploads/settings/' . $name);
        } elseif ($request->input('logo_remove') == '1') {
            Setting::where('key', 'logo')->delete();
        }

        // 3. Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $name = 'favicon_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            Setting::set('favicon', 'uploads/settings/' . $name);
        } elseif ($request->input('favicon_remove') == '1') {
            Setting::where('key', 'favicon')->delete();
        }

        // Redirect back with success message and input (for active_tab)
        return redirect()->back()
            ->with('success', 'Settings updated successfully.')
            ->withInput(); 
    }
}
