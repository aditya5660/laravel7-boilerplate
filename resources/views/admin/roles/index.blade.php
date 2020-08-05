@extends('layouts.admin')
@section('title')
    Roles
@endsection
@section('content')
<div class="page-inner">
    @include('layouts.alert')
    <div class="card">
        <div class="card-header bg-white">
            <div class="h4 text-primary">{{$pageTitle}} 
                @can('create-role')    
                <a href="{{route('admin.roles.create')}}" class="float-right btn btn-outline-primary  btn-sm">
                    <span class="btn-label">
                        <i class="las la-plus"></i>
                    </span>
                    Create {{$pageTitle}}
                </a>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" width="20%"class="text-primary">#</th>
                            <th scope="col" width="50%"class="text-primary">Name</th>
                            <th scope="col" width="30%"class="text-primary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                @can('update-role')    
                                <a href="{{route('admin.roles.edit',$role->id)}}" class="btn"  data-toggle="tooltip" data-placement="top" title="Edit Role">
                                    <i class="la la-pencil-alt" ></i>
                                </a>
                                @endcan
                                @can('delete-role')
                                <span data-toggle="modal" data-target="#DeleteModal">
                                    <a href="javascript:;" onclick="deleteData({{$role->id}})" class="btn"  data-toggle="tooltip" data-placement="top" title="Delete Role ">
                                        <i class="las la-trash" ></i>
                                    </a>
                                </span>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class=" text-center text-muted">
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
            <div>Showing {{($roles->currentpage()-1)*$roles->perpage()+1}} to {{$roles->currentpage()*$roles->perpage()}}
                of  {{$roles->total()}} entries
            </div>
            <nav class="d-inline-block ">
                {{ $roles->links() }}
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
        var url = '{{ route("admin.roles.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
@endpush