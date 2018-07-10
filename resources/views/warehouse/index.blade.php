@extends('main.app')

@section('content')

<div class="container">
	<div class="card">
	<div class="card-header bg-info">

	 <h1 style="text-align:center;font-weight: bold;">WAREHOUSES</h1>

	</div>
	 <div class="card-body">


	<table class="table">
	    <thead style="font-weight:bold;">
	      <tr>
	        <th>ID</th>
	        <th>Warehouse Name</th>
	        <th>Code</th>
	    
	      </tr>
	    </thead>
	    <tbody>
    		@foreach($warehouses as $warehouse)
		      <tr>
		        <td>{{ $warehouse->id }}</td>
		        <td>{{ $warehouse->name }}</td>
		        <td>{{ $warehouse->code }}</td>
		      </tr>
	      	@endforeach
	    </tbody>
  	</table>
</div>

@endsection