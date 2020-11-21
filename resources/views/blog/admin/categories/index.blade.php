@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <p><a href="{{ route('blog.admin.categories.create') }}" class="btn btn-link">Добавить</a></p>
    </div>

	<div class="row justify-content-center">
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
                    <td @if(in_array($item->parent_id, [0, 1])) style="color: #bebebe" @endif >
                        {{
                            /* Перешло в аксессор
                             * $item->parentCategory->title
                                ?? ($item->id === \App\Models\BlogCategory::ROOT
                                    ? 'Корневая категория'
                                    : 'Неизвастно')*/
                            $item->parentTitle
                        }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
