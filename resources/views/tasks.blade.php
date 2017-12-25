@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @lang('messages.new_task')
                </div>
                <div class="panel-body">
                    @include('common.errors')
                    {{ Form::open(['url' => '/tasks', 'method' => 'POST']) }}
                        {{ Form::label('tasks', trans('messages.task')) }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                        {{ Form::submit(trans('messages.add_task'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @lang('messages.current_tasks')
                </div>
                <div class="panel-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>@lang('messages.task')</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($tasks))
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>
                                            {{ Form::open(['url' => '/tasks/'.$task->id, 'method' => 'DELETE'] ) }}
                                                {{ Form::button('<i  class="glyphicon glyphicon-trash"></i>'.trans('messages.delete_btn'), ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
