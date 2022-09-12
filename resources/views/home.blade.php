@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" style="align-content: center">
                   
                    @if(count($records)>0)
                    <div class="container-fluid" id="old_table">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">User Tasks</h4>
                                            <div class="box box-block " >
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover table-2" id="user_tasks">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Description</th>
                                                                <th>Status</th>
                                                                <th>Type of Task</th>
                                                                <th>Time</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                
                                                        @foreach($records as $record)
                                                        <tr>
                                                        <td>{{$record->title}}</td>
                                                        <td>{{$record->description}}</td>
                                                        <td>{{$record->status}}</td>
                                                        <td>{{$record->type_of_task}}</td>
                                                        {{-- <td>{{$record->time}}</td> --}}
                                                        <td> @include('tasks.status',['selected_record' => $record])</td>
                                                        </tr>
                                                       
                                                        @endforeach
                
                                                    <tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{ __('You can view your tasks by clicking the button below!') }}
                        <br>
                    <a class="btn btn-primary"
                        href="/tasks"
                        role="button">
                        View More Tasks
                    </a>

                    @else
                    
                    {{ __('You can create your tasks by clicking the button below!') }}
                        <br>
                    <a class="btn btn-primary"
                    href="/tasks/create"
                    role="button">
                    Create
                </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

