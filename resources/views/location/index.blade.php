@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header bg-info">
			<h1 style="text-align:center;font-weight: bold;">LOCATION</h1>
		</div>

			<div class="card-body">
				<table class="table">
				    <thead style="font-weight:bold;">
				      	<tr>
					        <th>ID</th>
					        <th>Location Name</th>
					        <th>Warehouse Name</th>
				      	</tr>
				    </thead>
	    				<tbody>
				    		@foreach($locations as $location)
						      <tr>
						        <td>{{ $location->id }}</td>
						        <td>{{ $location->name }}</td>
						         <td>{{ $location->warehouse->name}}</td>
						      </tr>
					      	@endforeach
					    </tbody>
				</table>
			</div>
	</div>
</div>

@endsection