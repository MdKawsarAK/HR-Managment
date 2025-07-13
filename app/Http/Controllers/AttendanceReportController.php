<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceReportController extends Controller
{
    public function index()
    {
        $officeStartTime = Carbon::createFromTimeString('09:00:00');
        $officeEndTime = Carbon::createFromTimeString('17:00:00');

        $employees = Employee::with(['attendances' => function ($query) {
            $query->whereDate('date', Carbon::today());
        }])->get();

        $report = [];

        foreach ($employees as $employee) {
            $attendance = $employee->attendances->first();
            $status = 'Absent';
            $late = false;
            $overtime = false;
            $workingHours = 0;

            if ($attendance) {
                $status = 'Present';

                if ($attendance->check_in) {
                    $checkIn = Carbon::parse($attendance->check_in);
                    if ($checkIn->gt($officeStartTime)) {
                        $late = true;
                    }
                }

                if ($attendance->check_out) {
                    $checkOut = Carbon::parse($attendance->check_out);
                    $workingHours = $checkOut->diffInHours(Carbon::parse($attendance->check_in));

                    if ($checkOut->gt($officeEndTime)) {
                        $overtime = true;
                    }
                }
            }

            $report[] = [
                'employee' => $employee->first_name,
                'status' => $status,
                'late' => $late,
                'overtime' => $overtime,
                'working_hours' => $workingHours,
            ];
        }

        return view('pages.attendances.report', compact('report'));
    }
}