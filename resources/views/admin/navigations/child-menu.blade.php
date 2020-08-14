@foreach ($childrens as $item)    
@php $indent .= '-- ' @endphp
<tr>
    <td><i class="{{$item->icon}}"></i></td>
    <td>{{$indent}} {{$item->name}}</td>
    <td>{{$item->url}}</td>
    <td>
        @can('update-navigation')
        <a class="btn btn-success btn-sm shadow" href="{{route('admin.navigations.edit',$item->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Navigation"> 
            <i class="fa fa-pencil-alt "></i>
        </a>
        @endcan
        @can('delete-navigation')    
        <span data-toggle="modal" data-target="#DeleteModal">
            <a class="btn btn-danger btn-sm shadow" href="javascript:;" onclick="deleteData({{$item->id}})" data-toggle="tooltip" data-placement="top" title="Delete Navigation"> 
                <i class="fa fa-trash"></i>
            </a>
        </span>
        @endcan
    </td>
</tr>
@endforeach