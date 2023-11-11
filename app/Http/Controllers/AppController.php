<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class AppController extends Controller
{

    public function dashboard()
    {
        // Fetch notifications and staff members as needed
        $notifications = auth()->user()->receivedNotifications;
        $notifications = $notifications ? $notifications : [];
        $staffMembers = User::whereNotIn('id', [auth()->id()])->get();


        return view('dashboard', compact('notifications', 'staffMembers'));
    }
    public function notifyStaff(Request $request)
    {
        $request->validate([
            'page' => 'required|in:task,request,analysis',
            'reference_staff' => 'required|exists:users,id',
        ]);

        $page = $request->input('page');
        $referenceStaffId = $request->input('reference_staff');

        Notification::create([
            'staff_id' => auth()->id(),
            'reference_staff_id' => $referenceStaffId,
            'page' => $page,
        ]);

        return redirect()->back()->with('success', 'Referencing successful!');
    }

    public function taskPage()
    {
        return view('taskpage');
    }

    public function requestPage()
    {
   
        return view('requestpage');
    }

    public function analysisPage()
    {
        return view('analysispage');
    }
}
