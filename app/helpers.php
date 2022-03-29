
<!--页面自定制，在app.blade.php引用-->
<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}