@extends('layouts.app-master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Categories List</b></div>
			<div class="col col-md-6">
				<a href="{{ route('categories.create') }}" class="btn btn-success btn-sm float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>@sortablelink('category_name', 'Category')</th>
				<th>Accion</th>
			</tr>
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td>{{ $row->category_name }}</td>

						<td>
							<form method="post" action="{{ route('categories.destroy', $row->id) }}">
								@csrf
								@method('DELETE')
								<a href="{{ route('categories.show', $row->id) }}" class="btn btn-primary btn-sm">Ver</a>
								<a href="{{ route('categories.edit', $row->id) }}" class="btn btn-warning btn-sm">Editar</a>
								<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
							</form>

						</td>
					</tr>

				@endforeach

			@else
				<tr>
					<td colspan="5" class="text-center">Datos no encontrados</td>
				</tr>
			@endif
		</table>

        {!! $data->appends(Request::except('page'))->render() !!}


        <p>
			Displaying {{$data->count()}} of {{ $data->total() }} Category(s).
		</p>
	</div>
</div>

@endsection
