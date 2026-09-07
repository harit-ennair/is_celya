<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments with filters.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Appointment::with(['user', 'service']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->query('user_id'));
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->query('service_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_at', $request->query('date'));
        }

        $appointments = $query->orderBy('appointment_at', 'desc')->paginate(15);

        return response()->json([
            'data' => $appointments,
            'pagination' => [
                'total' => $appointments->total(),
                'per_page' => $appointments->perPage(),
                'current_page' => $appointments->currentPage(),
                'last_page' => $appointments->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'appointment_at' => ['required', 'date', 'after:now'],
            'notes' => ['nullable', 'string'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        if (! $service->is_active) {
            return response()->json([
                'message' => 'This service is currently unavailable.',
            ], 422);
        }

        $appointment = Appointment::create([
            'user_id' => $validated['user_id'],
            'service_id' => $service->id,
            'appointment_at' => $validated['appointment_at'],
            'price' => $service->price,
            'status' => AppointmentStatus::Pending,
            'notes' => $validated['notes'] ?? null,
        ]);

        $appointment->load(['user', 'service']);

        return response()->json([
            'message' => 'Appointment booked successfully',
            'appointment' => $appointment,
        ], 201);
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment): JsonResponse
    {
        $appointment->load(['user', 'service']);

        return response()->json([
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'appointment_at' => ['sometimes', 'required', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', new Enum(AppointmentStatus::class)],
        ]);

        $appointment->update($validated);

        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Confirm the appointment.
     */
    public function confirm(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => AppointmentStatus::Confirmed]);

        return response()->json([
            'message' => 'Appointment confirmed successfully',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Complete the appointment.
     */
    public function complete(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => AppointmentStatus::Completed]);

        return response()->json([
            'message' => 'Appointment completed successfully',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Cancel the appointment.
     */
    public function cancel(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => AppointmentStatus::Cancelled]);

        return response()->json([
            'message' => 'Appointment cancelled successfully',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Mark appointment as no-show.
     */
    public function noShow(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => AppointmentStatus::NoShow]);

        return response()->json([
            'message' => 'Appointment marked as no-show',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();

        return response()->json([
            'message' => 'Appointment deleted successfully',
        ]);
    }
}
