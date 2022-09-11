@extends ('layouts.app') 
@section ('content')
<div class="container">
      <h1>New Task</h1>

    {{-- Form to cater for adding of users tasks --}}
  {!! Form::open(['action'=> 'TasksController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
  <div class="form-row">
        <div class="form-group col-md-6">
            {{Form::label('title','Task Title')}} 
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Task Title','required'])}}
        </div>  
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
        {{Form::label('description','Task Description')}} 
        {!! Form::textarea('description', '', ['class' => 'form-control', 'placeholder'=>'Task Description','required', 'rows' => 4, 'required' ]); !!}

    </div>  
</div>
<div class="form-row">
    <div class="form-group col-md-6" >
        {{ Form::select('task_nature', [
                    'repetitive' => 'Repetitive',
                    'non-repetitive' => 'Non-Repetitive',
                
                ], null, ['placeholder' => 'Select complexity of task',"id" => "task-complexity", 'class' => 'form-control']) }}
    </div>
</div>

<div class="form-row" id="task-type" style="display:none">
    <div class="form-group col-md-6">
        {{ Form::select('task_type', [
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'Monthly' => 'Monthly',
                
                ], null, ['placeholder' => 'Select a task type','id'=>'task_type', 'class' => 'form-control']) }}
    </div>
</div>

    <div class="form-row" id="weekly_checkbox" style="display: none">
        <div class="form-group col-md-12">
                <div class="row">
                            {!! Form::label('monday', 'Monday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Monday') !!}
                        &nbsp;&nbsp;
                            {!! Form::label('tuesday', 'Tuesday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Tuesday') !!}
                            &nbsp;&nbsp;
                            {!! Form::label('wednesday', 'Wednesday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Wednesday') !!}
                            &nbsp;&nbsp;
                            {!! Form::label('thursday', 'Thursday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Thursday') !!}
                            &nbsp;&nbsp;
                            {!! Form::label('friday', 'Friday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Friday') !!}
                            &nbsp;&nbsp;
                            {!! Form::label('saturday', 'Saturday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Saturday') !!}
                            &nbsp;&nbsp;
                            {!! Form::label('sunday', 'Sunday') !!}
                            {!! Form::checkbox('weekly_checkbox[]', 'Sunday') !!}
                            
                </div>

        </div>
    </div>

<div class="form-row" id="monthly_checkbox" style="display: none">

    <div class="row">
        {!! Form::label('single_day_month', 'Single Day each month') !!}
        {!! Form::radio('monthly_checkbox', 'Once every month') !!}
    &nbsp;&nbsp;
        {!! Form::label('single_day_each_month', 'Single Day of a month each year') !!}
        {!! Form::radio('monthly_checkbox', 'Once a month each year') !!}
        &nbsp;&nbsp;
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6"id="day-task" style="display:none">
        {{ Form::select('daily_month', [
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday'
                
                ], null, ['placeholder' => 'Select Day', 'class' => 'form-control']) }}
    </div>
</div>

<div class="col-md-4">
    <div class="form-group time" style="display: none">
          <div class="row">
                  <label>Select Time</label>
                  <input type="time" name="time" class="form-control"
                      id="time">
          </div>
      </div>
  </div>

<div class="col-md-2">
  <div class="form-group day_single_month"  style="display: none">
        <div class="row">
                <label>Select the day of the month</label>
                <select name='date_of_month' class="form-control" >
                    <option value='01'>01</option>
                    <option value='02'>02</option>
                    <option value='03'>03</option>
                    <option value='04'>04</option>
                    <option value='05'>05</option>
                    <option value='06'>06</option>
                    <option value='07'>07</option>
                    <option value='08'>08</option>
                    <option value='09'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                    <option value='13'>13</option>
                    <option value='14'>14</option>
                    <option value='15'>15</option>
                    <option value='16'>16</option>
                    <option value='17'>17</option>
                    <option value='18'>18</option>
                    <option value='19'>19</option>
                    <option value='20'>20</option>
                    <option value='21'>21</option>
                    <option value='22'>22</option>
                    <option value='23'>23</option>
                    <option value='24'>24</option>
                    <option value='25'>25</option>
                    <option value='26'>26</option>
                    <option value='27'>27</option>
                    <option value='28'>28</option>
                    <option value='29'>29</option>
                    <option value='30'>30</option>
                    <option value='31'>31</option>
                </select>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group month_year" style="display: none">
          <div class="row">
                  <label>Select Day/Month each year</label>
                  <input type="text" name="monthly_once_and_day" class="form-control"
                      id="monthly_once_and_day">
          </div>
      </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6"id="status" >
        {{ Form::select('status', [
                    'pending' => 'Pending',
                    'Completed' => 'Completed',
                
                ], null, ['placeholder' => 'Select Status', 'class' => 'form-control','required']) }}
    </div>
</div>

  {{Form::submit('Submit Task', ['class'=>'btn btn-primary'])}} {!! Form::close() !!}
  
</div>
@endsection
 
@section('javascript')
<script src="{{ asset('js/tasks.js') }}"></script>
@endsection

