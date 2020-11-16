@extends('layouts.app')

@section('content')
	<p><a href="{{ route('blog.admin.categories.create') }}">Добавить</a></p>
	<table>
		<thead>
			<tr>
				<th>#</th>
			    <th>Категория</th>
			    <th>Родитель</th>
			</tr>
		</thead>
		<tbody>
			@foreach($paginator as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>
						<a href="{{ route('blog.admin.categories.edit', $item->id) }}">
							{{ $item->title }}
						</a>
					</td>
					<td> 
						{{ $item->parent_id }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection