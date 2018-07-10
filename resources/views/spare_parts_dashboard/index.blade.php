@extends('main.app')

@section('content')

	<div class="container">
	  <div class="card">
	    <div class="card-header bg-success">

	    	<h1 style="text-align:center;font-weight: bold;">CURRENT SPARE PARTS STOCKS</h1>
		</div>

	    <div class="card-body">
	    	<table id="table_id" class="table">
			    <thead>
			      <tr>
			      	<th><center>Spare Parts Code</center></th>
			       	<th><center>Spare Parts</center></th>
			        <th><center>Reorder Point</center></th>
			        <th><center>Quantity</center></th>
			        <th><center>Physical Inventory</center></th>
			      </tr>
			    </thead>
			    <tbody>
			    		@foreach($spare_parts as $spare_part)
			    	<tr>
			    		<td><center>{{$spare_part->code}}</center></td>
			    		<td><a href="/spare_parts_inventory/{{ $spare_part->id}}">{{$spare_part->name}}</a></td>
			    		<td><center>{{$spare_part->reorder_point}}</center></td>
			    		<td bgcolor="{{$spare_part->total_stocks <= 0 ? '#E94858' : 'white' }}"><center>{{$spare_part->total_stocks}}</center></td>

			    		<td><center> <a href = "/physical_spare_parts/{{$spare_part->id}}">Phy. Inv.</a></center></td>

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