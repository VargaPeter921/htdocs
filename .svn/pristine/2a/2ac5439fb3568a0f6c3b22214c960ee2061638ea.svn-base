@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/termeks') }}">Termek</a> :
@endsection
@section("contentheader_description", $termek->$view_col)
@section("section", "Termeks")
@section("section_url", url(config('laraadmin.adminRoute') . '/termeks'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Termeks Edit : ".$termek->$view_col)

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
				{!! Form::model($termek, ['route' => [config('laraadmin.adminRoute') . '.termeks.update', $termek->id ], 'method'=>'PUT', 'id' => 'termek-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'cikkid')
					@la_input($module, 'cikkszam')
					@la_input($module, 'cikkszam2')
					@la_input($module, 'cikknev')
					@la_input($module, 'mennyiseg')
					@la_input($module, 'kshszam')
					@la_input($module, 'gyarto')
					@la_input($module, 'cikkcsoportkod')
					@la_input($module, 'cikkcsoportnev')
					@la_input($module, 'tipus')
					@la_input($module, 'beszerzesiallapot')
					@la_input($module, 'webigendatum')
					@la_input($module, 'webmegjel')
					@la_input($module, 'leiras')
					@la_input($module, 'tomeg')
					@la_input($module, 'gartipusid')
					@la_input($module, 'garido')
					@la_input($module, 'garidotipus')
					@la_input($module, 'garhely')
					@la_input($module, 'meret')
					@la_input($module, 'garhelytipus')
					@la_input($module, 'arlistapoz')
					@la_input($module, 'megj')
					@la_input($module, 'cikkfajta')
					@la_input($module, 'gycikkszam')
					@la_input($module, 'focsoportkod')
					@la_input($module, 'focsoportnev')
					@la_input($module, 'cikkjellnev')
					@la_input($module, 'ertmenny')
					@la_input($module, 'szigoru_szamadasu')
					@la_input($module, 'stockvalue')
					@la_input($module, 'source')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/termeks') }}">Cancel</a></button>
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
	$("#termek-edit-form").validate({
		
	});
});
</script>
@endpush
