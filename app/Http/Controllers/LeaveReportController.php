<?php

use App\Models\LeaveConfig;
use App\Models\LeaveTransaction;
use App\Models\Employee;
use App\Models\LeaveCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month') ?? now()->format('Y-m');
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $configs = LeaveConfig::with(['employee', 'leaveCategory'])->get();

        $report = $configs->map(function ($config) use ($start, $end) {
            $used = LeaveTransaction::where('employee_id', $config->employee_id)
                ->where('leave_category_id', $config->leave_category_id)
                ->whereBetween('from_date', [$start, $end])
                ->sum('days');

            return (object)[
                'employee' => $config->employee,
                'category' => $config->leaveCategory->name,
                'allowed' => $config->days,
                'used' => $used,
                'remaining' => $config->days - $used
            ];
        });

        return view('pages.leaves.report', ['report' => $report, 'month' => $month]);
    }
}
