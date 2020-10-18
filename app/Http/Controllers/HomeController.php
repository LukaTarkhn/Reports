<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Report;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $search = request()->input('search');
        $reportStatus = request()->input('reportStatus');
        $organizationStatus = request()->input('organizationStatus');
        $byPeriod = request()->input('byPeriod');
        $byUser = request()->input('byUser');

        $users = User::all();

        if ($search) {
            $reports = Report::latest()->where('grantN', 'like', "%$search%")
                ->orWhere('grantLeder', 'like', "%$search%")
                ->orWhere('orgName', 'like', "%$search%")
                ->orWhere('budget', 'like', "%$search%")
                ->orWhere('income1', 'like', "%$search%")
                ->orWhere('income2', 'like', "%$search%")
                ->orWhere('income3', 'like', "%$search%")
                ->orWhere('outcome1', 'like', "%$search%")
                ->orWhere('outcome2', 'like', "%$search%")
                ->orWhere('outcome3', 'like', "%$search%")
                ->orWhere('jobChangeEflow', 'like', "%$search%")
                ->orWhere('jobChangeOrderNumber', 'like', "%$search%")
                ->orWhere('jobTerminationEflow', 'like', "%$search%")
                ->orWhere('jobTerminationOrderNumber', 'like', "%$search%")
                ->orWhere('contractSignData', 'like', "%$search%")
                ->paginate(40);
        }elseif ($reportStatus){
            $reports = Report::latest()->where('Status', 'like', "%$reportStatus%")->paginate(40);
        }elseif ($organizationStatus){
            $reports = Report::latest()->where('orgStatus', 'like', "%$organizationStatus%")->paginate(40);
        }elseif ($byPeriod){
            $reports = Report::latest()->where('currPeriod', 'like', "%$byPeriod%")->paginate(40);
        }elseif ($byUser){
            $reports = Report::latest()->where('user_id', 'like', "%$byUser%")->paginate(40);
        } else {
            $reports = Report::latest()->where('user_id', auth()->user()->id)->paginate(40);
        }

        return view('home', compact('users'))->with('reports', $reports);
    }
}
