@extends('layouts.app')

@section('content')
    @if($item->exists)
        <form action="{{ route('blog.admin.posts.update', $item->id) }}" method="POST">
        {{--Здесь мы говорим методу контроллера, который принимает данные только с методов PUT и PATCH,
        что на самом деле метод передачи не POST, а PATCH (корректировка данных)--}}
        @method('PATCH')
    @else
        <form action="{{ route('blog.admin.posts.store') }}" method="POST">
    @endif
            @csrf
            <div class="container">
            @include('blog.admin.posts.includes.result_messages')
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('blog.admin.posts.includes.post_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('blog.admin.posts.includes.post_edit_add_col')
                    </div>
                </div>
            </div>
        </form>

        @if($item->exists)
            <br>
            <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <div class="card-body ml-auto">
                                <button type="submit" class="btn btn-link">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif






{{--@if($item->exists)
    <form action="{{ route('blog.admin.posts.update', $item->id) }}" method="POST">
    @method('PATCH')
@else
    <form action="{{ route('blog.admin.posts.store') }}" method="POST">
        @endif
        @csrf
        <div class="container">
            @include('blog.admin.posts.includes.result_messages')

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.posts.includes.post_edit_main_col')
                </div>
                <div class="col-md-4">
                    @include('blog.admin.posts.includes.post_edit_add_col')
                </div>
            </div>
        </div>
    </form>--}}
@endsection
