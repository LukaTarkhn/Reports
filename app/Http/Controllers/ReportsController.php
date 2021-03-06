<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Report;


class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
                ->orWhere('coorgName1', 'like', "%$search%")
                ->orWhere('coorgName2', 'like', "%$search%")
                ->orWhere('fullbudget', 'like', "%$search%")
                ->orWhere('leadbudget', 'like', "%$search%")
                ->orWhere('cobudget1', 'like', "%$search%")
                ->orWhere('cobudget2', 'like', "%$search%")
                ->orWhere('income1', 'like', "%$search%")
                ->orWhere('income2', 'like', "%$search%")
                ->orWhere('income3', 'like', "%$search%")
                ->orWhere('outcome1', 'like', "%$search%")
                ->orWhere('outcome2', 'like', "%$search%")
                ->orWhere('outcome3', 'like', "%$search%")
                ->orWhere('jobChangeEflow', 'like', "%$search%")
                ->orWhere('jobTerminationEflow', 'like', "%$search%")
                ->orWhere('contractSignData', 'like', "%$search%")
                ->paginate(40);
        }elseif ($reportStatus){
            $reports = Report::latest()->where('Status', 'like', "$reportStatus")->paginate(40);
        }elseif ($organizationStatus){
            if ($organizationStatus == 'Lead') {
                $reports = Report::latest()->where('orgName', '<>', '')->paginate(40);
            }
            if ($organizationStatus == 'Participant') {
                $reports = Report::latest()->where('coorgName1', '<>', '')->orWhere('coorgName2', '<>', '')->paginate(40);
            }   
        }elseif ($byPeriod){
            $reports = Report::latest()->where('currPeriod', 'like', "$byPeriod")->paginate(40);
        }elseif ($byUser){
            $reports = Report::latest()->where('user_id', 'like', "$byUser")->paginate(40);
        } else {
            $reports = Report::latest()->paginate(40);
        }

        return view('reports', compact('users'))->with('reports', $reports);
    }

    public function show($id){
        return view('report', [
           'report' => Report::where('id', $id)->firstOrFail()
        ]);
    }

    public function create(){
        return view('create');
    }

    public function store(){
        $attributes = request()->validate([
            'grantN' => 'required',
            'contractSignData' => 'max:255',
            'grantLeder' => 'max:255',
            'orgName' => 'max:255',
            'coorgName1' => 'max:255',
            'coorgName2' => 'max:255',
            'fullbudget' => 'max:255',
            'leadbudget' => 'max:255',
            'cobudget1' => 'max:255',
            'cobudget2' => 'max:255',
            'currPeriod' => 'max:255',
            'income1' => 'max:255',
            'income2' => 'max:255',
            'income3' => 'max:255',
            'outcome1' => 'max:255',
            'outcome2' => 'max:255',
            'outcome3' => 'max:255',
            'jobChangeEflow' => 'max:255',
            'jobTerminationEflow' => 'max:255',
        ]);
        Report::create([
            'user_id' => auth()->id(),
            'grantN' => $attributes['grantN'],
            'contractSignData' => $attributes['contractSignData'],
            'grantLeder' => $attributes['grantLeder'],
            'orgName' => $attributes['orgName'],
            'coorgName1' => $attributes['coorgName1'],
            'coorgName2' => $attributes['coorgName2'],
            'fullbudget' => $attributes['fullbudget'],
            'leadbudget' => $attributes['leadbudget'],
            'cobudget1' => $attributes['cobudget1'],
            'cobudget2' => $attributes['cobudget2'],
            'currPeriod' => $attributes['currPeriod'],
            'income1' => $attributes['income1'],
            'income2' => $attributes['income2'],
            'income3' => $attributes['income3'],
            'outcome1' => $attributes['outcome1'],
            'outcome2' => $attributes['outcome2'],
            'outcome3' => $attributes['outcome3'],
            'jobChangeEflow' => $attributes['jobChangeEflow'],
            'jobTerminationEflow' => $attributes['jobTerminationEflow'],
        ]);

        return redirect('/');
    }

    public function edit($id){
        $report = Report::findOrFail($id);
        if ($report->user_id == auth()->user()->id)
            return view('edit', compact('report'));
        return redirect('/reports');
    }

    public function update($id){
        $attributes = request()->validate([
            'grantN' => 'required',
            'contractSignData' => 'max:255',
            'grantLeder' => 'max:255',
            'orgName' => 'max:255',
            'coorgName1' => 'max:255',
            'coorgName2' => 'max:255',
            'fullbudget' => 'max:255',
            'leadbudget' => 'max:255',
            'cobudget1' => 'max:255',
            'cobudget2' => 'max:255',
            'currPeriod' => 'max:255',
            'income1' => 'max:255',
            'income2' => 'max:255',
            'income3' => 'max:255',
            'outcome1' => 'max:255',
            'outcome2' => 'max:255',
            'outcome3' => 'max:255',
            'jobChangeEflow' => 'max:255',
            'jobTerminationEflow' => 'max:255',
            'Status' => 'max:255',
        ]);
        $report = Report::findOrFail($id);
        if ($report->user_id == auth()->user()->id)
            $report->update([
                'grantN' => $attributes['grantN'],
                'contractSignData' => $attributes['contractSignData'],
                'grantLeder' => $attributes['grantLeder'],
                'orgName' => $attributes['orgName'],
                'coorgName1' => $attributes['coorgName1'],
                'coorgName2' => $attributes['coorgName2'],
                'fullbudget' => $attributes['fullbudget'],
                'leadbudget' => $attributes['leadbudget'],
                'cobudget1' => $attributes['cobudget1'],
                'cobudget2' => $attributes['cobudget2'],
                'currPeriod' => $attributes['currPeriod'],
                'income1' => $attributes['income1'],
                'income2' => $attributes['income2'],
                'income3' => $attributes['income3'],
                'outcome1' => $attributes['outcome1'],
                'outcome2' => $attributes['outcome2'],
                'outcome3' => $attributes['outcome3'],
                'jobChangeEflow' => $attributes['jobChangeEflow'],
                'jobTerminationEflow' => $attributes['jobTerminationEflow'],
                'Status' => $attributes['Status']
            ]);

        return redirect('/');
    }

    public function destroy(){

    }
}
