@extends('layouts.admin')
@section('title')
    Navigation
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Navigation</h4>
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
                Navigation
            </li>
        </ul>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header d-flex d-justify-content-between">
            <div class="card-title font-weight-bold">Navigation List</div>
            <div class="ml-auto">
                <a href="{{route('admin.navigations.create')}}" class="btn btn-primary btn-sm shadow">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Create Navigation
                </a>
            </div>
        </div>
        <div class="card-body p-0 ">
            <div class="table-responsive">
                <table class="table table-head-bg-primary m-0">
                    <thead>
                        <tr>
                            <th scope="col" width="5%"  >Icon</th>
                            <th scope="col" width="30%" >Name</th>
                            <th scope="col" width="30%" >URL</th>
                            <th scope="col" width="30%" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($navigations as $navigation)
                        <tr>
                            <td><i class="{{$navigation->icon}}"></i></td>
                            <td>{{ $indent }} {{$navigation->name}}</td>
                            <td>{{$navigation->url}}</td>
                            <td>
                                @can('update-navigation')
                                <a class="btn btn-success btn-sm shadow" href="{{route('admin.navigations.edit',$navigation->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Navigation"> 
                                    <i class="fa fa-pencil-alt "></i>
                                </a>
                                @endcan
                                @can('delete-navigation')    
                                <span data-toggle="modal" data-target="#DeleteModal">
                                    <a class="btn btn-danger btn-sm shadow" href="javascript:;" onclick="deleteData({{$navigation->id}})" data-toggle="tooltip" data-placement="top" title="Delete Navigation"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </span>
                                @endcan
                            </td>
                        </tr>
                        @if (count($navigation->children))
                            @include('admin.navigations.child-menu',['childrens'=> $navigation->children ,'indent' => $indent])
                        @endif
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
            <div>Showing {{($navigations->currentpage()-1)*$navigations->perpage()+1}} to {{$navigations->currentpage()*$navigations->perpage()}}
                of  {{$navigations->total()}} entries
            </div>
            <nav class="d-inline-block ">
                {{ $navigations->links() }}
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
        var url = '{{ route("admin.navigations.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
@endpush

