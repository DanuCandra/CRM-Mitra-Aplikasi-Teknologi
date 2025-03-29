<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivitiesModel;
use App\Models\ProspectModel;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
{
    public function list_prospects()
    {
        $activities = ProspectModel::where('user_id', Auth::user()->id)
            ->where('status', 'aktif')
            ->get();
        return view('activities.list_prospects', ['activities' => $activities]);
    }

    public function add_activity($id, Request $req)
    {

        $procpect = ProspectModel::find($id);
        if ($procpect == '') {
            return redirect('/activities/list-prospects');
        }
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'title' => 'required',
                'description' => 'required',
                'date_time' => 'required|date',
            ]);

            $activity = new ActivitiesModel();
            $activity->user_id = Auth::user()->id;
            $activity->prospect_id = $id;
            $activity->title = $req['title'];
            $activity->description = $req['description'];
            $activity->date_time = $req['date_time'];
            $activity->save();
            return redirect('/activities/list-prospects');
        }
        return view('activities.add_activity', ['prospect' => $procpect]);
    }

    public function manage_activities()
    {
        // Ambil semua prospek yang memiliki aktivitas dan dimiliki oleh user yang login
        $prospectsWithActivities = ProspectModel::whereHas('activities', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('activities.manage_activities', ['prospects' => $prospectsWithActivities]);
    }

    public function view_activities($id)
    {
        // Cek apakah prospek ada dan milik user yang login
        $prospect = ProspectModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$prospect) {
            return redirect('/activities/manage-activities')->with('error', 'Prospect not found or unauthorized');
        }

        // Ambil semua aktivitas dari prospek ini
        $activities = ActivitiesModel::where('prospect_id', $id)
            ->where('user_id', Auth::id())
            ->orderBy('date_time', 'desc')
            ->get();

        return view('activities.view_activities', ['prospect' => $prospect, 'activities' => $activities]);
    }

    public function delete_activity($id)
    {
        $activity = ActivitiesModel::find($id);
        if ($activity) {
            $activity->delete();
        }
        return redirect('/activities/manage-activities');
    }

    public function edit_activity(Request $req, $id)
    {
        $activity = ActivitiesModel::find($id);
        if (!$activity) {
            return redirect('/activities/manage-activities');
        }

        $prospect = ProspectModel::find($activity->prospect_id);
        if (!$prospect) {
            return redirect('/activities/manage-activities');
        }

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'title' => 'required',
                'description' => 'required',
                'date_time' => 'required|date',
            ]);

            $activity->title = $req['title'];
            $activity->description = $req['description'];
            $activity->date_time = $req['date_time'];
            $activity->save();
            return redirect('/activities/view-activities/' . $prospect->id);
        }
        return view('activities.edit_activity', ['activity' => $activity, 'prospect' => $prospect]);
    }
}
