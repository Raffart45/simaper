@extends('user.dashboard.layouts.base')

@section('content')
<div class="container-xl mt-5">
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-8 col-lg-6">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="app-card app-card-profile shadow-sm">
                <div class="app-card-body p-4 p-md-5">
                    <h4 class="app-card-title">Edit Profile</h4>
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            @if($user->avatar)
                                <div>
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail" width="150">
                                </div>
                            @endif
                            <input type="file" id="avatar" name="avatar" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="{{ route('user.profile.show') }}" class="btn btn-secondary" role="button">Kembali</a>
                    </form>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div><!--//col-->
    </div><!--//row-->
</div><!--//container-xl-->
@endsection
