<!DOCTYPE html>
<html lang="<?php echo $xLang; ?>">
<head>
        @include('part-meta')
    <title>{{ env('APP_NAME') }} - {{ __('main.page_'.Route::getFacadeRoot()->current()->uri()) }}</title>
        @include('part-bootstrap')
        @include('part-lastmeta')
    <?php if (!isset($xMessage_UrlTime)) { $xMessage_UrlTime=-1; }?>
    <?php if ( trim($xMessage_Url)!=='') { echo '<meta http-equiv="refresh" content="'.$xMessage_UrlTime.';url=\''.$xMessage_Url.'\'”>';} else { echo "<!-- Message-->\n";}?>
<body>

    <div class="pagemain">
        
        <!-- Message -->
            <div class="login-logo"><img src="/images/logo.250x58.png" style="border:0px;"><i class="bi bi-exclamation-circle" style="float: right;line-height: 58px;font-size: 40px;color: #686868;padding-top: 5px;padding-right: 2px;"></i></div>
             <div class="login-main" style="height: 200px;padding-left:30px;padding-right:25px;">
                <div id="timer" style="color:red;float: right;line-height: 20px;font-size: 14px;">&nbsp;</div>
                <table width="100%" height="78%" border=0 rules=none cellspacing=0>
                    <tr><td><?php if ($xMessage_Center=='T') {Echo '<center>';}?><?php if ($xMessage_UrlTime>=0) {Echo '<div class="spinner-border text-secondary" role="status" style="width:18px;height:18px;"></div>&nbsp;';}?>{{ $xMessage }}<?php if ($xMessage_Center=='T') {Echo '</center>';}?></td></tr>
                </table>
                <a href="<?php if ( trim($xMessage_Url)=='') { echo '/';} else { echo $xMessage_Url;}  ?>">
                    <i class="bi bi-link-45deg" style="float:left;line-height: 20px;font-size: 18px;"></i></a>
                <a href="{{ __('main.meta_CoUrl') }}" target=_blank >
                    <i class="bi bi-star" style="float:right;line-height: 20px;font-size: 18px;"></i></a>
            </div> 
    </div>

    <!-- 倒计时 -->
    <script type="text/javascript">
        var maxtime = {{$xMessage_UrlTime}};
        function CountDown() {
            if (maxtime <= 0) {
                clearInterval(timer);
            } else {
                --maxtime;
                document.all["timer"].innerHTML = maxtime;
            }
        }
        if (maxtime <= -1) {
            clearInterval(timer);
        } else {
            document.all["timer"].innerHTML = maxtime;
            timer = setInterval("CountDown()", 1000);
        }
    </script>

</body>
</html>
