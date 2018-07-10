@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header bg-info">
			<h1 style="text-align:center;font-weight: bold;">CATEGORY</h1>
		</div>

 		<div class="card-body">
			<table class="table">
	    		<thead style="font-weight:bold;">
			      <tr>
			        <th>ID</th>
			        <th>Category Name</th>
			      </tr>
	    		</thead>
	    			<tbody>
			    		@foreach($categories as $category)
					      <tr>
					        <td>{{ $category->id }}</td>
					        <td>{{ $category->name }}</td>
					      </tr>
				      	@endforeach
	   				</tbody>
  			</table>
		</div>
	</div>
</div>

@endsection