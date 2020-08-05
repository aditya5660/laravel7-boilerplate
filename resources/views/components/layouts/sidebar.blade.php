<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-primary text-white font-bold">
        <img src="{{asset('logo-blue.png')}}" alt="" srcset="" class="mr-2">
        {{config('app.name')}} 
    </div>
    <div class="list-group list-group-flush">
        @forelse ($navigations as $navigation)
            @can($navigation->permission_name)
            @php
            if (count($navigation->children)) {
                $url_parent = '#'.strtolower(str_replace(' ', '', $navigation->name));
                $parent_class_caret = '';
                $data_toggle = 'collapse';
                $collapsed = 'collapse show';
                $data_target = strtolower(str_replace(' ', '',$navigation->name));
                $menu_arrow = '<i class="la la-angle-down ml-auto"></i>';
                $has_sub = '';
            } else {
                $parent_class_caret = '';
                $url_parent = url($navigation->url);
                $data_toggle = '';
                $collapsed = 'collapse';
                $data_target = strtolower(str_replace(' ', '',$navigation->name));
                $menu_arrow = '';
                $has_sub = '';
            }
            $selected = url()->current() == url($navigation->url) ? 'active' : '';
            @endphp
            <a data-toggle="{{$data_toggle}}" href="{{$url_parent}}" class="list-group-item list-group-item-action border-0 d-flex justify-content-between {{ $selected }} ">
                <div >
                    <i class="{{$navigation->icon}} mr-2"></i>
                    {{$navigation->name}}
                </div>
                {!! $menu_arrow !!}
            </a>
            <div id="{{$data_target}}" class="collapse" aria-labelledby="headingUtilities" data-parent="{{$data_target}}">
                @if (count($navigation->children))
                    @include('components.layouts.sidebar-children',['childrens'=> $navigation->children])
                @endif
            </div>
            @endcan
        @empty
            
        @endforelse
        <a class="list-group-item list-group-item-action border-0" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
            <i class="la la-file-import mr-2 "></i>
            {{ __('Logout') }} 
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>