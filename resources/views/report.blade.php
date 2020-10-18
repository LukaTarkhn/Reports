@extends('layouts.app')

@section ('content')
    <h1>{{ $report->body }}</h1>
    @can ('edit-report', $report)
        <a href="/reports/{{ $report->id }}/edit">Edit</a>
    @endcan
@endsection

