@extends("la.layouts.app")

@section("contentheader_title", "Termeks")
@section("contentheader_description", "Termeks listing")
@section("section", "Termeks")
@section("sub_section", "Listing")
@section("htmlheader_title", "Termeks Listing")

@section("headerElems")
@la_access("Termeks", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Termek</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Termeks", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Termek</h4>
			</div>
			{!! Form::open(['action' => 'LA\TermeksController@store', 'id' => 'termek-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/termek_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#termek-add-form").validate({
		
	});
});
</script>
@endpush
