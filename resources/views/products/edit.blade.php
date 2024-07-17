@extends('layouts.app-master')


@section('content')


@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

        @if($error =='The student name field is required.')
        <li>Se requiere el nombre del estudiante.</li>
        @elseif($error =='The student email field is required.')
        <li>Se requiere el correo del estudiante.</li>
        @elseif($error =='The student image field is required.')
        <li>Se requiere la imagen del estudiante.</li>
        @elseif($error =='The student email field must be a valid email address.')
        <li>El correo del estudiante debe ser valido.</li>
        @elseif($error =='The student image field must be an image.')
        <li>Debe seleccionar una imagen valida.</li>
        @elseif($error =='The student image field must be a file of type: jpg, png, jpeg, gif, svg.')
        <li>El formato de la imagen debe ser de tipo: jpg, png, jpeg, gif, svg.</li>
        @elseif($error =='The student image field has invalid image dimensions.')
        <li>Las dimensiones de la imagen no son validas. Debe seleccionar una imagen con dimenciones minimas 100x100 y maximas 1000x1000.</li>
        @else
        <li>{{ $error }}</li>
        @endif

	@endforeach
	</ul>
</div>

@endif

<div class="card">
	<div class="card-header">
        <div class="row">
			<div class="col col-md-6"><b>Product Edit</b></div>
			<div class="col col-md-6">
				<a href="{{ route('products.index') }}" class="btn btn-primary btn-sm float-end">Ver todos</a>
			</div>
		</div>
    </div>
	<div class="card-body">
		<form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Product Name</label>
				<div class="col-sm-10">
					<textarea type="text" name="product_name" class="form-control" rows="3">{{$product->product_name}}</textarea>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Product Description</label>
				<div class="col-sm-10">
					<input type="text" name="product_description" class="form-control" value="{{ $product->product_description }}" />
				</div>
			</div>

			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Imagen</label>
				<div class="col-sm-10">
					<input type="file" name="product_image" />
					<br />
					<img src="{{ asset('images/' . $product->product_image) }}" width="100" class="img-thumbnail" />
					<input type="hidden" name="hidden_product_image" value="{{ $product->product_image }}" />
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Category:</label>
				<div class="col-sm-10">
					<input type="hidden" id="category_id" name="category_id" value="{{ $product->category->id }}">
					<input id="autocomplet_category" name="search" type="text" class="form-control" placeholder="Search Category..."
					value="{{ $product->category->category_name }}">
				</div>
			</div>

			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $product->id }}" />
				<input type="submit" class="btn btn-primary" value="Editar" />
			</div>
		</form>
	</div>
</div>
<script>
document.getElementsByName('category_id')[0].value = "{{ $product->category_id }}";
</script>

@endsection('content')
