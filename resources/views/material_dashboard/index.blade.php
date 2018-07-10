@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
	    <div class="card-header bg-success">
	    	<h1 style="text-align:center;font-weight: bold;">CURRENT MATERIAL STOCKS</h1>
		</div>

	    <div class="card-body">
	    	<table id="table_id" class="table">
			    <thead>
			      <tr>
			      	<th><center>Material Code</center></th>
			       	<th><center>Material</center></th>
			        <th><center>Reorder Point</center></th>
			        <th><center>Quantity</center></th>
			        <th><center>Physical Inventory</center></th>
			      </tr>
			    </thead>
			    	<tbody>
			    		@foreach($materials as $material)
					    	<tr>
					    		<td><center>{{$material->code}}</center></td>
					    		<td><a href="/material_inventory/{{ $material->id}}">{{$material->name}}</a></td>
					    		<td><center>{{$material->reorder_point}}</center></td>
					    		<td bgcolor="{{$material->total_stocks <= 0 ? '#E94858' : 'white' }}"><center>{{$material->total_stocks}}</center></td>
					    		<td><center> <a href = "/physical_material/{{$material->id}}">Phy. Inv.</a></center></td>
					    	</tr>
			    		@endforeach
			    	</tbody>
  			</table>
	    </div>
	</div>
</div>

@endsection

@section('scripts')

	$(document).ready( function () {
    	$('#table_id').DataTable();
	} );

@endsection