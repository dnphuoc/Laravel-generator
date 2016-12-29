<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Search</h3>
    </div>
    <div class="box-body">
        {{ Form::open(['route' => 'employees.index', 'method' => 'GET', 'class' => 'form-inline']) }}
            <div class="form-group">
                {{ Form::label('name', 'Name:', ['class' => 'sr-only']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('department_id', 'Department:', ['class' => 'sr-only']) }}
                {{ Form::select('department_id', $department, null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
                <button class="btn btn-default btn-clear" id="clear-search" type="button">Clear</button>
            </div>
        {{ Form::close() }}
    </div>
</div>