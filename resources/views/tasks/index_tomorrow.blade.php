<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Tasks</h4>
                            <div class="box box-block " >
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-2">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Type of Task</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                
                                        @php
                                            \Log::info($records);
                                        @endphp
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