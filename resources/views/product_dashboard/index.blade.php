@extends('main.app')

@section('content')

	<div class="container">
	  	<div class="card">
		    <div class="card-header bg-success">
		    	<h1 style="text-align:center;font-weight: bold;">CURRENT PRODUCT STOCKS</h1>
			</div>

		    	<div class="card-body">
			    	<table id="table_id" class="table">
					    <thead>
					      <tr>
					      	<th><center>Product Code</center></th>
					       	<th><center>Product</center></th>
					       	<th><center>FIFO</center></th>
					        <th><center>Reorder Point</center></th>
					        <th><center>Quantity</center></th>
					      </tr>
					    </thead>
					    	<tbody>
					    		@foreach($products as $product)

							    	<tr>
							    		<td><center>{{$product->code}}</center></td>
							    		<td><a href="/product_inventory/{{ $product->id}}">{{$product->name}}</a></td>
							    			@if($result[$product->id] == "N/A")
							    		<td><center>{{$result[$product->id]}}</center></td>
							    			@else
							    		<td><center>{{Carbon\Carbon::parse($result[$product->id])->toFormattedDateString() }}</center></td>
							    			@endif
							    		<td><center>{{$product->reorder_point}}</center></td>
							    		<td bgcolor="{{$product->total_stocks <= 0 ? '#E94858' : 'white' }}"><center>{{$product->total_stocks}}</center></td>
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