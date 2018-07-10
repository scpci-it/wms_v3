@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header bg-secondary">
			 <h1 style="text-align:center;font-weight: bold;color: white;">PHYSICAL INVENTORY OF {{$product->name}}</h1>
		</div>

			<div class="card-body">
				<form method="POST" action="/physical_product">
					{{csrf_field()}}
						<table class="table">
						    <thead style="font-weight:bold;">
						      <tr>
						        <th>Location</th>
						        <th>Current Stocks</th>
						        <th>Actual Stocks</th>
						      </tr>
						    </thead>
						   		<tbody>
							    	@foreach($locations as $location)
								    	<tr>
								    		<td>
								    			<div>{{$location->warehouse_name }} / {{ $location->location_name }}</div>
								    		</td>

								    		<td>
								    			<div class="form-group">
												  <input type="text" class="form-control" name="current[{{$location->location_id}}]" value ={{$location->stocks}} readonly="readonly">
												  </input> 
												</div>	
								    		</td>

								    		<td>
								    			<div class="form-group">
												  <input type="text" class="form-control" name="actual[{{$location->location_id}}]" value = 0>
												</div>
								    		</td>
								    	</tr>
							    	@endforeach
						    	</tbody>
					  	</table>

				  			<div>
				  				<input type="hidden" name="product_id" value="{{$product->id}}">
				  				<button type="submit" class="btn btn-primary">Submit</button>
				  			</div>

				</form>
			</div>
	</div>
</div>


@endsection