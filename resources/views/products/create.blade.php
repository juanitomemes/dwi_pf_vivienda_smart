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
			<div class="col col-md-6"><b>Add Product</b></div>
			<div class="col col-md-6">
				<a href="{{ route('products.index') }}" class="btn btn-primary btn-sm float-end">Ver todos</a>
			</div>
		</div>
    </div>
	<div class="card-body">
		<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Name Product:</label>
				<div class="col-sm-10">
					<textarea type="text" name="product_name" class="form-control" rows="3" ></textarea>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Product Description</label>
				<div class="col-sm-10">
					<input type="text" name="product_description" class="form-control" />
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Image</label>
				<div class="col-sm-10">
					<input type="file" name="product_image" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Category:</label>
				<div class="col-sm-10">
					<input type="hidden" id="category_id" name="category_id">
					<input id="autocomplet_category" name="search" type="text" class="form-control" placeholder="Search">
				</div>
			</div>
			</div>

			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Agregar" />
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var route ="{{url('autocomplete-category')}}";
	$('#autocomplet_category').typeahead({
		displayText:function(item){
			return item.category_name
		},
		afterSelect:function(item){
			$('#category_id').val(item.id);
		},
	  source: function(term,process){
		return $.get('/autocomplete-category',{term,term},function(data){
		  return process(data);
		});
	  }
	});
  </script>
@endsection('content')
