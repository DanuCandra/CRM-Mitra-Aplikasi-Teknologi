<?php

namespace App\Http\Controllers;

use App\Models\DealModel;
use App\Models\ProspectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admincontroller extends Controller
{

    public function sales()
    {
        if (!Auth::check() || Auth::user()->id == null) {
            return redirect()->route('login');
        }

        if (!Auth::user() || Auth::user()->role == null) {
            return redirect()->route('login');
        }


        $total_prospects = ProspectModel::where('user_id', Auth::user()->id)->count();
        $total_deals = DealModel::where('user_id', Auth::user()->id)->count();
        $total_amount = DealModel::where('user_id', Auth::user()->id)->sum('amount');

        // Hitung jumlah prospects berdasarkan source
        $prospect_sources = [
            'Advertising' => ProspectModel::where('user_id', Auth::user()->id)->where('prospect_source', 'Advertising')->count(),
            'Social Media' => ProspectModel::where('user_id', Auth::user()->id)->where('prospect_source', 'Social Media')->count(),
            'Direct Call' => ProspectModel::where('user_id', Auth::user()->id)->where('prospect_source', 'Direct Call')->count(),
            'Search' => ProspectModel::where('user_id', Auth::user()->id)->where('prospect_source', 'Search')->count(),
        ];

        $target_deals = 5;
        $current_month_start = now()->startOfMonth();
        $current_month_end = now()->endOfMonth();

        $deals_this_month = DealModel::where('user_id', Auth::user()->id)
            ->whereBetween('created_at', [$current_month_start, $current_month_end])
            ->count();

        // Hitung progress
        $progress_percentage = min(($deals_this_month / $target_deals) * 100, 100);

        return view('dashboard.sales_dashboard', [
            'total_prospects' => $total_prospects,
            'total_deals' => $total_deals,
            'total_amount' => $total_amount,
            'prospect_sources' => $prospect_sources,
            'deals_this_month' => $deals_this_month,
            'target_deals' => $target_deals,
            'progress_percentage' => $progress_percentage
        ]);
    }

    public function getSalesData(Request $request)
    {
        $filter = $request->input('filter', '1_month');

        // Tentukan periode berdasarkan filter
        switch ($filter) {
            case '1_week':
                $startDate = now()->subWeek();
                $groupBy = 'day';
                break;
            case '1_month':
                $startDate = now()->subMonth();
                $groupBy = 'day';
                break;
            case '3_month':
                $startDate = now()->subMonths(3);
                $groupBy = 'week';
                break;
            case '1_year':
                $startDate = now()->subYear();
                $groupBy = 'month';
                break;
            default:
                $startDate = now()->subMonth();
                $groupBy = 'day';
        }
        $endDate = now();

        // Generate semua interval berdasarkan groupBy
        $periods = [];
        $current = clone $startDate;

        while ($current <= $endDate) {
            switch ($groupBy) {
                case 'day':
                    $periodKey = $current->format('Y-m-d');
                    $label = $current->format('M j');
                    $current->addDay();
                    break;
                case 'week':
                    // Perbaiki format key menjadi "tahun-Wminggu"
                    $periodKey = sprintf('%s-W%02d', $current->format('o'), $current->format('W'));
                    $label = 'Wk ' . $current->format('W');
                    $current->addWeek();
                    break;
                case 'month':
                    $periodKey = $current->format('Y-m');
                    $label = $current->format('M Y');
                    $current->addMonth();
                    break;
            }
            $periods[$periodKey] = [
                'label' => $label,
                'total_amount' => 0,
            ];
        }

        // Cek apakah user adalah admin
        if (Auth::user()->role === 'admin') {
            // Untuk admin, ambil semua deal tanpa filter user_id
            $query = DealModel::whereBetween('created_at', [$startDate, $endDate]);
        } else {
            // Untuk sales, ambil deal berdasarkan user_id
            $user_id = Auth::id();
            $query = DealModel::where('user_id', $user_id)
                ->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Query data berdasarkan groupBy
        switch ($groupBy) {
            case 'day':
                $query->selectRaw('DATE(created_at) as period, SUM(amount) as total_amount')
                    ->groupBy('period');
                break;
            case 'week':
                $query->selectRaw('YEARWEEK(created_at, 1) as period, SUM(amount) as total_amount')
                    ->groupBy('period');
                break;
            case 'month':
                $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(amount) as total_amount')
                    ->groupBy('period');
                break;
        }

        $deals = $query->get();

        // Isi data dari hasil query
        foreach ($deals as $deal) {
            $periodKey = $deal->period;
            if ($groupBy === 'week') {
                // Transformasi key dari query agar sesuai dengan format interval
                $year = substr($periodKey, 0, 4);
                $week = substr($periodKey, 4);
                $periodKey = sprintf('%s-W%02d', $year, $week);
            }
            if (isset($periods[$periodKey])) {
                $periods[$periodKey]['total_amount'] = $deal->total_amount * 1; // Pastikan nilai numeric
            }
        }

        // Ekstrak label dan data
        $labels = array_column($periods, 'label');
        $data = array_column($periods, 'total_amount');

        return response()->json(compact('labels', 'data'));
    }





    public function admin()
    {
        $prospect_sources = [
            'Advertising' => ProspectModel::where('prospect_source', 'Advertising')->count(),
            'Social Media' => ProspectModel::where('prospect_source', 'Social Media')->count(),
            'Direct Call' => ProspectModel::where('prospect_source', 'Direct Call')->count(),
            'Search' => ProspectModel::where('prospect_source', 'Search')->count(),
        ];

        $total_deals = DealModel::count();
        $total_sales = User::where('role', 'sales')->count();
        $total_amount = DealModel::sum('amount');
        $prospects_count = ProspectModel::where('status', 'aktif')->count();
        return view('dashboard.admin_dashboard', [
            'total_sales' => $total_sales,
            'total_deals' => $total_deals,
            'total_amount' => $total_amount,
            'prospect_sources' => $prospect_sources,
            'prospects_count' => $prospects_count,
        ]);
    }


    public function manage_admin()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.manage_admin', ['users' => $users]);
    }

    public function add_admin(Request $req)
    {
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User();
            $user->name = $req['name'];
            $user->email = $req['email'];
            $user->password = bcrypt($req['password']);
            $user->role = 'admin';
            $user->save();

            return redirect('/superadmin');
        }

        return view('admin.add_admin');
    }
}
