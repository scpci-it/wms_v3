@extends('main.app')

@section('content')

<div class="container">

	<div class="card-header bg-info">

	 <h1 style="text-align:center;font-weight: bold;">LIST OF SPARE PARTS</h1>

</div>

	<table class="table">
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Code</th>
	        <th>Description</th>

	      </tr>
	    </thead>
	    <tbody>
    		@foreach($spare_parts as $spare_part)
		      <tr>
		        <td>{{ $spare_part->id }}</td>
		        <td>{{ $spare_part->name }}</td>
		        <td>{{ $spare_part->code }}</td>
				<td>{{ $spare_part->description }}</td>
		      
		      </tr>
	      	@endforeach
	    </tbody>
  	</table>
</div>

@endsection