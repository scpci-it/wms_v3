@extends('main.app')

@section('content')

<h1><center>MOVE ITEMS</center></h1>

<div>
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach

	</ul>

</div>

<div class="container">
	<form method="POST" action="/spare_parts_transactions">
		 {{ csrf_field() }}
		<div class="form-group">
			<label for="from">Location From:</label>
  			<select class="form-control" id="from" name="from">
  				@foreach($locations as $location)
  					<option value="{{ $location->id }}">{{ $location->name }}</option>
  				@endforeach
  			</select>
		</div>

		<div class="form-group">
			<label for="to">Location To:</label>
  			<select class="form-control" id="to" name="to">
  				@foreach($locations as $location)
  					<option value="{{ $location->id }}">{{$location->warehouse->code}} / {{ $location->name }}</option>
  				@endforeach
  			</select>
		</div>

		<div class="form-group">
			<label for="spare_parts">Spare Parts:</label>
  			<select class="form-control" id="spare_parts" name="spare_parts_id">
  				@foreach($spare_parts as $spare_part)
  					<option value="{{ $spare_part->id }}">{{ $spare_part->name }}</option>
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

@endsection