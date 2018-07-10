@extends('main.app')

@section('content')

<div>
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>

<div class="container">
	<div>
		<a href="/inventory_material">
			<button type="button" class="btn btn-primary" style="width:80px" href="/inventory_material">Back</button>
		</a>
	</div>

	<div class="card">
		<div class="card-header bg-primary">
			<h1 style="text-align:center;font-weight: bold;">CREATE MATERIAL</h1>
		</div>

		<div class="card-body" style="font-weight:bold;">
			<form method="POST" action="/materials">
		 		{{ csrf_field() }}
		 
				<div class="form-group">
					<label for="name">Material Name:</label>
				    <input type="text" class="form-control" id="name" name="name" required>
				</div>

				<div class="form-group">
					<label for="code">Code:</label>
				    <input type="text" class="form-control" id="code" name="code" required>
				</div>

				<div class="form-group">
					<label for="description">Description:</label>
				    <input type="text" class="form-control" id="description" name="description" >
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form> 
		</div>
	</div>
</div>

@endsection
