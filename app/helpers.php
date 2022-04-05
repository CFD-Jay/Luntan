

<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}


//make_excerpt是定义在helpers的函数，根据topic的body生成excerpt.在TopicObserver调用
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}