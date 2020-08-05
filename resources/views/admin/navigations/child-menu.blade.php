@foreach ($childrens as $item)    
@php $indent .= '-- ' @endphp
<tr>
    <td><i class="{{$item->icon}}"></i></td>
    <td>{{$indent}} {{$item->name}}</td>
    <td>{{$item->url}}</td>
    <td>
        <a href="{{route('admin.navigations.edit',$item->id)}}" class="btn"  data-toggle="tooltip" data-placement="top" title="Edit Role">
            <i class="la la-pencil-alt" ></i>
        </a>
        <span data-toggle="modal" data-target="#DeleteModal">
            <a href="javascript:;" onclick="deleteData({{$item->id}})" class="btn"  data-toggle="tooltip" data-placement="top" title="Delete Role ">
                <i class="las la-trash" ></i>
            </a>
        </span>
    </td>
</tr>
@endforeach