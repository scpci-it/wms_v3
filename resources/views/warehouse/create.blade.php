@extends('main.app')

@section('content')




<div class="container">
	<div class="card">


<div class="card-header bg-primary">

	 <h1 style="text-align:center;font-weight: bold;">CREATE WAREHOUSE</h1>

</div>
 <div class="card-body" style="font-weight:bold;">

	<form method="POST" action="/warehouses">
		 {{ csrf_field() }}
		
		<div class="form-group">
			<label for="name">Warehouse Name:</label>
		    <input type="text" class="form-control" id="name" name="name" required="">
		</div>

		<div class="form-group">
			<label for="code">Code:</label>
		    <input type="text" class="form-control" id="code" name="code" required="">
		</div>
		  
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form> 
</div>
</div>
</div>

@endsection