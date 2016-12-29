<table class="table table-responsive" id="departments-table">
    <thead>
        <th>Name</th>
        <th>Phone</th>
        <th>Manager</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($departments as $department)
        <tr>
            <td>{{ $department->name }}</td>
            <td>{{ $department->phone }}</td>
            <td>{{ $department->manager->name }}</td>
            <td>
            @if (!Auth::guest())
                {{ Form::open(['route' => ['departments.destroy', $department->id], 'method' => 'delete']) }}
            @endif
                <div class='btn-group'>
                    <a href="{{ route('departments.show', [$department->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            @if (!Auth::guest())
                    <a href="{{ route('departments.edit', [$department->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) }}
            {{ Form::close() }}
            @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>