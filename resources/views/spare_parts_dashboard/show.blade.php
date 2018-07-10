@extends('main.app')

@section('content')

<div class="container">
	<div>
		<a href="/inventory_spare_parts">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_spare_parts">Back</button>
		</a>
	</div>
	<div class="card">
	    <div class="card-header bg-warning">

	    	<h1 style="text-align:center;font-weight: bold;">{{ $spare_parts->name }}</h1>

	    </div>

     	<div class="card-body">
			<table class="table">
			    <thead>
			      <tr>
			      	<th>Warehouse</th>
			        <th>Location</th>
			        <th>Quantity</th>
			      </tr>
			    </thead>
			    <tbody>
			    	@foreach($spare_parts->locations as $location)
			    		@if($location->type ==  "Physical")
				    	<tr>
				    		<td>{{ $location->warehouse->name }}</td>
				    		<td>{{ $location->name }}</td>
				    		<td>{{ $location->pivot->stocks }}</td>
				    	</tr>
				    	@endif
			    	@endforeach

			    </tbody>
		  	</table>
	    </div>
    </div>
</div>

<br>
<br>

<div class="container">
	<div class="card">
		
		    <div class="card-body">
				<table class="table">
				    <thead>
				      	<tr>
					        <th>ID</th>
					        <th>Timestamp</th>
					        <th>From</th>
					        <th>To</th>
					        <th>Quantity</th>
					        <th>User</th>
				      	</tr>
					</thead>
					    <tbody>
					    	@foreach($transactions as $entry)
					    		 @if ($entry->spare_parts_id == $spare_parts->id)
								    <tr>
								        <td>{{ $entry->id}}</td>
								        <td>{{ $entry->created_at->format('M. d, Y - H:m - D') }}</td>
								        <td>{{ $entry->fromL->name}}</td>
								        <td>{{ $entry->toL->warehouse->code }} / {{ $entry->toL->name}}</td>
								        <td>{{ $entry->quantity}}</td>
								        <td>{{ $entry->user->name}}</td>
								    </tr>
								@endif
					      	@endforeach
					  	</tbody>
				</table>

					<div>
	  				<input type="hidden" name="product_id" value="{{$spare_parts->id}}">
	  				</div>
	  				
			</div>
	</div>
</div>
	

@endsection

