@extends('master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <div class="post mb-4">
                    <div class="row">
                        <h4 class="mb-4 fw-bold">{{ $post->title }}</h4>
                        <img src="{{ asset("storage/cover/".$post->cover_photo) }}"
                             class="mb-4 cover-img rounded-3 w-100" alt="">
                        <p class="mb-4 text-black-50 post-detail">{{ $post->description }}</p>
                        <div class="mb-4 d-flex justify-content-between align-items-center border rounded p-4">
                            <div class="d-flex">
                                <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle" alt="">
                                <p class="mb-0 ms-2 small">
                                    {{ $post->user->name }}
                                    <br>
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="">
                                @auth
                                    @can('delete', $post)
                                        <form action="{{ route('post.destroy', $post->id) }}" class="d-inline-block"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger">Delete Post</button>
                                        </form>
                                    @endcan
                                    @can('update', $post)
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-warning">Edit
                                            Post</a>
                                    @endcan
                                @endauth
                                <a href="{{ route('index') }}" class="btn btn-outline-primary">Read All</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
