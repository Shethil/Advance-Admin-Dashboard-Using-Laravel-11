@extends('admin.layouts.master')
@section('page_title', 'Role Edit')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Role Edit From</h5>
                    <a href="{{ route('role.index') }}" class="btn btn-secondary me-4"> <i class="bx bx-arrow-back"> </i>
                        Back To Role List </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Role Name</label>
                            <input type="text" name="role_name" value="{{ $role->role_name }}" class="form-control"
                                id="basic-default-fullname" placeholder="enter a role name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Role Note</label>
                            <input type="text" name="role_note" value="{{ $role->role_note }}" class="form-control"
                                id="basic-default-fullname" placeholder="enter a role note">
                        </div>
                        {{-- <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_deleteable" id="defaultCheck3" checked>
                            <label class="form-check-label" for="defaultCheck3"> Is Deleteable </label>
                        </div> --}}

                        <div class="mt-4 mb-2">
                            <strong>Manage Permissions for Role</strong>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all"> Select All </label>
                        </div>

                        <div class="my-5">
                            @foreach ($modules->chunk(2) as $key => $chunks)
                                <div class="row">
                                    @foreach ($chunks as $module)
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <h5 class="text-primary">Module: {{ $module->module_name }}</h5>

                                            <!-- module permissions list  -->
                                            @foreach ($module->permissions as $permission)
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}" id="permission-{{ $permission->id }}"
                                                        @if (isset($role)) @foreach ($role->permissions as $rPermission)
                                            {{ $rPermission->id == $permission->id ? 'checked' : '' }}
                                            @endforeach @endif>
                                                    <label class="form-check-label"
                                                        for="permission-{{ $permission->id }}">{{ $permission->permission_name }}</label>
                                                </div>
                                            @endforeach

                                            <!-- module permissions list  -->
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

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
    <script>
        // Listern for click on select all checkbox
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                // Loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
