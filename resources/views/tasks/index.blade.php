@extends ('layouts.app') 
@section ('content')


<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('task_filter',  'Task Filters' . ':') !!}

        {!! Form::select('task_filter', ['today'=>'Today','tomorrow'=>'Tomorrow','next_week'=>'Next Week','next'=>'Next'], null, ['class' => 'form-control select2','id'=>'task_filter','style' => 'width:100%', 'placeholder' => 'All' ]); !!}
    </div>
</div>


<div class="container-fluid" id="new_table">
</div>
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
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                
                                        @foreach($records as $record)
                                        <tr>
                                        <td>{{$record->title}}</td>
                                        <td>{{$record->description}}</td>
                                        <td>{{$record->status}}</td>
                                        <td>{{$record->type_of_task}}</td>
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
    
@endsection
@section('javascript')
<script src="{{ asset('js/tasks.js') }}"></script>
@endsection