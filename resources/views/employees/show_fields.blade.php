<!-- Photo Field -->
<div class="form-group">
    {{ Form::label('photo', 'Photo:') }}
    <p><img src='{{ asset('images/employees/'.$employee->photo) }}' width="250" height="250"></p>

</div>

<!-- Id Field -->
<div class="form-group">
    {{ Form::label('id', 'Id:') }}
    <p>{{ $employee->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {{ Form::label('name', 'Name:') }}
    <p>{{ $employee->name }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {{ Form::label('department_id', 'Department:') }}
    <p>{{ $employee->department->name }}</p>
</div>

<!-- Job Title Field -->
<div class="form-group">
    {{ Form::label('job_title', 'Job Title:') }}
    <p>{{ $employee->job_title }}</p>
</div>

<!-- Cellphone Field -->
<div class="form-group">
    {{ Form::label('cellphone', 'Cellphone:') }}
    <p>{{ $employee->cellphone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {{ Form::label('email', 'Email:') }}
    <p>{{ $employee->email }}</p>
</div>



