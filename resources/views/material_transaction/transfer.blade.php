@extends('main.app')

@section('content')


<div>
	<ul>

		<h3 style=" color:red;font-weight: bold">
		
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</h3>

		</ul>
	</div>
</div>

<div class="container">
	<div>
		<a href="/inventory_material">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_material">Back</button>
		</a>
	</div>

	<div class="card">

	<div class="card-header bg-success">
	    	<h1 style="text-align:center;font-weight: bold;">TRANSACTION OF MATERIALS</h1>
		</div>

<div class="card-body" style="font-weight:bold;">
	<form method="POST" action="/material_transactions">
		 {{ csrf_field() }}
		<div class="form-group">
			<label for="from">Location From:</label>
  			<select class="form-control" id="from" name="from">
  				@foreach($from_locations as $location)
  					<option value="{{ $location->id }}">{{$location->warehouse->name}} / {{ $location->name }}</option>
  				@endforeach
  			</select>
		</div>

		<div class="form-group">
			<label for="to">Location To:</label>
  			<select class="form-control" id="to" name="to">
  				@foreach($to_locations as $location)
  					<option value="{{ $location->id }}">{{$location->warehouse->name}} / {{ $location->name }}</option>
  				@endforeach
  			</select>
		</div>

		<div class="form-group">
			<label for="material">Material:</label>
  			<select class="form-control" id="material" name="material_id">
  				@foreach($materials as $material)
  					<option value="{{ $material->id }}">{{ $material->name }}</option>
  				@endforeach
  			</select>
		</div>
		  
		<div class="form-group">
			<label for="quantity">Quantity</label>
		    <input type="text" class="form-control" id="quantity" name="quantity" required>
		</div>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form> 
</div>
</div>
</div>

@endsection