@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/gyartos') }}">Gyarto</a> :
@endsection
@section("contentheader_description", $gyarto->$view_col)
@section("section", "Gyartos")
@section("section_url", url(config('laraadmin.adminRoute') . '/gyartos'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Gyartos Edit : ".$gyarto->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($gyarto, ['route' => [config('laraadmin.adminRoute') . '.gyartos.update', $gyarto->id ], 'method'=>'PUT', 'id' => 'gyarto-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/gyartos') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#gyarto-edit-form").validate({
		
	});
});
</script>
@endpush
