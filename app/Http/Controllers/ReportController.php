<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\ContactModel;
use App\Models\DealModel;
use App\Models\ProspectModel;
use App\Models\User;
use Illuminate\Http\Request;
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

        // Count data
        $prospects_count = ProspectModel::where('user_id', $id)->count();
        $accounts_count = AccountModel::where('user_id', $id)->count();
        $contacts_count = ContactModel::where('user_id', $id)->count();
        $deals_count = DealModel::where('user_id', $id)->count();
        $total_amount = DealModel::where('user_id', $id)->sum('amount');

        return view('reports.view_report', [
            'sales' => $sales,
            'prospects_count' => $prospects_count,
            'accounts_count' => $accounts_count,
            'contacts_count' => $contacts_count,
            'deals_count' => $deals_count,
            'total_amount' => $total_amount
        ]);
    }
}