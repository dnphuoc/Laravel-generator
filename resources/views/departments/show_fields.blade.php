<!-- Id Field -->
<div class="form-group">
    {{ Form::label('id', 'Id:') }}
    <p>{{ $department->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {{ Form::label('name', 'Name:') }}
    <p>{{ $department->name }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {{ Form::label('phone', 'Phone:') }}
    <p>{{ $department->phone }}</p>
</div>

<!-- Manager Id Field -->
<div class="form-group">
    {{ Form::label('manager_id', 'Manager:') }}
    <p>{{ $department->manager->name }}</p>
</div>


