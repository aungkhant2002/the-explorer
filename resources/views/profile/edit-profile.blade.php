@extends('master')
@section('head') Edit Profile @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="text-center">
                    <img src="{{ asset(auth()->user()->photo) }}" class="profile-image" alt="">
                    <br>
                    <button class="btn btn-primary btn-sm" id="edit-photo" style="margin-top: -25px">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <p class="mb-0">{{ auth()->user()->name }}</p>
                    <p class="small text-black-50">{{ auth()->user()->email }}</p>
                </div>

                <form class="mt-5" action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="d-none" name="photo" accept="image/jpeg,image/png">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="yourName" value="{{ auth()->user()->name }}" placeholder="name@example.com">
                        <label for="yourName">Your Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="name@example.com">
                        <label for="floatingInput">Your Email address</label>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>

        let profileImage = document.querySelector(".profile-image");
        let photo = document.querySelector("[name='photo']");
        let editPhoto = document.querySelector("#edit-photo");

        editPhoto.addEventListener("click", function () {
           photo.click();
        });

        photo.addEventListener("change", _=> {
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function () {
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        });

    </script>

@endpush
