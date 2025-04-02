<?php

namespace App\Http\Controllers;

use DatePeriod;
use Carbon\Carbon;
use App\Models\User;
use App\Models\DealModel;
use App\Models\AccountModel;
use App\Models\ActivitiesModel;
use App\Models\ContactModel;
use Illuminate\Http\Request;
use App\Models\ProspectModel;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reports_sales()
    {
        $data = User::where('role', 'sales')->get();
        return view('reports.reports_sales', ['sales' => $data]);
    }

    public function view_report($id)
    {
        $sales = User::findOrFail($id);

        $prospect_sources = [
            'Advertising' => ProspectModel::where('user_id', $id)->where('prospect_source', 'Advertising')->count(),
            'Social Media' => ProspectModel::where('user_id', $id)->where('prospect_source', 'Social Media')->count(),
            'Direct Call' => ProspectModel::where('user_id', $id)->where('prospect_source', 'Direct Call')->count(),
            'Search' => ProspectModel::where('user_id', $id)->where('prospect_source', 'Search')->count(),
        ];

        // Count data
        $prospects_count = ProspectModel::where('user_id', $id)->where('status', 'aktif')->count();
        $accounts_count = AccountModel::where('user_id', $id)->count();
        $contacts_count = ContactModel::where('user_id', $id)->count();
        $deals_count = DealModel::where('user_id', $id)->count();
        $total_amount = DealModel::where('user_id', $id)->sum('amount');
        $total_activities = ProspectModel::whereHas('activities', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->count();


        return view('reports.view_report', [
            'sales' => $sales,
            'prospects_count' => $prospects_count,
            'accounts_count' => $accounts_count,
            'contacts_count' => $contacts_count,
            'deals_count' => $deals_count,
            'total_amount' => $total_amount,
            'prospect_sources' => $prospect_sources,
            'total_activities' => $total_activities,
        ]);
    }

    public function details_deals(Request $request, $user_id)
    {
        $sales = User::findOrFail($user_id);

        // Ambil nilai input tanggal jika ada, jika tidak default ke NULL
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Query deals dengan filter tanggal jika ada input
        $deals = DealModel::where('user_id', $user_id)
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('closing_date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('closing_date', '<=', $end_date);
            })
            ->get();

        return view('reports.details_deals', compact('sales', 'deals', 'start_date', 'end_date'));
    }

    public function details_activities(Request $request, $user_id)
    {
        $sales = User::findOrFail($user_id);

        $activities = ProspectModel::whereHas('activities', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return view('reports.details_activities', compact('sales', 'activities'));
    }

    public function view_report_activities($id)
    {

        $prospect = ProspectModel::findOrFail($id);

        $activities = ActivitiesModel::where('prospect_id', $id)
            ->orderBy('date_time', 'desc')
            ->get();


        return view('reports.view_report_activities', [
            'prospect' => $prospect,
            'activities' => $activities,
        ]);
    }


    public function details_accounts(Request $request, $user_id)
    {
        $sales = User::findOrFail($user_id);
        $accounts = AccountModel::where('user_id', $user_id)->get();

        return view('reports.details_accounts', compact('sales', 'accounts'));
    }

    public function details_contacts(Request $request, $user_id)
    {
        $sales = User::findOrFail($user_id);
        $contacts = ContactModel::where('user_id', $user_id)->get();

        return view('reports.details_contacts', compact('sales', 'contacts'));
    }

    public function details_prospects(Request $request, $user_id)
    {
        $sales = User::findOrFail($user_id);
        $prospects = ProspectModel::where('user_id', $user_id)->where('status', 'aktif')->get();

        return view('reports.details_prospects', compact('sales', 'prospects'));
    }

    public function getChartData($id, Request $request)
    {
        $filter = $request->input('filter', '1_month');
        $sales = User::findOrFail($id);

        switch ($filter) {
            case '1_week':
                $startDate = Carbon::now()->subWeek()->startOfDay();
                $groupBy = 'day';
                $dateFormat = '%Y-%m-%d';
                break;
            case '1_month':
                $startDate = Carbon::now()->subMonth()->startOfDay();
                $groupBy = 'day';
                $dateFormat = '%Y-%m-%d';
                break;
            case '3_month':
                $startDate = Carbon::now()->subMonths(3)->startOfMonth();
                $groupBy = 'week';
                $dateFormat = '%X-%V'; // ISO Year-Week format
                break;
            case '1_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $groupBy = 'month';
                $dateFormat = '%Y-%m';
                break;
            default:
                $startDate = Carbon::now()->subMonth()->startOfDay();
                $groupBy = 'day';
                $dateFormat = '%Y-%m-%d';
        }

        $endDate = Carbon::now()->endOfDay();

        // Generate period intervals
        $periods = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            switch ($groupBy) {
                case 'day':
                    $periodKey = $current->format('Y-m-d');
                    $label = $current->format('M j');
                    $current->addDay();
                    break;
                case 'week':
                    $periodKey = $current->format('o-W');
                    $label = 'Wk ' . $current->format('W');
                    $current->addWeek();
                    break;
                case 'month':
                    $periodKey = $current->format('Y-m');
                    $label = $current->format('M Y');
                    $current->addMonthNoOverflow();
                    break;
            }
            $periods[$periodKey] = ['label' => $label, 'total_amount' => 0];
        }

        $query = DealModel::where('user_id', $id)
            ->whereBetween('created_at', [$startDate, $endDate]);

        switch ($groupBy) {
            case 'day':
                $query->selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as period, SUM(amount) as total_amount")->groupBy('period');
                break;
            case 'week':
                $query->selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as period, SUM(amount) as total_amount")->groupBy('period');
                break;
            case 'month':
                $query->selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as period, SUM(amount) as total_amount")->groupBy('period');
                break;
        }

        $deals = $query->get();

        foreach ($deals as $deal) {
            if (isset($periods[$deal->period])) {
                $periods[$deal->period]['total_amount'] = $deal->total_amount;
            }
        }

        return response()->json([
            'labels' => array_column($periods, 'label'),
            'data' => array_column($periods, 'total_amount')
        ]);
    }

    public function reports_prospects()
    {
        $data = ProspectModel::where('status', '!=', 'non-aktif')->with('user')->get();

        return view('reports.reports_prospects', ['prospects' => $data]);
    }

    public function reports_accounts()
    {
        $data = AccountModel::with('user')->get();

        return view('reports.reports_accounts', ['accounts' => $data]);
    }

    public function reports_contacts()
    {
        $data = ContactModel::with('user')->get();

        return view('reports.reports_contacts', ['contacts' => $data]);
    }

    public function reports_deals()
    {
        $data = DealModel::with('user')->get();

        return view('reports.reports_deals', ['deals' => $data]);
    }
}
