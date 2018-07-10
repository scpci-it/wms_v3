@extends('main.app')

@section('content')

		
<div class="container">
	<div>
		<a href="/inventory_products">
			<button type="button" src="coconut.jpg" class="btn btn-primary" style="width:80px" href="/inventory_products">Back</button>
		</a>
	</div>


	
		<div class="card">
		    <div class="card-header bg-warning">
		    	<h1 style="text-align:center;font-weight: bold;">{{ $products->name }}</h1>
		    </div>

	     	<div class="card-body">
				<table class="table">
				    <thead>
				      <tr>
				      	<th>Warehouse</th>
				        <th>Location</th>
				        <th>Quantity</th>
				        <th>Expiration Date</th>
				      	<th>Lot No.</th>
				      </tr>
				    </thead>
				    <tbody>				    	
				    	@foreach($stocks as $location)  	
				    		
								<tr>
									<td>{{ $location->warehouse_name }}</td>
								    <td>{{ $location->location_name }}</td>
								    <td>{{ $location->stocks }}</td>		
								    <td>{{ $location->exp_date }}</td>
								    <td>{{ $location->lot_no}}</td>							    
								</tr>
							
						@endforeach
					   
						
				    </tbody>
				</table>
			</div>
		</div>
</div>

<br>

<div class="container">
	<div class="card">
		
		    <div class="card-body">
				<table class="table">
				    <thead>
				      	<tr>
					        <th>Timestamp</th>
					        <th>From</th>
					        <th>To</th>
					        <th>Expiration Date</th>
			      			<th>Lot No.</th>
					        <th>Quantity</th>
					        <th>User</th>
				      	</tr>
					</thead>
					    <tbody>
					    	@foreach($transactions as $entry)
					    		 
								    <tr>
								        <td>{{ $entry->created_at->format('M. d, Y - H:m - D') }}</td>
								        <td>{{ $entry->fromL->warehouse->code}} / {{ $entry->fromL->name}}</td>
								        <td>{{ $entry->toL->warehouse->code }} / {{ $entry->toL->name}}</td>
								        <td>{{ $entry->exp_date}}</td>
								        <td>{{ $entry->lot_no}}</td>
								        <td>{{ $entry->quantity}}</td>
								        <td>{{ $entry->user->name}}</td>
								    </tr>
								
					      	@endforeach
					  	</tbody>
				</table>
				<div>
					{{$transactions->links()}}
				</div>
					<div>
	  				<input type="hidden" name="product_id" value="{{$products->id}}">
	  				</div>
	  				
			</div>
	</div>
</div>
	
@endsection

