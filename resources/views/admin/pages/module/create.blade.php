@extends('admin.layouts.master')
@section('page_title', 'Module rCeate')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Module Create From</h5>
                    <a href="{{ route('module.index') }}" class="btn btn-secondary me-4"> <i class="bx bx-arrow-back"> </i>
                        Back To Module List </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('module.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="module_name" class="form-control" id="basic-default-name"
                                    placeholder="Enter A Module Name">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
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
