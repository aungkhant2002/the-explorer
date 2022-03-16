@extends('master')
@section("title") Create Post : {{ env("app_name") }} @endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        Edit Post
                    </h4>
                    <p class="mb-0 text-black-50">
                        <i class="fas fa-calendar-alt"></i>
                        {{ date("d M Y") }}
                    </p>
                </div>
                <form action="{{ route('post.update', $post->id) }}" id="post-create" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                               id="title" placeholder="postTitle" value="{{ old('title', $post->title) }}">
                        <label for="title">Post Title</label>
                        @error("title")
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <img src="{{ asset('storage/cover/'.$post->cover_photo) }}" id="coverPreview"
                             class="cover-img w-100 rounded @error('cover') is-invalid @enderror" alt="">
                        <input type="file" name="cover" id="cover" class="d-none" accept="image/jpeg,image/png">
                        @error("cover")
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                  placeholder="Leave a comment here" id="floatingTextarea2"
                                  style="height: 200px">{{ old('description', $post->description) }}</textarea>
                        <label for="floatingTextarea2">Share your experience</label>
                        @error("description")
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                </form>

                <div class="border p-3 rounded mb-4" id="gallery">
                    <div class="d-flex align-items-stretch">
                        <div class="border px-5 rounded-2 d-flex justify-content-center align-items-center" style="height: 150px;" id="upload-ui">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="d-flex overflow-scroll" style="height: 150px;">
                            @forelse($post->galleries as $gallery)
                                <div class="d-flex align-items-end">
                                    <img src="{{ asset("storage/gallery/".$gallery->photo) }}" class="mx-1 h-100 rounded-1" alt="">
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm gallery-img-delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <p>There is no photo</p>
                            @endforelse
                        </div>
                    </div>
                    <form action="{{ route('gallery.store') }}" id="gallery-upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="">
                            <input type="file" name="galleries[]" class="d-none @error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror" multiple id="gallery-input">
                            @error('galleries')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                            @error('galleries.*')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <button class="btn btn-lg btn-primary text-white" form="post-create">
                        <i class="fas fa-message"></i>
                        Update Post
                    </button>
                </div>
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

        coverPreview.addEventListener("click", _ => cover.click());

        cover.addEventListener("change", _ => {
            let file = cover.files[0];
            let reader = new FileReader();
            reader.onload = function () {
                coverPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        });


        let uploadUi = document.getElementById("upload-ui");
        let galleryInput = document.getElementById("gallery-input");
        let galleryUpload = document.getElementById("gallery-upload");

        uploadUi.addEventListener("click", function () {
            galleryInput.click();
        })

        galleryInput.addEventListener("change", function () {
            galleryUpload.submit();
        })

    </script>

@endpush
