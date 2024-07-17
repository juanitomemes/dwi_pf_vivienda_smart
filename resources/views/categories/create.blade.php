@extends('layouts.app-master')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
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
</div>

@endif

<div class="card">

	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Agregar una Categoria</b></div>
			<div class="col col-md-6">
				<a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm float-end">Ver lista completa</a>
			</div>
		</div>
	<div class="card-body">
		<form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Category Name</label>
				<div class="col-sm-10">
					<input type="text" name="category_name" class="form-control" />
				</div>
			</div>


			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Add" />
			</div>
		</form>
	</div>
</div>

@endsection('content')
