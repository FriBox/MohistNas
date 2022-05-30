<!DOCTYPE html>
<html lang="<?php echo $xLang; ?>">
<head>
        <?php echo $__env->make('part-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo e(env('APP_NAME')); ?> - <?php echo e(__('main.page_'.Route::getFacadeRoot()->current()->uri())); ?></title>
        <?php echo $__env->make('part-bootstrap', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('part-jquery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('part-echarts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('part-lastmeta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
    <div class="pageindex">
        <!-- Index -->
        <div class="container-fluid">
            <!-- 顶部页首区域 --><?php echo $__env->make('part-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- 页面内容区域 -->
            <div class="row align-items-center" style="border-bottom:1px solid #666666;box-shadow: 0px 2px 0px 0px #ffffff;"><table border=0 rules=none cellspacing=0><tr>
                    
                    <!-- 菜单区域 --><?php echo $__env->make('part-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <td valign="top" style="padding:12px;border:none;">

<!-- 内容开始 -->
<!-- ================================================================ -->
<?php /**PATH /MohistNas/main/resources/views/part-top.blade.php ENDPATH**/ ?>