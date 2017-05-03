@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/megrendeles') }}">Megrendele</a> :
@endsection
@section("contentheader_description", $megrendele->$view_col)
@section("section", "Megrendeles")
@section("section_url", url(config('laraadmin.adminRoute') . '/megrendeles'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Megrendeles Edit : ".$megrendele->$view_col)

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
				{!! Form::model($megrendele, ['route' => [config('laraadmin.adminRoute') . '.megrendeles.update', $megrendele->id ], 'method'=>'PUT', 'id' => 'megrendele-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'ido')
					@la_input($module, 'tejlesites')
					@la_input($module, 'rendelesID')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/megrendeles') }}">Cancel</a></button>
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
	$("#megrendele-edit-form").validate({
		
	});
});
</script>
@endpush
