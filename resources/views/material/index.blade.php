@extends('main.app')

@section('content')

<div class="container">
	<div>
		<a href="/inventory_material">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_material">Back</button>
		</a>
	</div>

	<div class="card">
		<div class="card-header bg-info">
			<h1 style="text-align:center;font-weight: bold;">LIST OF MATERIALS</h1>
		</div>
		
			<div class="card-body">
				<table class="table">
				    <thead  style="font-weight:bold;">
				      <tr>
				        <th>ID</th>
				        <th>Name</th>
				        <th>Code</th>
				        <th>Description</th>
				      </tr>
				    </thead>
					    <tbody>
				    		@foreach($materials as $material)
						      <tr>
						        <td>{{ $material->id }}</td>
						        <td>{{ $material->name }}</td>
						        <td>{{ $material->code }}</td>
								<td>{{ $material->description }}</td>
						      </tr>
					      	@endforeach
					    </tbody>
			  	</table>
			</div>
	</div>
</div>

@endsection