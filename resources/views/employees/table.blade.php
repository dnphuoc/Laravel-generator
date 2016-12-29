<table class="table table-responsive" id="employees-table">
    <thead>
        <th>Name</th>
        <th>Department</th>
        <th>Job Title</th>
        <th>Email</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->department_id ? $employee->department->name : '' }}</td>
            <td>{{ $employee->job_title }}</td>
            <td>{{ $employee->email }}</td>
            <td>
            @if (!Auth::guest())
                {{ Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) }}
            @endif
                <div class='btn-group'>
                    <a href="{{ route('employees.show', [$employee->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
             @if (!Auth::guest())
                    <a href="{{ route('employees.edit', [$employee->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) }}
            {{ Form::close() }}
            @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>