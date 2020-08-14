@extends('layouts.admin')
@section('title')
    User Management
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title ">User Management</h4>
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
                User
            </li>
        </ul>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header d-flex d-justify-content-between">
            <div class="card-title font-weight-bold">User List</div>
            <div class="ml-auto">
                <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm shadow">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Create User
                </a>
            </div>
        </div>
        <div class="card-body p-0 ">
            <div class="table-responsive">
                <table class="table table-head-bg-primary m-0">
                    <thead>
                        <tr>
                            <th scope="col" >#</th>
                            <th scope="col" >Full Name</th>
                            <th scope="col" >Email</th>
                            <th scope="col" >Roles</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                    <label for="" class="badge badge-primary text-white">{{ $role }}</label>
                                @endforeach
                            </td>
                            <td>
                                @can('update-user')
                                <a class="btn btn-success btn-sm shadow" href="{{route('admin.users.edit',$user->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Users"> 
                                    <i class="fa fa-pencil-alt "></i>
                                </a>
                                @endcan
                                @can('delete-user')
                                <span data-toggle="modal" data-target="#DeleteModal">
                                    <a class="btn btn-danger btn-sm shadow" href="javascript:;" onclick="deleteData({{$user->id}})" data-toggle="tooltip" data-placement="top" title="Delete Users"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </span>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class=" text-center text-muted">
                                <br />
                                <i class="fas fa-archive" style="font-size: 60px"></i>
                                <p><small>Data Empty</small></p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-white">
            <div>Showing {{($users->currentpage()-1)*$users->perpage()+1}} to {{$users->currentpage()*$users->perpage()}}
                of  {{$users->total()}} entries
            </div>
            <nav class="d-inline-block ">
                {{ $users->links() }}
            </nav>
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
        var url = '{{ route("admin.users.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
@endpush