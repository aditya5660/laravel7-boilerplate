@extends('layouts.admin')
@section('title')
    Permissions
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header ">
        <h4 class="page-title">Permissions</h4>
        <ul class="breadcrumbs d-none d-md-block">
            <li class="nav-home">
                <a href="{{route('admin.dashboard')}}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Administrator</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item text-primary">
                Permissions
            </li>
        </ul>
    </div>
    @include('layouts.alert')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <form action="{{ route('admin.users.add_permission') }}" method="post" id="form">
                    <div class="card-header bg-white">
                        <div class="card-title font-weight-bold">Add New Permission</div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            <label for="name" class="error form-text text-danger"> @error('name') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="card-footer text-right bg-white">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="card-title font-weight-bold"> Set Permission to Role</div>
                </div>    
                <div class="card-body">
                    <form action="{{ route('admin.users.roles_permission') }}" method="GET">
                        <div class="form-group">
                            <label for="">Roles</label>
                            <div class="input-group">
                                <select name="role" class="form-control">
                                    @foreach ($roles as $value)
                                        <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-success">Check!</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    @if (!empty($permissions))
                        <form action="{{ route('admin.users.set_role_permission', request()->get('role')) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Permissions</label>
                                @php $no = 1; @endphp
                                <ul class="list-group">
                                @foreach ($permissions as $key => $row)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $row->name }}" {{ in_array($row->name, $hasPermission) ? 'checked':'' }}>
                                                <span class="form-check-sign">{{ $row->name }}</span>
                                            </label>
                                        </div>
                                        <span data-toggle="modal" data-target="#DeleteModal">
                                            <a href="javascript:;" onclick="deleteData({{$row->id}})" class="btn"  data-toggle="tooltip" data-placement="top" title="Delete Permission ">
                                                <i class="las la-trash" ></i>
                                            </a>
                                        </span>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary">
                                    <i class="la la-send"></i> Set Permission
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-center">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <div class="alert alert-warning show fade">
                        <div class="alert-body">
                            Are You Sure Want To Delete ? 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush
@push('scripts')
<script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("admin.users.destroy_permission", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
<script>
    $(document).ready(function(){
        $("#form").validate();
    });
</script>
@endpush