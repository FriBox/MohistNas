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
        <!-- Login -->

            <div class="login-logo"><img src="/images/logo.250x58.png" style="border:0px;"></div>
            
            <script type="text/javascript">
                function SwitchLang() {
                    //切换语言
                    var xUrl = window.location.protocol+'//'+window.location.host+'/lang';
                    var xLang = document.getElementById("form-Lang").value;
                    var nLang = "<?php echo $xLang; ?>";
                    if (xLang.toLowerCase()==nLang.toLowerCase()) { return false; exit(); }
                    $.ajax(
                    { type: "GET", url:  xUrl, async : false , data: {"l":xLang},//传入后台
                    success: function(result) {
                        window.location.reload();
                        return true;
                        exit();
                    }, error:function(){ return false; exit(); }
                    })
                  return true;
                }

                function check_vUser() {
                    //检查用户名
                    var xText= document.getElementById("LoginErrorText");
                    var OutPutK= document.getElementById("vUser");
                    var OutPut = OutPutK.value;
                    var reg = /^[a-zA-Z]([-_a-zA-Z0-9-_]{2,30})$/; //字母开头，大小写英文加数字加横线和下划线，长度3到30。
                    if(!reg.test(OutPut)){
                        xText.innerHTML = "{{ __('main.UsernameValidation') }}";
                        //if  (OutPut.replace(/(^\s*)|(\s*$)/g, "")=='') {xText.innerHTML = '';}
                        return false; exit();//输入用户名错误
                    } else {
                        xText.innerHTML =""; return true;
                    }
                }

                function check_vPass() {
                    //检查密码
                    var xText= document.getElementById("LoginErrorText");
                    var OutPutK= document.getElementById("vPass");
                    var OutPut = OutPutK.value;
                    var reg = /^[a-zA-Z]([-_a-zA-Z0-9-_]{2,30})$/; //字母开头，大小写英文加数字加横线和下划线，长度3到30。
                    if(!reg.test(OutPut)){
                        xText.innerHTML = "{{ __('main.PasswordValidation') }}";
                        //if  (OutPut.replace(/(^\s*)|(\s*$)/g, "")=='') {xText.innerHTML = '';}
                        return false; exit();//输入密码错误
                    } else {
                        xText.innerHTML =""; return true;
                    }
                }

                function login() {
                    //提交用户名密码
                    flag=false;
                    OutPutV_A=check_vUser();
                    if (OutPutV_A==false) {
                        return false; exit();
                    }
                    OutPutV_B=check_vPass();
                    if (OutPutV_B==false) {
                        return false; exit();
                    }
                    if (OutPutV_A==true && OutPutV_B==true) {
                        return true;
                    } else {
                        return false; exit();//数据提交错误
                    }
                }
            </script>

            <div class="login-main">
                <form name="LoginForm" action="/login" method="post" onsubmit="return login(this);">
                    <div class="login-from">
                            @csrf
                            <p class="form-label"><i class="bi bi-person"></i>&nbsp;{{ __('main.Username') }}:</p>
                            <input type="text" name="vUser" id="vUser" class="form-control" maxlength="30" onfocusout="check_vUser();" title="{{ __('main.UsernameHint') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" value="{{ $xOldUser }}" placeholder=""><br>
                            
                            <p class="form-label"><i class="bi bi-key"></i>&nbsp;{{ __('main.Password') }}:</p>
                            <input type="password" name="vPass" id="vPass" class="form-control" onfocusout="check_vPass();" title="{{ __('main.PasswordHint') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" maxlength="30" value="" placeholder=""><br>

                            <p class="form-label"><i class="bi bi-globe2">&nbsp;</i>{{ __('main.SwitchLang') }}:</p>
                            <select id="form-Lang" class="form-select" aria-label="{{ __('main.SwitchLang') }}" style="width:200px;display:inline-block;margin-top: 2px;" onchange="SwitchLang()" title="{{ __('main.SwitchLang') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" >
                                <option value="zh-CN" <?php if($xLang=='zh-CN') echo 'selected'; ?>>简体中文</option>
                                <option value="zh-TW" <?php if($xLang=='zh-TW') echo 'selected'; ?>>繁體中文</option>
                                <option value="jp" <?php if($xLang=='jp') echo 'selected'; ?>>日本语</option>
                                <option value="en" <?php if($xLang=='en') echo 'selected'; ?>>English</option>
                                <option value="de" <?php if($xLang=='de') echo 'selected'; ?>>German</option>
                            </select>

                            <button type="submit" name="LoginRun" id="LoginRun" class="btn btn-outline-dark" style="float:right;margin-top:1px;padding-left:12px;padding-right:12px;" ><i class="bi bi-check-circle"></i>&nbsp;&nbsp;{{ __('main.Login') }}</button>
                            <br>

                            <p id="LoginErrorText" class="LoginErrorText" name="LoginErrorText" ><b>{{$xErr}}</b></p>

                    </div>
                </form>
            </div> 
            <div class="login-Copyright">
                <span class="login-Copyright-txt">{{ __('main.meta_Copyright') }}</span>
                <a href="{{ __('main.meta_CoUrl') }}" target=_blank ><i class="bi bi-star" style="font-size:18px;line-height:20px;float:right;padding-right:5px;"  title="{{ __('main.meta_CoUrl') }}" data-bs-toggle="tooltip" data-bs-placement="left"></i></a>
            </div>
                
    </div>

    <script type="text/javascript">
        //显示tooltip
        var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    
</body>
</html>
