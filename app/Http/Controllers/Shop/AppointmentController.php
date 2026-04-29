<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\CarAppointment;
use App\Models\CarPurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Showroom config
    const LOCATION = 'F1 Store Showroom, 123 Racing Street';
    const SLOT_HOURS = 2.5; // 2 hours 30 minutes
    const START_HOUR = 9;   // 9:00 AM
    const END_HOUR   = 17;  // 5:00 PM (last slot starts at 4:30 but we cap at END_HOUR)
    const DAYS_AHEAD = 14;  // Show next 14 days

    public function create($requestId)
    {
        $carRequest = CarPurchaseRequest::with(['product.carModel.team', 'appointment'])
            ->where('request_id', $requestId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Guard: only approved walk-in requests
        if ($carRequest->request_status !== 'approved' || $carRequest->payment_preference !== 'walk_in') {
            abort(403, 'This request is not eligible for appointment booking.');
        }

        // Guard: already booked
        if ($carRequest->appointment) {
            return redirect()->route('shop.car-request.my-requests')
                ->with('error', 'You already have an appointment booked for this request.');
        }

        // Generate available slots for next 14 days (Mon-Fri only)
        $slots = $this->generateSlots();

        return view('shop.appointment.book', compact('carRequest', 'slots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_id'       => 'required|exists:car_purchase_requests,request_id',
            'appointment_date' => 'required|date|after:today',
        ]);

        $carRequest = CarPurchaseRequest::where('request_id', $request->request_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Guard checks
        if ($carRequest->request_status !== 'approved' || $carRequest->payment_preference !== 'walk_in') {
            abort(403);
        }
        if ($carRequest->appointment) {
            return back()->with('error', 'You already have an appointment for this request.');
        }

        // Check slot is not already taken
        $slotTaken = CarAppointment::where('appointment_date', $request->appointment_date)
            ->whereNotIn('appointment_status', ['cancelled'])
            ->exists();

        if ($slotTaken) {
            return back()->with('error', 'This slot has just been taken. Please choose another time.');
        }

        CarAppointment::create([
            'request_id'         => $carRequest->request_id,
            'user_id'            => Auth::id(),
            'appointment_date'   => $request->appointment_date,
            'location'           => self::LOCATION,
            'appointment_status' => 'scheduled',
        ]);

        return redirect()->route('shop.car-request.my-requests')
            ->with('success', 'Appointment booked! We will see you at the showroom.');
    }

    private function generateSlots(): array
    {
        $slots = [];
        $today = Carbon::today();

        // Get already booked slots
        $bookedSlots = CarAppointment::whereNotIn('appointment_status', ['cancelled'])
            ->where('appointment_date', '>=', $today)
            ->pluck('appointment_date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d H:i:s'))
            ->toArray();

        for ($d = 1; $d <= self::DAYS_AHEAD; $d++) {
            $date = $today->copy()->addDays($d);

            // Skip weekends
            if ($date->isWeekend()) continue;

            $daySlots = [];
            $slotStart = $date->copy()->setHour(self::START_HOUR)->setMinute(0)->setSecond(0);

            while (true) {
                $slotEnd = $slotStart->copy()->addMinutes(self::SLOT_HOURS * 60);

                // Stop if slot end exceeds end hour
                if ($slotEnd->hour > self::END_HOUR || ($slotEnd->hour === self::END_HOUR && $slotEnd->minute > 0)) {
                    break;
                }

                $slotKey = $slotStart->format('Y-m-d H:i:s');
                $isBooked = in_array($slotKey, $bookedSlots);

                $daySlots[] = [
                    'datetime'  => $slotKey,
                    'label'     => $slotStart->format('g:i A') . ' – ' . $slotEnd->format('g:i A'),
                    'is_booked' => $isBooked,
                ];

                $slotStart = $slotEnd;
            }

            if (!empty($daySlots)) {
                $slots[$date->format('Y-m-d')] = [
                    'label' => $date->format('l, d M Y'),
                    'slots' => $daySlots,
                ];
            }
        }

        return $slots;
    }
}