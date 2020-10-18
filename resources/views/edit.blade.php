@extends('layouts.app')

@section ('content')
    <h2>Update report</h2>

    <form method="POST" action="/reports/{{ $report->id }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="slug">slug</label>
            <input type="text" class="form-control" name="slug" id="slug" aria-describedby="slugHelp" placeholder="Enter slug" value="{{ $report->slug }}">
            <small id="slugHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <input type="text" class="form-control" name="body" id="body" aria-describedby="bodyHelp" placeholder="Enter body" value="{{ $report->body }}">
            <small id="bodyHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

