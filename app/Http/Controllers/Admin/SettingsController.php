<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    //
    public function updateSetting(Request $request)
    {
       // Retrieve the value from the request
        $showActivitySummary = $request->input('show_activity_summary')=='true' ? 1 : 0;
        // Update or create the settings record
        Settings::updateOrCreate([], ['show_activity_summary' => $showActivitySummary]);
        // Return a JSON response with a success message
        return response()->json(['message' => 'Updated the activity summary.']);
    }
}
