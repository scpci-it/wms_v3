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

<div class="container">
	<div>
		<a href="/inventory_products">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_products">Back</button>
		</a>
	</div>
	
		<div class="card">
			<div class="card-header bg-success">
			    <h1 style="text-align:center;font-weight: bold;">PRODUCT RECEIPTS</h1>
			</div>

					<div class="card-body" style="font-weight:bold;">
						<form method="POST" action="/product_issue_in">
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

							<div class="form-group">
								<label for="exp_date">Expiration Date:</label>
							    <input type="date" class="form-control" id="exp_date" name="exp_date" required>
							</div>

							<div class="form-group">
								<label for="lot_no">Lot No:</label>
							    <input type="text" class="form-control" id="lot_no" name="lot_no" required>
							</div>
							
							<div class="form-group">
								<label for="remarks">Remarks:</label>
							    <input type="text" class="form-control" id="remarks" name="remarks" required>
							</div>
							
							<button type="submit" class="btn btn-primary">Submit</button>
						</form> 
					</div>
		</div>
</div>

@endsection