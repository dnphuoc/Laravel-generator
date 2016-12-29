@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('.btn-clear').on('click', function() {
            $(this).closest('form').find('input[type="text"]').val('');
            $(this).closest('form').find('select').val(null);
        });
    });
</script>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Employees</h1>
        @if (!Auth::guest())
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('employees.create') !!}">Add New</a>
        </h1>
        @endif
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        
        @include('employees.search')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('employees.table')
            </div>
        </div>
    </div>
@endsection

