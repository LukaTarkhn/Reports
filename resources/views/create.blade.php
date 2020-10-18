@extends('layouts.app')

@section ('content')
    <h2>Add report</h2>

    <form id="addform" method="POST" action="/reports">
        @csrf

        <div class="form-group">
            <label for="grantN">grantN</label>
            <input type="text" class="form-control @error('grantN') is-invalid @enderror"
                   name="grantN"
                   id="grantN"
                   aria-describedby="grantNHelp"
                   placeholder="Enter grantN"
                   value="{{ old('grantN') }}">
            @error('grantN')
            <div class="invalid-feedback">{{ $errors->first('grantN') }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contractSignData">contractSignData</label>
            <input type="text" class="form-control @error('contractSignData') is-invalid @enderror"
                   name="contractSignData"
                   id="contractSignData"
                   aria-describedby="contractSignDataHelp"
                   placeholder="Enter contractSignData"
                   value="{{ old('contractSignData') }}">
            @error('contractSignData')
            <div class="invalid-feedback">{{ $errors->first('contractSignData') }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="grantLeder">grantLeder</label>
            <input type="text" class="form-control"
                   name="grantLeder" id="grantLeder"
                   aria-describedby="grantLederHelp"
                   placeholder="Enter grantLeder"
                   value="{{ old('grantLeder') }}">
            <small id="grantLederHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="orgName">orgName</label>
            <input type="text" class="form-control"
                   name="orgName" id="orgName"
                   aria-describedby="orgNameHelp"
                   placeholder="Enter orgName"
                   value="{{ old('orgName') }}">
            <small id="orgNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="orgStatus">orgStatus</label>
            <input type="text" class="form-control"
                   name="orgStatus" id="orgStatus"
                   aria-describedby="orgStatusHelp"
                   placeholder="Enter orgStatus"
                   value="{{ old('orgStatus') }}">
            <small id="orgStatusHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="budget">budget</label>
            <input type="text" class="form-control"
                   name="budget" id="budget"
                   aria-describedby="budgetHelp"
                   placeholder="Enter budget"
                   value="{{ old('budget') }}">
            <small id="budgetHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="currPeriod">currPeriod</label>
            <input type="text" class="form-control"
                   name="currPeriod" id="currPeriod"
                   aria-describedby="currPeriodHelp"
                   placeholder="Enter currPeriod"
                   value="{{ old('currPeriod') }}">
            <small id="currPeriodHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="income1">income1</label>
            <input type="text" class="form-control"
                   name="income1" id="income1"
                   aria-describedby="income1Help"
                   placeholder="Enter income1"
                   value="{{ old('income1') }}">
            <small id="income1Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="income2">income2</label>
            <input type="text" class="form-control"
                   name="income2" id="income2"
                   aria-describedby="income2Help"
                   placeholder="Enter income2"
                   value="{{ old('income2') }}">
            <small id="income2Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="income3">income3</label>
            <input type="text" class="form-control"
                   name="income3" id="income3"
                   aria-describedby="income3Help"
                   placeholder="Enter income3"
                   value="{{ old('income3') }}">
            <small id="income3Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="outcome1">outcome1</label>
            <input type="text" class="form-control"
                   name="outcome1" id="outcome1"
                   aria-describedby="outcome1Help"
                   placeholder="Enter outcome1"
                   value="{{ old('outcome1') }}">
            <small id="outcome1Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="outcome2">outcome2</label>
            <input type="text" class="form-control"
                   name="outcome2" id="outcome2"
                   aria-describedby="outcome2Help"
                   placeholder="Enter outcome2"
                   value="{{ old('outcome2') }}">
            <small id="outcome2Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="outcome3">outcome3</label>
            <input type="text" class="form-control"
                   name="outcome3" id="outcome3"
                   aria-describedby="outcome3Help"
                   placeholder="Enter outcome3"
                   value="{{ old('outcome3') }}">
            <small id="outcome3Help" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="jobChangeEflow">jobChangeEflow</label>
            <input type="text" class="form-control"
                   name="jobChangeEflow" id="jobChangeEflow"
                   aria-describedby="jobChangeEflowHelp"
                   placeholder="Enter jobChangeEflow"
                   value="{{ old('jobChangeEflow') }}">
            <small id="jobChangeEflowHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="jobChangeOrderNumber">jobChangeOrderNumber</label>
            <input type="text" class="form-control"
                   name="jobChangeOrderNumber" id="jobChangeOrderNumber"
                   aria-describedby="jobChangeOrderNumberHelp"
                   placeholder="Enter jobChangeOrderNumber"
                   value="{{ old('jobChangeOrderNumber') }}">
            <small id="jobChangeOrderNumberHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="jobTerminationEflow">jobTerminationEflow</label>
            <input type="text" class="form-control"
                   name="jobTerminationEflow" id="jobTerminationEflow"
                   aria-describedby="jobTerminationEflowHelp"
                   placeholder="Enter jobTerminationEflow"
                   value="{{ old('jobTerminationEflow') }}">
            <small id="jobTerminationEflowHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="jobTerminationOrderNumber">jobTerminationOrderNumber</label>
            <input type="text" class="form-control"
                   name="jobTerminationOrderNumber" id="jobTerminationOrderNumber"
                   aria-describedby="jobTerminationOrderNumberHelp"
                   placeholder="Enter jobTerminationOrderNumber"
                   value="{{ old('jobTerminationOrderNumber') }}">
            <small id="jobTerminationOrderNumberHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="Status">Status</label>
            <input type="text" class="form-control"
                   name="Status" id="Status"
                   aria-describedby="StatusHelp"
                   placeholder="Enter Status"
                   value="{{ old('Status') }}">
            <small id="StatusHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

