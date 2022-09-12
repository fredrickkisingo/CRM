<a href="#" class="btn btn-primary btn-sm" data-target="#status_modal" data-toggle="modal"            
 onclick="selected_record('{{ json_encode($selected_record) }}')"
    >Change Status</a>
<div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="status_modal"  aria-hidden="true">
<div class="modal-dialog" role="document" id="status_modal">
    {!! Form::open(['url' => action('TasksController@postTaskStatus'), 'id' => 'status_modal', 'method' => 'put']) !!}
    
    <input type="hidden" id="record_id" name="record_id"value="">

    <div class="modal-content" id="status_modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                @lang("lang_v1.change_status")
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('status', __('lang_v1.status') .':*') !!}
                        {!! Form::select('status', ['pending'=>'Pending','completed'=>'Completed'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                @lang('lang_v1.update')
            </button>
             <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                @lang('lang_v1.close')
            </button>
        </div>
    </div><!-- /.modal-content -->
     {!! Form::close() !!}
</div><!-- /.modal-dialog -->
</div>

@section('javascript')
<script src="{{ asset('js/tasks.js') }}"></script>
@endsection