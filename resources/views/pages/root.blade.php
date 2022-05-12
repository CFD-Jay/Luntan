<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
              
             $(function(){
                 var width=document.body.clientWidth;
                 $.ajax({
                     url:"width"
                     type:"get",
                     data:{"width":"1"},
                     success:function(){
                         alert(1);
                     },
                     error:function(){
                         alert(2);
                     }
                 });
             })
             
</script>
<?php
?>
@extends('layouts.app')
@section('title', '首页')
@section('content')
  <h1>这里是首页</h1>
  <a href="{{route('test')}}">1</a>
@stop