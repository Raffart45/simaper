@extends('user.dashboard.layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card p-4 shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="card-title">Profile Pelanggan</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ url('user/assets/images/user.png') }}" alt="Avatar" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="text-center mb-3">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone Number:</strong> {{ $user->phone_number }}</p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
