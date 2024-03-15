<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Apointmentcontroller extends Controller
{
        public function indexappointment()
    {
    // Fetch all admins with their appointments
    // Fetch all appointments grouped by admin_name
    $appointments = Appointment::all()->groupBy('admin_name');

    return view('appointment', compact('appointments'));

    }
        public function addappointment(Request $request)
    {

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            $request->validate([
                'date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

                $Appointment = new Appointment([
                    'admin_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'user_id' => $user->id,
                    'image' => $user->image,
                    'date' => $request->input('date'),
                    'start_time' => $request->input('start_time'),
                    'end_time' => $request->input('end_time')
                ]);
                $Appointment->save();
        
            // Generate token and return response based on request type
            $token = $user->createToken('csd')->accessToken;
            if ($request->expectsJson()) {
                return response()->json(['success' => 'Product added to cart successfully.', 'token' => $token]);
            } else {
                return redirect()->back()->with('success', 'Product added to cart successfully.');
            }
        } else {
            // User not authenticated
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Please log in to add products to your cart.'], 401);
            } else {
                return redirect()->route('login')->with('error', 'Please log in to add products to your cart.');
            }
        }
    }
    public function Reservation(Request $request, $id)
    {

        if (Auth::check()) {
            $user = Auth::user();
            $appointment = Appointment::find($id);
    
            if ($appointment) {
                // Create a new reservation
                $reservation = new Reservation([
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'admin_name' => $appointment->admin_name,
                    'admin_email' => $appointment->email,
                    'phone' => $appointment->phone,
                    'admin_id' => $appointment->user_id,
                    'date' => $appointment->date,
                    'start_time' => $appointment->start_time,
                    'end_time' => $appointment->end_time,
                    'status' => 'pending',
                ]);
    
                $reservation->save();
    
                // Delete the appointment
                $appointment->delete();
    
                // Generate token and return response based on request type
                $token = $user->createToken('csd')->accessToken;
                if ($request->expectsJson()) {
                    return response()->json(['success' => 'Appointment reserved successfully.', 'token' => $token]);
                } else {
                    return redirect()->back()->with('success', 'Appointment reserved successfully.');
                }
            } else {
                // Appointment not found
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Appointment not found.'], 404);
                } else {
                    return redirect()->back()->with('error', 'Appointment not found.');
                }
            }
        } else {
            // User not authenticated
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Please log in to reserve appointments.'], 401);
            } else {
                return redirect()->route('login')->with('error', 'Please log in to reserve appointments.');
            }
        }
    }

    public function markReserved($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Reserved';
        $reservation->save();
    
        // Send email

        return redirect()->back()->with('success', 'Reservation marked as Reserved and email sent.');
    }

public function destroy($id)
{
    Reservation::destroy($id);
    return redirect()->back()->with('success', 'Reservation deleted successfully.');
}

}
