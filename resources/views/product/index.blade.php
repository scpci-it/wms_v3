@extends('main.app')

@section('content')

<div class="container">
	<div class="card">

		<div class="card-header bg-info">
	 		<h1 style="text-align:center;font-weight: bold;">LIST OF PRODUCTS</h1>
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
					    		@foreach($products as $product)
							      <tr>
							        <td>{{ $product->id }}</td>
							        <td>{{ $product->name }}</td>
							        <td>{{ $product->code }}</td>
									<td>{{ $product->description }}</td>
							      </tr>
						      	@endforeach
						    </tbody>
				  	</table>
  				</div>
  	</div>
</div>

@endsection