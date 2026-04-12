<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

        return view('admin.settings.index', compact('settings', 'testimonials'));
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

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'source' => 'required|in:manual,form,google',
        ]);

        $data = $request->all();
        $data['status'] = 'approved';

        // Handle Featured/Homepage checkboxes as boolean
        $data['is_featured'] = $request->has('is_featured');
        $data['display_on_homepage'] = $request->has('display_on_homepage');

        if ($request->hasFile('client_image')) {
            $image = $request->file('client_image');
            $name = 'testimonial_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonials'), $name);
            $data['client_image'] = 'uploads/testimonials/' . $name;
        }

        if ($request->id) {
            $testimonial = Testimonial::findOrFail($request->id);
            $testimonial->update($data);
            $msg = 'Testimonial updated successfully.';
        } else {
            Testimonial::create($data);
            $msg = 'Testimonial added successfully.';
        }

        return redirect()->back()
            ->with('success', $msg)
            ->with('active_tab', '#kt_tab_testimonials');
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial deleted successfully'
        ]);
    }
}
