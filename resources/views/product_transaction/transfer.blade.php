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

	<div class="card-header bg-success">

	    	<h1 style="text-align:center;font-weight: bold;">Transfer Within Facility</h1>
		</div>

	<form method="POST" action="/product_transactions">
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
			<label for="product">Product:</label>
  			<select class="form-control" id="product" name="product_id">
  				@foreach($products as $product)
  					<option value="{{ $product->id }}">{{ $product->name }}</option>
  				@endforeach
  			</select>
		</div>
		  
		<div class="form-group">
			<label for="quantity">Quantity</label>
		    <input type="text" class="form-control" id="quantity" name="quantity" required>
		</div>

		<!--<div class="form-group">
			<label for="exp_date">Expiration Date</label>
		    <input type="date" class="form-control" id="exp_date" name="exp_date" required>
		</div>-->

		<div class="form-group">
			<label for="exp_date">Exp Date:</label>
  			<select class="form-control" id="exp_date" name="exp_date">
  				
  					<option> 2018-06-30 </option>
  				
  			</select>
		</div> 
		
		<div class="form-group">
			<label for="lot_no">Lot No:</label>
		    <input type="text" class="form-control" id="lot_no" name="lot_no" required>
		</div>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form> 
</div>

@endsection