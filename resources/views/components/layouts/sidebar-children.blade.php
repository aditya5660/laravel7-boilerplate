<ul class="nav nav-collapse">
    @foreach ($childrens as $item)
    @php
        if (count($item->children)) {
            $url_parent = '#'.strtolower(str_replace(' ', '', $item->name));
            $parent_class_caret = '';
            $data_toggle = 'collapse';
            $collapsed = 'collapse show';
            $data_target = strtolower(str_replace(' ', '',$item->name));
            $menu_arrow = '<i class="la la-angle-down ml-auto"></i>';
            $has_sub = '';
        } else {
            $parent_class_caret = '';
            $url_parent = url($item->url);
            $data_toggle = '';
            $collapsed = 'collapse';
            $data_target = strtolower(str_replace(' ', '',$item->name));
            $menu_arrow = '';
            $has_sub = '';
        }
        $selected = url()->current() == url($item->url) ? 'active' : '';
    @endphp
    <li class="{{$selected}}" >
        <a href="{{$url_parent }}" >
            <span class="sub-item">{{$item->name}}</span>
        </a>
    </li>
    @endforeach
</ul>