@include('part-top')

    <!-- GoLogout 登出系统 -->
    <script type="text/javascript">
        setTimeout( function(){ window.location.href="/logout" }, 3000 );
    </script>
    <div class="login-main" style="height:300px;padding-left:30px;padding-right:25px; transform: translateY(50%);">
        <table width="100%" height="100%" border=0 rules=none cellspacing=0>
            <tr><td style="text-align:center;">{{ __('main.menu_gologout') }} ...</td></tr>
        </table>    
    </div> 

@include('part-bottom')
