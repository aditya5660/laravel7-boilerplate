<div class="py-1">
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
    <a class="px-4 list-group-item list-group-item-action border-0 text-secondary {{$selected}}" href="{{$url_parent}}">
        <i class="mr-1 la la-dot-circle"></i>
        {{$item->name}}
    </a>
    @endforeach
</div>