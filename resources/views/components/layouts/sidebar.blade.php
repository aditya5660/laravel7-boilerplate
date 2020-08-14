<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Administration Panel</h4>
                </li>
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
                                $has_sub = 'has-sub submenu';
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
                        <li class="nav-item {{$selected}} {{$has_sub}}">
                            <a data-toggle="{{$data_toggle}}" href="{{$url_parent}}" aria-expanded="">
                                <i class="{{$navigation->icon}}"></i>
                                <p>{{$navigation->name}}</p>
                                {!! $menu_arrow !!}
                            </a>
                            <div class="" id="{{$data_target}}">
                            @if (count($navigation->children))
                                @include('components.layouts.sidebar-children',['childrens'=> $navigation->children])
                            @endif
                            </div>
                        </li>
                    @endcan
                @empty
                    
                @endforelse
            </ul>
        </div>
    </div>
</div>