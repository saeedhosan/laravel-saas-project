<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SimpleMail;
use App\Models\Customer;
use App\Models\Invoices;
use App\Models\Todos;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    /**
     * Show admin home.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {

        $breadcrumbs = [
            ['link' => '/dashboard', 'name' => __('locale.menu.Dashboard')],
            ['name' => User::fullname()],
        ];

        $driver = DB::getDriverName();

        // DAY extraction - cross DB
        $daySql = match ($driver) {
            'mysql', 'mariadb' => 'DAY(created_at)',
            'pgsql'  => 'EXTRACT(DAY FROM created_at)',
            'sqlite' => "CAST(strftime('%d', created_at) AS INTEGER)",
            'sqlsrv' => 'DATEPART(day, created_at)',
            default  => 'DAY(created_at)',
        };

        // MONTH extraction - cross DB
        $monthSql = match ($driver) {
            'mysql', 'mariadb' => 'MONTH(created_at)',
            'pgsql'  => 'EXTRACT(MONTH FROM created_at)',
            'sqlite' => "CAST(strftime('%m', created_at) AS INTEGER)",
            'sqlsrv' => 'DATEPART(month, created_at)',
            default  => 'MONTH(created_at)',
        };

        /**
         * ---- REVENUE (current month) ----
         * FORMAT MUST REMAIN:
         * pluck('revenue', 'day') => [day => revenue]
         */
        $revenue = Invoices::CurrentMonth()
            ->selectRaw("$daySql as day, COUNT(uid) as revenue")
            ->groupBy('day')
            ->pluck('revenue', 'day');

        $revenue_chart = (new LarapexChart)->lineChart()
            ->addData(__('locale.labels.revenue'), $revenue->values()->toArray())
            ->setXAxis($revenue->keys()->toArray());

        /**
         * ---- CUSTOMERS (this year) ----
         * FORMAT MUST REMAIN:
         * pluck('customer', 'month') => [month => customer]
         */
        $customers = Customer::thisYear()
            ->selectRaw("$monthSql as month, COUNT(uid) as customer")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('customer', 'month');

        $customer_growth = (new LarapexChart)->barChart()
            ->addData(__('locale.labels.customers_growth'), $customers->values()->toArray())
            ->setXAxis($customers->keys()->toArray());

        /**
         * ---- TASK COUNTS ----
         * Returned exactly the same as before
         */
        $task = (object) [
            'in_progress' => Todos::where('status', 'in_progress')->count(),
            'complete'    => Todos::where('status', 'complete')->count(),
            'reviews'     => Todos::where('status', 'review')->count(),
            'all'         => Todos::count(),
        ];

        return view('admin.dashboard', compact(
            'breadcrumbs',
            'revenue_chart',
            'customer_growth',
            'task'
        ));
    }

    public function adminTest(Request $request)
    {

        Mail::to('appsaeed7@gmail.com')->send(new SimpleMail([
            'subject' => 'Your email successfully sent to Saeed Hossen',
            'message' => 'Test mail from laravel',
            'bodySub' => 'test subject body from laravel',
        ]));

        return response()->json([
            'status'  => 'success',
            'message' => 'Mail sent successfully',
        ]);
    }

    protected function redirectResponse(Request $request, $message, $type = 'success')
    {
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => $type,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with("flash_{$type}", $message);
    }
}
