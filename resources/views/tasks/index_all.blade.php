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
                                                <th>Occurence</th>
                                            </tr>
                                        </thead>
                                
                                        @foreach($records as $record)
                                        <tr>
                                        <td>{{$record->title}}</td>
                                        <td>{{$record->description}}</td>
                                        <td>{{$record->status}}</td>
                                        <td>{{$record->type_of_task}}</td>
                                        <td><a href="#" class="btn btn-primary btn-sm" data-target="#status_modal" data-toggle="modal">Change Status</a></td>
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

    <div class="modal-dialog" role="document" id="status_modal">
        {!! Form::open(['url' => action('TaskController@postTaskStatus', $project_task->id), 'id' => 'status_modal', 'method' => 'put']) !!}
        <div class="modal-content" id="status_modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    @lang("lang.change_status")
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('status', __('lang.status') .':*') !!}
                            {!! Form::select('status', ['pending'=>'Pending','completed'=>'Completed'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    @lang('lang.update')
                </button>
                 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    @lang('lang.close')
                </button>
            </div>
        </div><!-- /.modal-content -->
         {!! Form::close() !!}
    </div><!-- /.modal-dialog -->