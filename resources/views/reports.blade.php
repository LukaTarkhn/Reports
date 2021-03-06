@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">მომხმარებელი: {{ Auth::user()->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div style="display: flex;flex-direction: column;align-items: center;">
                            <a style="width: 200px;margin-bottom: 10px" href="/" class="btn btn-primary">ჩემი რეპორტები</a>
                            <button style="width: 200px" type="button" class="btn btn-success" data-toggle="modal" data-target="#addReport">
                                რეპორტის დამატება
                            </button>
                        </div>

                        <form action="" method="GET" style="text-align: center; font-weight: 900; margin-top: 10px">
                            <label for="search" >გლობალური ძებნა | სულ ნაპოვნია - {{$reports->total()}}</label>
                            <input type="text" class="form-control"
                                   name="search"
                                   id="search"
                                   placeholder="ყველა ველში ძებნა (ჩაწერეთ ტექსტი და დააჭირეთ Enter-ს)"
                                   value="{{ request()->input('search') }}">
                        </form>
                        <div class="filter">
                            <div style="width: 50%; padding-right: 3px;">
                                <form action="" method="GET">
                                    <select class="form-control" id="reportStatus" name="reportStatus" onchange="this.form.submit()">
                                        <option value="">რეპორტის სტატუსისთ...</option>
                                        <option value="Current" @if (request()->input('reportStatus') == 'Current') selected @endif> მიმდინარე</option>
                                        <option value="Finished" @if (request()->input('reportStatus') == 'Finished') selected @endif> დასრულებული</option>
                                    </select>
                                </form>

                                <form action="" method="GET">
                                    <select class="form-control" id="organizationStatus" name="organizationStatus" onchange="this.form.submit()">
                                        <option value="">ორგანიზაციის სტატუსით...</option>
                                        <option value="Lead" @if (request()->input('organizationStatus') == 'Lead') selected @endif> წამყვანი</option>
                                        <option value="Participant" @if (request()->input('organizationStatus') == 'Participant') selected @endif>თანამონაწილე</option>
                                    </select>
                                </form>
                            </div>
                            <div style="width: 50%; padding-left: 3px;">
                                <form action="" method="GET">
                                    <select class="form-control" id="byPeriod" name="byPeriod" onchange="this.form.submit()">
                                        <option value="">მიმდინარე პერიოდით...</option>
                                        <option value="I" @if (request()->input('byPeriod') == 'I') selected @endif> I</option>
                                        <option value="II" @if (request()->input('byPeriod') == 'II') selected @endif>II</option>
                                        <option value="III" @if (request()->input('byPeriod') == 'III') selected @endif>III</option>
                                        <option value="IV" @if (request()->input('byPeriod') == 'IV') selected @endif> IV</option>
                                        <option value="V" @if (request()->input('byPeriod') == 'V') selected @endif> V</option>
                                        <option value="VI" @if (request()->input('byPeriod') == 'VI') selected @endif> VI</option>
                                        <option value="VII" @if (request()->input('byPeriod') == 'VII') selected @endif> VII</option>
                                        <option value="VIII" @if (request()->input('byPeriod') == 'VIII') selected @endif> VIII</option>
                                        <option value="IX" @if (request()->input('byPeriod') == 'IX') selected @endif> IX</option>
                                        <option value="X" @if (request()->input('byPeriod') == 'X') selected @endif> X</option>
                                        <option value="XI" @if (request()->input('byPeriod') == 'XI') selected @endif> XI</option>
                                        <option value="XII" @if (request()->input('byPeriod') == 'XII') selected @endif> XII</option>
                                    </select>
                                </form>

                                <form action="" method="GET">
                                    <select class="form-control" id="byUser" name="byUser" onchange="this.form.submit()">
                                        <option value="">ავტორის მიხედვით...</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @if (request()->input('byUser') == $user->id ) selected @endif> {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin: 20px;">
        <div class="vertical-scrolled-table" style="overflow-x: scroll;">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Control</th>
                    <th scope="col">საგრანტო ხელშეკრულების ნომერი</th>
                    <th scope="col">საგრანტო ხელშეკრულების გაფორმების თარიღი</th>
                    <th scope="col">პროექტის ხელმძღვანელი (სახელი/გვარი)</th>
                    <th scope="col">წამყვანი ორგანიზაციის დასახელება</th>
                    <th scope="col">თანამონაწილე ორგანიზაცია 1 -ის დასახელება</th>
                    <th scope="col">თანამონაწილე ორგანიზაცია 2 -ის დასახელება</th>
                    <th scope="col">პროექტის მთლიანი ბიუჯეტი (ფონდიდან მოთხოვნილი)</th>
                    <th scope="col">წამყვანი ორგანიზაციის ბიუჯეტი (ფონდიდან მოთხოვნილი)</th>
                    <th scope="col">თანამონაწილე ორგანიზაცია 1-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</th>
                    <th scope="col">თანამონაწილე ორგანიზაცია 2-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</th>
                    <th scope="col">მიმდინარე პერიოდი</th>
                    <th scope="col"><span style="color: #2fa360">(შემოსული)</span> ანგარიშის (Eflow-ს ნომერი)</th>
                    <th scope="col"><span style="color: #2fa360">(შემოსული)</span> ცვლილების კორესპოდენცია (Eflow-ს ნომერი)</th>
                    <th scope="col"><span style="color: #2fa360">(შემოსული)</span> ხარვეზის გამოსწორების ვადის მოთხოვნა (Eflow-ს ნომერი)</th>
                    <th scope="col"><span style="color: #ffa949">(გასული)</span> წერილი ანგარიშის ხარვეზთან დაკავშირებით (Eflow-ს ნომერი)</th>
                    <th scope="col"><span style="color: #ffa949">(გასული)</span> წერილი ცვლილების კორესპოდენციასთან დაკავშირებით (Eflow-ს ნომერი)</th>
                    <th scope="col"><span style="color: #ffa949">(გასული)</span> ხარვეზის ვადაზე პასუხი (Eflow-ს ნომერი)</th>
                    <th scope="col">სამსახურებრივი ბარათი ცვლილებასთან და პროექტის შეწყვეტასთან დაკავშირებით (Eflow-ს ნომერი) </th>
                    <th scope="col">ბრძანება პროექტის შეწყვეტის თაობაზე</th>
                    <th scope="col">სტატუსი <span style="color: #ffa949">(მიმდინარე/</span><span style="color: #2fa360">დასრულებული)</span></th>
                    <th scope="col">ავტორი</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr @if ($report->Status == 'Finished') style="background: #44a2ff" @endif>
                        <td scope="row">
                            @if($report->user->id == Auth::user()->id )
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editReport{{ $report->id }}">
                                    <div style="width:20px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 383.947 383.947"><defs/><path d="M0 303.947v80h80l236.053-236.054-80-80zM377.707 56.053L327.893 6.24c-8.32-8.32-21.867-8.32-30.187 0l-39.04 39.04 80 80 39.04-39.04c8.321-8.32 8.321-21.867.001-30.187z"/></svg>
                                    </div>
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary" disabled data-toggle="modal">
                                    <div style="width:20px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 383.947 383.947"><defs/><path d="M0 303.947v80h80l236.053-236.054-80-80zM377.707 56.053L327.893 6.24c-8.32-8.32-21.867-8.32-30.187 0l-39.04 39.04 80 80 39.04-39.04c8.321-8.32 8.321-21.867.001-30.187z"/></svg>
                                    </div>
                                </button>
                            @endif

                        </td>
                        <td>{{$report->grantN}}</td>
                        <td>{{$report->contractSignData}}</td>
                        <td>{{$report->grantLeder}}</td>
                        <td>{{$report->orgName}}</td>
                        <td>{{$report->coorgName1}}</td>
                        <td>{{$report->coorgName2}}</td>
                        <td>{{$report->fullbudget}} @if($report->fullbudget)ლარი@endif</td>
                        <td>{{$report->leadbudget}} @if($report->leadbudget)ლარი@endif</td>
                        <td>{{$report->cobudget1}} @if($report->cobudget1)ლარი@endif</td>
                        <td>{{$report->cobudget2}} @if($report->cobudget2)ლარი@endif</td>
                        <td>{{$report->currPeriod}} @if($report->currPeriod)პერიოდი@endif</td>
                        <td>{{$report->income1}}</td>
                        <td>{{$report->income2}}</td>
                        <td>{{$report->income3}}</td>
                        <td>{{$report->outcome1}}</td>
                        <td>{{$report->outcome2}}</td>
                        <td>{{$report->outcome3}}</td>
                        <td>{{$report->jobChangeEflow}}</td>
                        <td>{{$report->jobTerminationEflow}}</td>
                        <td>@if($report->Status == 'Current')მიმდინარე @else დასრულებული @endif</td>
                        <td>{{$report->user->name}}</td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade bd-example-modal-lg" id="editReport{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="editReport{{ $report->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editReport{{ $report->id }}Label" style="font-weight: bold">რეპორტის რედაქტირება</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background: #e7ebeb">
                                    <form id="editForm{{ $report->id }}" method="POST" action="/reports/{{ $report->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="editform">
                                            <div style="width: 50%; margin-right: 25px; margin-left: 35px">
                                                <label for="Status">რეპორტის სტატუსი </label>   
                                                <select class="form-control" id="Status" name="Status">
                                                    <option value="Current" @if ($report->Status == 'Current') selected @endif> მიმდინარე</option>
                                                    <option value="Finished" @if ($report->Status == 'Finished') selected @endif> დასრულებული</option>
                                                </select>
                                                
                                                <label for="grantN">საგრანტო ხელშეკრულების ნომერი </label>
                                                <input type="text" class="form-control @error('grantN') is-invalid @enderror"
                                                    name="grantN"
                                                    id="grantN"
                                                    aria-describedby="grantNHelp"
                                                    value="{{ $report->grantN }}">
                                                @error('grantN')
                                                <div class="invalid-feedback">{{ $errors->first('grantN') }}</div>
                                                @enderror

                                                <label for="contractSignData">საგრანტო ხელშეკრულების გაფორმების თარიღი </label>
                                                <input type="text" class="addDate form-control @error('contractSignData') is-invalid @enderror"
                                                    name="contractSignData"
                                                    id="contractSignData"
                                                    value="{{ $report->contractSignData }}">
                                                @error('contractSignData')
                                                <div class="invalid-feedback">{{ $errors->first('contractSignData') }}</div>
                                                @enderror

                                                <label for="grantLeder">პროექტის ხელმძღვანელი (სახელი/გვარი) </label>
                                                <input type="text" class="form-control @error('grantLeder') is-invalid @enderror"
                                                    name="grantLeder" id="grantLeder"
                                                    value="{{ $report->grantLeder }}">
                                                @error('grantLeder')
                                                <div class="invalid-feedback">{{ $errors->first('grantLeder') }}</div>
                                                @enderror

                                                <label for="orgName">წამყვანი ორგანიზაციის დასახელება </label>
                                                <input type="text" class="form-control @error('orgName') is-invalid @enderror"
                                                    name="orgName" id="orgName"
                                                    value="{{ $report->orgName }}">
                                                @error('orgName')
                                                <div class="invalid-feedback">{{ $errors->first('orgName') }}</div>
                                                @enderror

                                                <label for="coorgName1">თანამონაწილე ორგანიზაცია 1 -ის დასახელება </label>
                                                <input type="text" class="form-control @error('coorgName1') is-invalid @enderror"
                                                    name="coorgName1" id="coorgName1"
                                                    value="{{ $report->coorgName1 }}">
                                                @error('coorgName1')
                                                <div class="invalid-feedback">{{ $errors->first('coorgName1') }}</div>
                                                @enderror

                                                <label for="coorgName2">თანამონაწილე ორგანიზაცია 2 -ის დასახელება </label>
                                                <input type="text" class="form-control @error('coorgName2') is-invalid @enderror"
                                                    name="coorgName2" id="coorgName2"
                                                    value="{{ $report->coorgName2 }}">
                                                @error('coorgName2')
                                                <div class="invalid-feedback">{{ $errors->first('coorgName2') }}</div>
                                                @enderror

                                                <label for="fullbudget">პროექტის მთლიანი ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                                                <input type="number" class="form-control @error('fullbudget') is-invalid @enderror"
                                                    name="fullbudget" id="fullbudget"
                                                    value="{{ $report->fullbudget }}">
                                                @error('fullbudget')
                                                <div class="invalid-feedback">{{ $errors->first('fullbudget') }}</div>
                                                @enderror

                                                <label for="leadbudget">წამყვანი ორგანიზაციის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                                                <input type="number" class="form-control @error('leadbudget') is-invalid @enderror"
                                                    name="leadbudget" id="leadbudget"
                                                    value="{{ $report->leadbudget }}">
                                                @error('leadbudget')
                                                <div class="invalid-feedback">{{ $errors->first('leadbudget') }}</div>
                                                @enderror

                                                <label for="cobudget1">თანამონაწილე ორგანიზაცია 1-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                                                <input type="number" class="form-control @error('cobudget1') is-invalid @enderror"
                                                    name="cobudget1" id="cobudget1"
                                                    value="{{ $report->cobudget1 }}">
                                                @error('cobudget1')
                                                <div class="invalid-feedback">{{ $errors->first('cobudget1') }}</div>
                                                @enderror

                                                <label for="cobudget2">თანამონაწილე ორგანიზაცია 2-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                                                <input type="number" class="form-control @error('cobudget2') is-invalid @enderror"
                                                    name="cobudget2" id="cobudget2"
                                                    value="{{ $report->cobudget2 }}">
                                                @error('cobudget2')
                                                <div class="invalid-feedback">{{ $errors->first('cobudget2') }}</div>
                                                @enderror
                                            </div>
                                            <div style="width: 50%">
                                                <label for="currPeriod">მიმდინარე პერიოდი </label>
                                                <select class="form-control" id="currPeriod" name="currPeriod">
                                                    <option value="I" @if ($report->currPeriod == 'I') selected @endif> I</option>
                                                    <option value="II" @if ($report->currPeriod == 'II') selected @endif>II</option>
                                                    <option value="III" @if ($report->currPeriod == 'III') selected @endif>III</option>
                                                    <option value="IV" @if ($report->currPeriod == 'IV') selected @endif> IV</option>
                                                    <option value="V" @if ($report->currPeriod == 'V') selected @endif> V</option>
                                                    <option value="VI" @if ($report->currPeriod == 'VI') selected @endif> VI</option>
                                                    <option value="VII" @if ($report->currPeriod == 'VII') selected @endif> VII</option>
                                                    <option value="VIII" @if ($report->currPeriod == 'VIII') selected @endif> VIII</option>
                                                    <option value="IX" @if ($report->currPeriod == 'IX') selected @endif> IX</option>
                                                    <option value="X" @if ($report->currPeriod == 'X') selected @endif> X</option>
                                                    <option value="XI" @if ($report->currPeriod == 'XI') selected @endif> XI</option>
                                                    <option value="XII" @if ($report->currPeriod == 'XII') selected @endif> XII</option>
                                                </select>

                                                <label for="income1"><span style="color: #2fa360">(შემოსული)</span> ანგარიშის (Eflow-ს ნომერი) </label>
                                                <input type="text" class="form-control @error('income1') is-invalid @enderror"
                                                    name="income1" id="income1"
                                                    value="{{ $report->income1 }}">
                                                @error('income1')
                                                <div class="invalid-feedback">{{ $errors->first('income1') }}</div>
                                                @enderror

                                                <label for="income2"><span style="color: #2fa360">(შემოსული)</span> ცვლილების კორესპოდენცია (Eflow-ს ნომერი) </label>
                                                <input type="text" class="form-control @error('income2') is-invalid @enderror"
                                                    name="income2" id="income2"
                                                    value="{{ $report->income2 }}">
                                                @error('income2')
                                                <div class="invalid-feedback">{{ $errors->first('income2') }}</div>
                                                @enderror

                                                <label for="income3"><span style="color: #2fa360">(შემოსული)</span> ხარვეზის გამოსწორების ვადის მოთხოვნა (Eflow-ს ნომერი)  </label>
                                                <input type="text" class="form-control @error('income3') is-invalid @enderror"
                                                    name="income3" id="income3"
                                                    value="{{ $report->income3 }}">
                                                @error('income3')
                                                <div class="invalid-feedback">{{ $errors->first('income3') }}</div>
                                                @enderror

                                                <label for="outcome1"><span style="color: #ffa949">(გასული)</span> წერილი ანგარიშის ხარვეზთან დაკავშირებით (Eflow-ს ნომერი) </label>
                                                <input type="text" class="form-control @error('outcome1') is-invalid @enderror"
                                                    name="outcome1" id="outcome1"
                                                    value="{{ $report->outcome1 }}">
                                                @error('outcome1')
                                                <div class="invalid-feedback">{{ $errors->first('outcome1') }}</div>
                                                @enderror

                                                <label for="outcome2"><span style="color: #ffa949">(გასული)</span> წერილი ცვლილების კორესპოდენციასთან დაკავშირებით (Eflow-ს ნომერი) </label>
                                                <input type="text" class="form-control @error('outcome2') is-invalid @enderror"
                                                    name="outcome2" id="outcome2"
                                                    value="{{ $report->outcome2 }}">
                                                @error('outcome2')
                                                <div class="invalid-feedback">{{ $errors->first('outcome2') }}</div>
                                                @enderror

                                                <label for="outcome3"><span style="color: #ffa949">(გასული)</span> ხარვეზის ვადაზე პასუხი (Eflow-ს ნომერი)  </label>
                                                <input type="text" class="form-control @error('outcome3') is-invalid @enderror"
                                                    name="outcome3" id="outcome3"
                                                    value="{{ $report->outcome3 }}">
                                                @error('outcome3')
                                                <div class="invalid-feedback">{{ $errors->first('outcome3') }}</div>
                                                @enderror

                                                <label for="jobChangeEflow">სამსახურებრივი ბარათი ცვლილებასთან და პროექტის შეწყვეტასთან დაკავშირებით (Eflow-ს ნომერი) </label>
                                                <input type="text" class="form-control @error('jobChangeEflow') is-invalid @enderror"
                                                    name="jobChangeEflow" id="jobChangeEflow"
                                                    aria-describedby="jobChangeEflowHelp"
                                                    value="{{ $report->jobChangeEflow }}">
                                                @error('jobChangeEflow')
                                                <div class="invalid-feedback">{{ $errors->first('jobChangeEflow') }}</div>
                                                @enderror

                                                <label for="jobTerminationEflow">ბრძანება პროექტის შეწყვეტის თაობაზე </label>
                                                <input type="text" class="form-control @error('jobTerminationEflow') is-invalid @enderror"
                                                    name="jobTerminationEflow" id="jobTerminationEflow"
                                                    value="{{ $report->jobTerminationEflow }}">
                                                @error('jobTerminationEflow')
                                                <div class="invalid-feedback">{{ $errors->first('jobTerminationEflow') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
                                    <button type="submit" class="btn btn-primary" form="editForm{{ $report->id }}">რედაქტირება</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {!! $reports->appends(Request::all())->links() !!}
            <p style="position: absolute;right: 50px; color: #0044cc">{{$reports->count()}}/{{$reports->total()}}</p>
        </div>
    </div>

    <!--Add Modal -->
    <div class="modal fade bd-example-modal-lg" id="addReport" tabindex="-1" role="dialog" aria-labelledby="addReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportLabel" style="font-weight: bold">რეპორტის დამატება</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: #e7ebeb">
                    <form id="addform" method="POST" action="/reports" >
                        @csrf
                        <div style="width: 50%; margin-right: 25px; margin-left: 35px">
                            <label for="grantN">საგრანტო ხელშეკრულების ნომერი </label>
                            <input type="text" class="form-control @error('grantN') is-invalid @enderror"
                                   name="grantN"
                                   id="grantN"
                                   aria-describedby="grantNHelp"
                                   value="{{ old('grantN') }}">
                            @error('grantN')
                            <div class="invalid-feedback">{{ $errors->first('grantN') }}</div>
                            @enderror

                            <label for="contractSignData">საგრანტო ხელშეკრულების გაფორმების თარიღი </label>
                            <input type="text" class="addDate form-control @error('contractSignData') is-invalid @enderror"
                                   name="contractSignData"
                                   id="contractSignData"
                                   value="{{ old('contractSignData') }}">
                            @error('contractSignData')
                            <div class="invalid-feedback">{{ $errors->first('contractSignData') }}</div>
                            @enderror

                            <label for="grantLeder">პროექტის ხელმძღვანელი (სახელი/გვარი) </label>
                            <input type="text" class="form-control @error('grantLeder') is-invalid @enderror"
                                   name="grantLeder" id="grantLeder"
                                   value="{{ old('grantLeder') }}">
                            @error('grantLeder')
                            <div class="invalid-feedback">{{ $errors->first('grantLeder') }}</div>
                            @enderror

                            <label for="orgName">წამყვანი ორგანიზაციის დასახელება </label>
                            <input type="text" class="form-control @error('orgName') is-invalid @enderror"
                                   name="orgName" id="orgName"
                                   value="{{ old('orgName') }}">
                            @error('orgName')
                            <div class="invalid-feedback">{{ $errors->first('orgName') }}</div>
                            @enderror

                            <label for="coorgName1">თანამონაწილე ორგანიზაცია 1 -ის დასახელება </label>
                            <input type="text" class="form-control @error('coorgName1') is-invalid @enderror"
                                   name="coorgName1" id="coorgName1"
                                   value="{{ old('coorgName1') }}">
                            @error('coorgName1')
                            <div class="invalid-feedback">{{ $errors->first('coorgName1') }}</div>
                            @enderror

                            <label for="coorgName2">თანამონაწილე ორგანიზაცია 2 -ის დასახელება </label>
                            <input type="text" class="form-control @error('coorgName2') is-invalid @enderror"
                                   name="coorgName2" id="coorgName2"
                                   value="{{ old('coorgName2') }}">
                            @error('coorgName2')
                            <div class="invalid-feedback">{{ $errors->first('coorgName2') }}</div>
                            @enderror

                            <label for="fullbudget">პროექტის მთლიანი ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                            <input type="number" class="form-control @error('fullbudget') is-invalid @enderror"
                                   name="fullbudget" id="fullbudget"
                                   value="{{ old('fullbudget') }}">
                            @error('fullbudget')
                            <div class="invalid-feedback">{{ $errors->first('fullbudget') }}</div>
                            @enderror

                            <label for="leadbudget">წამყვანი ორგანიზაციის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                            <input type="number" class="form-control @error('leadbudget') is-invalid @enderror"
                                   name="leadbudget" id="leadbudget"
                                   value="{{ old('leadbudget') }}">
                            @error('leadbudget')
                            <div class="invalid-feedback">{{ $errors->first('leadbudget') }}</div>
                            @enderror

                            <label for="cobudget1">თანამონაწილე ორგანიზაცია 1-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                            <input type="number" class="form-control @error('cobudget1') is-invalid @enderror"
                                   name="cobudget1" id="cobudget1"
                                   value="{{ old('cobudget1') }}">
                            @error('cobudget1')
                            <div class="invalid-feedback">{{ $errors->first('cobudget1') }}</div>
                            @enderror

                            <label for="cobudget2">თანამონაწილე ორგანიზაცია 2-ის ბიუჯეტი (ფონდიდან მოთხოვნილი)</label>
                            <input type="number" class="form-control @error('cobudget2') is-invalid @enderror"
                                   name="cobudget2" id="cobudget2"
                                   value="{{ old('cobudget2') }}">
                            @error('cobudget2')
                            <div class="invalid-feedback">{{ $errors->first('cobudget2') }}</div>
                            @enderror
                        </div>

                        <div style="width: 50%">
                            <label for="currPeriod">მიმდინარე პერიოდი </label>
                            <select class="form-control" id="currPeriod" name="currPeriod">
                                <option value="I" @if (old('currPeriod') == 'I') selected @endif> I</option>
                                <option value="II" @if (old('currPeriod') == 'II') selected @endif>II</option>
                                <option value="III" @if (old('currPeriod') == 'III') selected @endif>III</option>
                                <option value="IV" @if (old('currPeriod') == 'IV') selected @endif> IV</option>
                                <option value="V" @if (old('currPeriod') == 'V') selected @endif> V</option>
                                <option value="VI" @if (old('currPeriod') == 'VI') selected @endif> VI</option>
                                <option value="VII" @if (old('currPeriod') == 'VII') selected @endif> VII</option>
                                <option value="VIII" @if (old('currPeriod') == 'VIII') selected @endif> VIII</option>
                                <option value="IX" @if (old('currPeriod') == 'IX') selected @endif> IX</option>
                                <option value="X" @if (old('currPeriod') == 'X') selected @endif> X</option>
                                <option value="XI" @if (old('currPeriod') == 'XI') selected @endif> XI</option>
                                <option value="XII" @if (old('currPeriod') == 'XII') selected @endif> XII</option>
                            </select>

                            <label for="income1"><span style="color: #2fa360">(შემოსული)</span> ანგარიშის (Eflow-ს ნომერი) </label>
                            <input type="text" class="form-control @error('income1') is-invalid @enderror"
                                   name="income1" id="income1"
                                   value="{{ old('income1') }}">
                            @error('income1')
                            <div class="invalid-feedback">{{ $errors->first('income1') }}</div>
                            @enderror

                            <label for="income2"><span style="color: #2fa360">(შემოსული)</span> ცვლილების კორესპოდენცია (Eflow-ს ნომერი) </label>
                            <input type="text" class="form-control @error('income2') is-invalid @enderror"
                                   name="income2" id="income2"
                                   value="{{ old('income2') }}">
                            @error('income2')
                            <div class="invalid-feedback">{{ $errors->first('income2') }}</div>
                            @enderror

                            <label for="income3"><span style="color: #2fa360">(შემოსული)</span> ხარვეზის გამოსწორების ვადის მოთხოვნა (Eflow-ს ნომერი)  </label>
                            <input type="text" class="form-control @error('income3') is-invalid @enderror"
                                   name="income3" id="income3"
                                   value="{{ old('income3') }}">
                            @error('income3')
                            <div class="invalid-feedback">{{ $errors->first('income3') }}</div>
                            @enderror

                            <label for="outcome1"><span style="color: #ffa949">(გასული)</span> წერილი ანგარიშის ხარვეზთან დაკავშირებით (Eflow-ს ნომერი) </label>
                            <input type="text" class="form-control @error('outcome1') is-invalid @enderror"
                                   name="outcome1" id="outcome1"
                                   value="{{ old('outcome1') }}">
                            @error('outcome1')
                            <div class="invalid-feedback">{{ $errors->first('outcome1') }}</div>
                            @enderror

                            <label for="outcome2"><span style="color: #ffa949">(გასული)</span> წერილი ცვლილების კორესპოდენციასთან დაკავშირებით (Eflow-ს ნომერი) </label>
                            <input type="text" class="form-control @error('outcome2') is-invalid @enderror"
                                   name="outcome2" id="outcome2"
                                   value="{{ old('outcome2') }}">
                            @error('outcome2')
                            <div class="invalid-feedback">{{ $errors->first('outcome2') }}</div>
                            @enderror

                            <label for="outcome3"><span style="color: #ffa949">(გასული)</span> ხარვეზის ვადაზე პასუხი (Eflow-ს ნომერი)  </label>
                            <input type="text" class="form-control @error('outcome3') is-invalid @enderror"
                                   name="outcome3" id="outcome3"
                                   value="{{ old('outcome3') }}">
                            @error('outcome3')
                            <div class="invalid-feedback">{{ $errors->first('outcome3') }}</div>
                            @enderror

                            <label for="jobChangeEflow">სამსახურებრივი ბარათი ცვლილებასთან და პროექტის შეწყვეტასთან დაკავშირებით (Eflow-ს ნომერი) </label>
                            <input type="text" class="form-control @error('jobChangeEflow') is-invalid @enderror"
                                   name="jobChangeEflow" id="jobChangeEflow"
                                   aria-describedby="jobChangeEflowHelp"
                                   value="{{ old('jobChangeEflow') }}">
                            @error('jobChangeEflow')
                            <div class="invalid-feedback">{{ $errors->first('jobChangeEflow') }}</div>
                            @enderror

                            <label for="jobTerminationEflow">ბრძანება პროექტის შეწყვეტის თაობაზე </label>
                            <input type="text" class="form-control @error('jobTerminationEflow') is-invalid @enderror"
                                   name="jobTerminationEflow" id="jobTerminationEflow"
                                   value="{{ old('jobTerminationEflow') }}">
                            @error('jobTerminationEflow')
                            <div class="invalid-feedback">{{ $errors->first('jobTerminationEflow') }}</div>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
                    <button type="submit" class="btn btn-success" form="addform">დამატება</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.addDate').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('.editDate').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.byDate').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection

