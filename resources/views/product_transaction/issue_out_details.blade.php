@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header bg-secondary">
			 <h1 style="text-align:center;font-weight: bold;color: white;">PHYSICAL INVENTORY OF {{$product->name}}</h1>
		</div>

			<div class="card-body">
				<form method="POST" action="/product_issue_out">
					{{csrf_field()}}
						<table class="table">
						    <thead style="font-weight:bold;">
						        <tr>
							        <th>Location</th>
							        <th>Expiration Date</th>
							        <th>Lot No</th>
							        <th>Current Stocks</th>
							        <th>Quantity to Pick</th>
						        </tr>
						    </thead>
						    	<tbody>
						    		@foreach($locations as $location)
								    	<tr>
								    		<td> {{$location->warehouse_name }} / {{ $location->location_name }}</td>
								    		<td> {{$location->exp_date}} </td>
								    		<td> {{$location->lot_no}} </td>
								    		<td> {{$location->stocks}} </td>
								    		<td>
												<input type="text" class="form-control"  name="to_picked[{{$location->current_id}}]" 
															value = {{$picked[$location->current_id]['quantity_to_subtract']}}>
								    		</td>
								    	</tr>
						    		@endforeach
						    	</tbody>
					  	</table>
							<div>
							    <input type="hidden" class="form-control"  name="to" value = {{ $to_location->id }}>
								<input type="hidden" class="form-control"  name="product_id" value = {{$product->id}}>
								<a href="/product_transactions/issue_out"> <button type="button" class="btn btn-primary" style="width:80px" href="/inventory_products">Cancel</button>
		</a>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
				</form>
			</div>
	</div>
</div>


@endsection