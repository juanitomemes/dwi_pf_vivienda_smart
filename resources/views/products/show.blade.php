@extends('layouts.app-master')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Products Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('products.index') }}" class="btn btn-primary btn-sm float-end">Ver lista completa</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Product Name</b></label>
			<div class="col-sm-10">
				{{ $product->product_name }}
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Product Description</b></label>
			<div class="col-sm-10">
				{{ $product->product_description }}
			</div>
		</div>
        <div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Image</b></label>
			<div class="col-sm-10">
				<img src="{{ asset('images/' .  $product->product_image) }}" width="200" class="img-thumbnail" />
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Category</b></label>
			<div class="col-sm-10">
				{{ $product->category->category_name }}
			</div>
		</div>

		</div>
	</div>
</div>

@endsection('content')
