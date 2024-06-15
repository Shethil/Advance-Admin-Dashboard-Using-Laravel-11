@extends('admin.layouts.master')
@section('page_title', 'Permission Create')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Permission Create From</h5>
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary me-4"> <i class="bx bx-arrow-back"> </i>
                        Back To Permission List </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf

                        <div class=" mb-3">
                            <lebel for="" class="col-sm-2 col-form-label">Module Selection</lebel>
                            <select name="module_id" id=""
                                class="form-select @error('module_id') is-invalid @enderror">
                                <option value="">Select a Module</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                @endforeach
                            </select>
                            @error('module_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <input type="text" name="permission_name"
                                class="form-control @error('permission_name') is-invalid @enderror" id="basic-default-name"
                                placeholder="Enter A Permission Name">
                            @error('permission_name')
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
