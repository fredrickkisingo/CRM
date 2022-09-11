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
                   
                    {{ __('You can view your tasks by clicking the button below!') }}
                        <br>
                    <a class="btn btn-primary"
                        href="/tasks"
                        role="button">
                        View Tasks
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
