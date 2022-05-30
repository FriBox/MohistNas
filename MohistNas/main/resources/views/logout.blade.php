<!DOCTYPE html>
<html lang="<?php echo $xLang; ?>">
<head>
    @include('part-meta')
    <title>{{ env('APP_NAME') }} - {{ __('main.page_'.Route::getFacadeRoot()->current()->uri()) }}</title>
        @include('part-bootstrap')
        @include('part-jquery')
    @include('part-lastmeta')
<body>
    <div class="pagemain">
        <!-- Logout -->
            <div class="login-logo"><img src="/images/logo.250x58.png" style="border:0px;"></div>
             <div class="login-main" style="height: 200px;padding-left:50px;padding-right:50px;padding-top:80px;">
                <center>{{ __('main.LogoutMsg') }}</center>
            </div> 
    </div>
</body>
</html>
