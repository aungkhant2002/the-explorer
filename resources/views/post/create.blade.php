@extends('master')
@section("title") Create Post : {{ env("app_name") }} @endsection

@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    Create a New Post
                </h4>
                <p class="mb-0 text-black-50">
                    <i class="fas fa-calendar-alt"></i>
                    {{ date("d M Y") }}
                </p>
            </div>
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="postTitle">
                    <label for="title">Post Title</label>
                    @error("title")
                    <small class="text-danger fw-bold">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <img src="{{ asset('image-default.png') }}" id="coverPreview" class="cover-img w-100 rounded @error('cover') is-invalid @enderror" alt="">
                    <input type="file" name="cover" id="cover" class="d-none">
                    @error("cover")
                    <small class="text-danger fw-bold">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                    <label for="floatingTextarea2">Share your experience</label>
                    @error("description")
                    <small class="text-danger fw-bold">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="btn btn-lg btn-primary text-white">
                        <i class="fas fa-message"></i>
                        Create Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    <div class="bg-primary py-3 mt-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col text-white">
                    Made by Aung Khant
                </div>
                <div class="col">
                    <a href="#" class="btn btn-light rounded-circle float-end">
                        <i class="fas fa-angle-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>


@endsection

@push("scripts")

    <script>

        let coverPreview = document.getElementById("coverPreview");
        let cover = document.getElementById("cover");

        coverPreview.addEventListener("click", _=>cover.click());

        cover.addEventListener("change", _=> {
           let file = cover.files[0];
           let reader = new FileReader();
           reader.onload = function () {
               coverPreview.src = reader.result;
           }
           reader.readAsDataURL(file);
        });

    </script>

@endpush
