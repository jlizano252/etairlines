<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Appointment;

class AppointmentAvailabilityService
{
    public array $availableSlots = [
        '08:00',
        '08:30',
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '13:00',
        '13:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
    ];

    public array $activeStatuses = [
        'scheduled',
        'confirmed',
    ];

    public function getAvailableSlots(): array
    {
        return $this->availableSlots;
    }

    public function getTakenSlotsForMonth(int $year, int $month): array
    {
        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end = $start->copy()->endOfMonth();

        $rows = Appointment::whereBetween('appointment_at', [$start, $end])
            ->whereIn('status', $this->activeStatuses)
            ->get(['appointment_at']);

        $taken = [];

        foreach ($rows as $row) {
            $dt = Carbon::parse($row->appointment_at);

            $date = $dt->format('Y-m-d');
            $time = $dt->format('H:i');

            $taken[$date][] = $time;
        }

        return $taken;
    }

    public function isSlotAvailable(
        string $date,
        string $time,
        ?int $ignoreStudentId = null
    ): bool {
        $appointmentAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            "{$date} {$time}"
        );

        if ($appointmentAt->isPast()) {
            return false;
        }

        $query = Appointment::where('appointment_at', $appointmentAt)
            ->whereIn('status', $this->activeStatuses);

        if ($ignoreStudentId) {
            $query->where('student_id', '!=', $ignoreStudentId);
        }

        return ! $query->exists();
    }

    public function studentHasActiveAppointment(int $studentId): bool
    {
        return Appointment::where('student_id', $studentId)
            ->whereIn('status', $this->activeStatuses)
            ->exists();
    }
}
