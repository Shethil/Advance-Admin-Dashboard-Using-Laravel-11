@extends('admin.layouts.master')
@section('page_title', 'User Edit')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">User Edit From</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-4"> <i class="bx bx-arrow-back"> </i>
                        Back To User List </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class=" mb-3">
                            <lebel for="" class="col-sm-2 col-form-label">Role Selection</lebel>
                            <select name="role_id" id=""
                                class="form-select @error('role_id') is-invalid @enderror">
                                <option value="">Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == $user->role_id) selected @endif>
                                        {{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">User Name</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="form-control @error('name') is-invalid @enderror" id="basic-default-name"
                                placeholder="Enter A Permission Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">User Email</label>
                            <input type="text" name="email" value="{{ $user->email }}"
                                class="form-control @error('email') is-invalid @enderror" id="basic-default-email"
                                placeholder="Enter Email Address">
                            @error('email ')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">User Password</label>
                            <input type="text" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="basic-default-password"
                                placeholder="Enter Password">
                            @error('password ')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="r">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
@endpush
