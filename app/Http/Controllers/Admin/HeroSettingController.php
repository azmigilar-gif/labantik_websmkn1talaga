<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_HeroSetting;
use Illuminate\Http\Request;

class HeroSettingController extends Controller
{
    /**
     * Show form for editing hero settings.
     */
    public function edit()
    {
        $settings = S_HeroSetting::getSettings();

        return view('admin.hero_settings.edit', compact('settings'));
    }

    /**
     * Update the hero settings.
     */
    public function update(Request $request)
    {
        $settings = S_HeroSetting::getSettings();

        $data = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'badge_1_title' => 'required|string|max:255',
            'badge_1_subtitle' => 'required|string|max:255',
            'badge_2_title' => 'required|string|max:255',
            'badge_2_subtitle' => 'required|string|max:255',
            'badge_3_title' => 'required|string|max:255',
            'badge_3_subtitle' => 'required|string|max:255',
            'trust_badge_1' => 'required|string|max:255',
            'trust_badge_2' => 'required|string|max:255',
            'trust_badge_3' => 'required|string|max:255',
        ]);

        $settings->update($data);

        return redirect()->route('admin.hero-settings.edit')->with('success', 'Hero & Badge settings updated successfully!');
    }
}
