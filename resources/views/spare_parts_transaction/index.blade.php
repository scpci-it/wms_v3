@extends('main.app')

@section('content')

	<div class="container">
		<div>
		<a href="/inventory_spare_parts">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_spare_parts">Back</button>
		</a>
	</div>

	  <div class="card">
	    <div class="card-header bg-info">

	    	<h1 style="text-align:center;font-weight: bold;">WAREHOUSE MOVEMENTS</h1>

	    </div>

	    <div class="card-body">
			<table class="table">
			    <thead>
			      	<tr>
				        <th>ID</th>
				        <th>Timestamp</th>
				        <th>Spare Parts</th>
				        <th>From</th>
				        <th>To</th>
				        <th>Quantity</th>
				        <th>User</th>
			      	</tr>
				</thead>
				    <tbody>
				    	@foreach($movements as $entry)
						    <tr>
						        <td>{{ $entry->id}}</td>
						        <td>{{ $entry->created_at->format('M. d, Y - H:m - D') }}</td>
						        <td>{{ $entry->spare_parts->name}}</td>
						        <td>{{ $entry->fromL->name}}</td>
						        <td>{{ $entry->toL->warehouse->code }} / {{ $entry->toL->name}}</td>
						        <td>{{ $entry->quantity}}</td>
						        <td>{{ $entry->user->name}}</td>
						    </tr>
				      	@endforeach
				  	</tbody>
			</table>

			  	<div>
		  			{{ $movements->links() }}
				</div>

	    </div>
	  </div>
	</div>

@endsection