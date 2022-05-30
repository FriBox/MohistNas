<!DOCTYPE html>
<html lang="<?php echo $xLang; ?>">
<head>
        @include('part-meta')
    <title>{{ env('APP_NAME') }} - {{ __('main.page_'.Route::getFacadeRoot()->current()->uri()) }}</title>
        @include('part-bootstrap')
        @include('part-jquery')
        @include('part-echarts')
        @include('part-lastmeta')
<body>
    <div class="pageindex">
        <!-- Index -->
        <div class="container-fluid">
            <!-- 顶部页首区域 -->@include('part-header')
            <!-- 页面内容区域 -->
            <div class="row align-items-center" style="border-bottom:1px solid #666666;box-shadow: 0px 2px 0px 0px #ffffff;"><table border=0 rules=none cellspacing=0><tr>
                    
                    <!-- 菜单区域 -->@include('part-menu')
                    <td valign="top" style="padding:12px;border:none;">

<!-- 内容开始 -->
<!-- ================================================================ -->
