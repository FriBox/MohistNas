<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;


/* ======  自定义函数 - 用户认证  ====== */
function Chk_Authenticate($cUsername='', $cPassword='') { //检查用户名密码
    $cUsername=trim($cUsername); $cPassword=trim($cPassword);
    if (!preg_match('/^[a-zA-Z]([-_a-zA-Z0-9-_]{2,30})$/',  $cUsername ) ) { return [False,'','','Username Err !']; } //用户名检测不通过
    if (!preg_match('/^[a-zA-Z]([-_a-zA-Z0-9-_]{2,30})$/',  $cPassword ) ) { return [False,'','','Password Err! ']; } //用户名检测不通过
    $Users=posix_getgrnam("MohistNas"); //获取指定用户组用户列表
    if (in_array($cUsername, $Users['members'])) {
        $xU=trim($cUsername);
        $xUser_authenticate_1=`sudo cat /etc/shadow | grep "$xU" | tr -d "\n" ;`; //获取加密的密码;
        $xUser_authenticate_1Key=explode(":",$xUser_authenticate_1)[1]; $xUser_authenticate_1Pass=explode("$",$xUser_authenticate_1Key)[2]; //获取系统中的用户加密密码
        $xUser_authenticate_2Key=exec('sudo mkpasswd -m sha-512 -S "'.$xUser_authenticate_1Pass.'" "'.$cPassword.'" ;'); //计算传入的加密的秘钥;
        //echo 'sudo mkpasswd -m sha-512 -S "'.$xUser_authenticate_1Pass.'" "'.$cPassword.'" ;' ; exit(); //调试用户密码
        if ( trim($xUser_authenticate_1Key)==trim($xUser_authenticate_2Key) ) {
            $zP=''; $zP=strtoupper(hash('sha512', 'MohistNas_Session_Password='.$xUser_authenticate_2Key, $zP));
            return [True,$xU,$zP,'Username and password verification succeeded !']; //用户存在，密码匹配
        } else { return [False,trim($cUsername),'','Username and password verification failed !']; } //用户存在，密码不匹配
    } else { return [False,'','','Username does not exist !']; } //用户不存在
}

function Chk_Authenticate_Session($cUsername='', $cSession_Password='') { //检查来自Session的用户名密码
    $cUsername=trim($cUsername); $cSession_Password=trim($cSession_Password);
    if (!preg_match('/^[a-zA-Z]([-_a-zA-Z0-9-_]{2,30})$/',  $cUsername ) ) { return [False,'','','Username Err !']; } //用户名检测不通过
    if ( $cSession_Password=='' ) { return [False,'','','Password Err! ']; } //用户名检测不通过
    $Users=posix_getgrnam("MohistNas"); //获取指定用户组用户列表
    if (in_array($cUsername, $Users['members'])) {
        $xU=trim($cUsername);
        $xUser_authenticate_1=`sudo cat /etc/shadow | grep "$xU" | tr -d "\n" ;`; //获取加密的密码;
        $xUser_authenticate_1Key=explode(":",$xUser_authenticate_1)[1]; $xUser_authenticate_1Pass=explode("$",$xUser_authenticate_1Key)[2]; //获取系统中的用户加密密码
        $zP=''; $zP=strtoupper(hash('sha512', 'MohistNas_Session_Password='.$xUser_authenticate_1Key, $zP)); //计算系统中的用户加密密码的加密的秘钥;
        if ( trim($zP)==trim($cSession_Password) ) {
            return [True,$xU,$zP,'Username and password verification succeeded !']; //用户存在，密码匹配
        } else { return [False,trim($cUsername),'','Username and password verification failed !']; } //用户存在，密码不匹配
    } else { return [False,'','','Username does not exist !']; } //用户不存在
}

/* ======  自定义函数 - Url获取信息  ====== */
function Get_UrlData($inurl) { //获取指定Url中的信息
    $MN_GetUrl = curl_init();
    curl_setopt($MN_GetUrl, CURLOPT_URL,$inurl);
    curl_setopt($MN_GetUrl, CURLOPT_RETURNTRANSFER,1); //相当关键，这句话是让curl_exec($MN_GetUrl)返回的结果可以进行赋值给其他的变量进行，json的数据操作，如果没有这句话，则curl返回的数据不可以进行人为的去操作（如json_decode等格式操作）
    curl_setopt($MN_GetUrl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($MN_GetUrl, CURLOPT_SSL_VERIFYHOST, false);
    return curl_exec($MN_GetUrl);
}

/* ======  自定义函数 - 获取系统信息  ====== */
function Get_info_All() { //获取所有系统信息
    $HWS['Sys']=Get_info_Sys();
    $HWS['Time']=Get_info_Time();
    $HWS['CpuModel']=Get_info_CpuModel();
    $HWS['CpuState']=Get_info_CpuState();
    $HWS['Mem']=Get_info_Mem();
    $HWS['Net']=Get_info_Net();
    $HWS['Storage']=Get_info_Storage();
    return $HWS;
}

function Get_info_Sys() { //获取系统信息
    $vTHWS=`cat /etc/issue && cat /etc/hostname && uname -s -r -m && systemd-detect-virt && ps -ef | wc -l `;  $vTHWS = explode("\n",$vTHWS); //Linux发行版名称/服务器名称/Linux kernel 信息/系统虚拟化信息/获取当前进程数;
    $HWS['sys-name']=trim(str_replace(array("\r\n", "\r", "\n","\\n","\\l"), "", $vTHWS[0] )); //Linux发行版名称
    $HWS['host-name']=trim($vTHWS[2]).' ('.$_SERVER['SERVER_ADDR'].')'; //服务器名称;
    $HWS['kernel']=trim(str_replace(array("\r\n", "\r", "\n","\\n","\\l"), "", $vTHWS[3] )); //Linux kernel 信息
    $HWS['virtualizer']=trim(str_replace(array("\r\n", "\r", "\n","\\n","\\l"), "", trim($vTHWS[4]) ));  if( strtolower(trim( $HWS['virtualizer'] ))==strtolower('none')  ) { $HWS['virtualizer']=trans('main.txt-v-nonevm'); } //系统虚拟化信息;
    $HWS['processes']=trim($vTHWS[5])-1; //获取当前进程数
    return $HWS;
}

function Get_info_CpuModel() { //获取CPU相关信息
    $vTHWS=`cat /proc/cpuinfo | grep 'model name' |uniq && grep 'core id' /proc/cpuinfo | sort -u |wc -l && grep 'processor' /proc/cpuinfo | sort -u | wc -l `;  $vTHWS = explode("\n",$vTHWS); //CPU名称/核心数/逻辑核心数;
    $HWS['cpu-name']=trim( preg_replace("/\s(?=\s)/","\\1", rtrim(str_replace(array("model name",":"),"",$vTHWS[0])) ) ); //CPU名称;
    $HWS['cpu-corestxt']=trim($vTHWS[1]); //CPU核心数;
    $HWS['cpu-processor']=trim($vTHWS[2]); //CPU逻辑核心数;
    $HWS['cpu-text']=$HWS['cpu-name'].' , '. $HWS['cpu-processor'].' cores'; //CPU详细描述
    return $HWS;
}

function Get_info_CpuState() { //获取CPU使用率
    $xTemp=json_decode( `mpstat  -o JSON -P ALL 1 1 ` ,TRUE ); //CPU名称;
    $HWS['cpu-cores']=$xTemp["sysstat"]['hosts'][0]['number-of-cpus'];
    for ($x=0; $x<=$HWS['cpu-cores']; $x++) {
        if ($x==0) { $xCpuIndex='all';} else { $xCpuIndex=$x-1;}
        if ( round(100-$xTemp["sysstat"]['hosts'][0]['statistics'][0]['cpu-load'][$x]['idle'],1)<0 ) { $HWS['cpu-'.$xCpuIndex]=0; } else { $HWS['cpu-'.$xCpuIndex]=round(100-$xTemp["sysstat"]['hosts'][0]['statistics'][0]['cpu-load'][$x]['idle'],1); }
        $HWS['cpu-'.$xCpuIndex]=$HWS['cpu-'.$xCpuIndex]; $HWS['cpu-'.$xCpuIndex.'-text']=number_format($HWS['cpu-'.$xCpuIndex],1).'%';
    }
    return $HWS;
}

function Get_info_Time() { //获取时间相关信息
    $vTHWS=`date "+%Y-%m-%d %H:%M:%S %z" && uptime -p `;  $vTHWS = explode("\n",$vTHWS); //Linux系统时间/系统运行时间;
    $HWS['sys-timetxt']=trim($vTHWS[0]); //Linux系统时间
    $HWS['sys-uptimetxt']=trim($vTHWS[1]); //系统运行时间
    //获取精确系统运行时间
    $xstr   = @file_get_contents('/proc/uptime'); $xnum   = floatval($xstr);
    $xsecs  = fmod($xnum, 60); $xnum = intdiv($xnum, 60); $xmins  = $xnum % 60; $xnum = intdiv($xnum, 60);
    $xhours = $xnum % 24; $xnum = intdiv($xnum, 24); $xdays  = $xnum;
    $HWS['sys-uptime']=[$xdays,$xhours,$xmins];  $HWS['sys-uptimelang']='';
        if ($xdays>0)  { if ($xdays>1) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xdays.' '.trans('main.txt-v-uptime-ds'); } else { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xdays.' '.trans('main.txt-v-uptime-d'); } }
        if ($xdays!=0) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].trans('main.txt-v-uptime-dss'); }
        if ($xhours>0)  { if ($xhours>1) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xhours.' '.trans('main.txt-v-uptime-hs'); } else { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xhours.' '.trans('main.txt-v-uptime-h'); } }
        if ($xhours!=0) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].trans('main.txt-v-uptime-hss'); }
        if ($xmins>0)  { if ($xmins>1) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xmins.' '.trans('main.txt-v-uptime-ms'); } else { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].' '.$xmins.' '.trans('main.txt-v-uptime-m'); } }
        if ($xmins!=0) { $HWS['sys-uptimelang']=$HWS['sys-uptimelang'].trans('main.txt-v-uptime-mss'); }
        if (trim($HWS['sys-uptimelang'])=='') { $HWS['sys-uptimelang']='...'; }
        $HWS['sys-uptimelang']=trim($HWS['sys-uptimelang']);
        if ( substr($HWS['sys-uptimelang'], -1)==',' ) { $HWS['sys-uptimelang']=trim(substr($HWS['sys-uptimelang'], 0, -1)); }
    return $HWS;
}

function Get_info_Mem() { //获取内存相关信息
    $vTHWS=`cat /proc/meminfo | grep 'MemTotal' | uniq && cat /proc/meminfo | grep 'Cached' | grep -v 'SwapCached' | uniq && cat /proc/meminfo | grep 'Buffers' | uniq && cat /proc/meminfo | grep 'MemFree' | uniq && cat /proc/meminfo | grep 'SwapTotal' | uniq && cat /proc/meminfo | grep 'SwapFree' | uniq `;
    $vTHWS = explode("\n",$vTHWS); //获取内存总数kB/获取内存Cached kB/获取虚拟内存总数kB/获取剩余虚拟内存总数kB;
    $HWS['memtotal']=trim($vTHWS[0]); //获取内存总数kB
        $HWS['memtotal']=trim(str_replace(array("MemTotal",":",'kB'), "", $HWS['memtotal'] ));
        $xMt=$HWS['memtotal'];
        if ($HWS['memtotal']/1024>=1) { $xmemstr='MiB'; $HWS['memtotal']=$HWS['memtotal']/1024; }
        if ($HWS['memtotal']/1024>=1) { $xmemstr='GiB'; $HWS['memtotal']=$HWS['memtotal']/1024; }
        $HWS['memtotal']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['memtotal']), 0, -2));  $HWS['memtotal']=$HWS['memtotal'].' '.$xmemstr;
    $HWS['cached']=trim($vTHWS[1]); //获取内存Cached kB
        $HWS['cached']=trim(str_replace(array("Cached",":",'kB'), "", $HWS['cached'] ));
        $xTmp=trim($vTHWS[2]); //获取内存Buffers kB
        $xTmp=trim(str_replace(array("Buffers",":",'kB'), "", $xTmp ));
        $HWS['cached']=$HWS['cached']+$xTmp;
        if ($HWS['cached']/1024>=1) { $xmemstr='MiB'; $HWS['cached']=$HWS['cached']/1024; }
        if ($HWS['cached']/1024>=1) { $xmemstr='GiB'; $HWS['cached']=$HWS['cached']/1024; }
        $HWS['cached']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['cached']), 0, -2));  $HWS['cached']=$HWS['cached'].' '.$xmemstr;
    $HWS['memfree']=trim($vTHWS[3]); //获取剩余内存总数kB
        $HWS['memfree']=trim(str_replace(array("MemFree",":",'kB'), "", $HWS['memfree'] ));
        $xMf=$HWS['memfree'];
        if ($HWS['memfree']/1024>=1) { $xmemstr='MiB'; $HWS['memfree']=$HWS['memfree']/1024; }
        if ($HWS['memfree']/1024>=1) { $xmemstr='GiB'; $HWS['memfree']=$HWS['memfree']/1024; }
        $HWS['memfree']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['memfree']), 0, -2));  $HWS['memfree']=$HWS['memfree'].' '.$xmemstr;
    $HWS['memused']=$xMt-$xMf; //获取已使用内存kB
        if ($HWS['memused']/1024>=1) { $xmemstr='MiB'; $HWS['memused']=$HWS['memused']/1024; }
        if ($HWS['memused']/1024>=1) { $xmemstr='GiB'; $HWS['memused']=$HWS['memused']/1024; }
        $HWS['memused']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['memused']), 0, -2));  $HWS['memused']=$HWS['memused'].' '.$xmemstr;
    //虚拟内存相关
    $HWS['swaptotal']=trim($vTHWS[4]); //获取虚拟内存总数kB
        $HWS['swaptotal']=trim(str_replace(array("SwapTotal",":",'kB'), "", $HWS['swaptotal'] ));
        $xSt=$HWS['swaptotal'];
        if ($HWS['swaptotal']/1024>=1) { $xmemstr='MiB'; $HWS['swaptotal']=$HWS['swaptotal']/1024; }
        if ($HWS['swaptotal']/1024>=1) { $xmemstr='GiB'; $HWS['swaptotal']=$HWS['swaptotal']/1024; }
        $HWS['swaptotal']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['swaptotal']), 0, -2));  $HWS['swaptotal']=$HWS['swaptotal'].' '.$xmemstr;
    $HWS['swapfree']=trim($vTHWS[5]); //获取剩余虚拟内存总数kB
        $HWS['swapfree']=trim(str_replace(array("SwapFree",":",'kB'), "", $HWS['swapfree'] ));
        $xSf=$HWS['swapfree'];
        if ($HWS['swapfree']/1024>=1) { $xmemstr='MiB'; $HWS['swapfree']=$HWS['swapfree']/1024; }
        if ($HWS['swapfree']/1024>=1) { $xmemstr='GiB'; $HWS['swapfree']=$HWS['swapfree']/1024; }
        $HWS['swapfree']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['swapfree']), 0, -2));  $HWS['swapfree']=$HWS['swapfree'].' '.$xmemstr;
    $HWS['swapused']=$xSt-$xSf; //获取已使用swap kB
        if ($HWS['swapused']/1024>=1) { $xmemstr='MiB'; $HWS['swapused']=$HWS['swapused']/1024; }
        if ($HWS['swapused']/1024>=1) { $xmemstr='GiB'; $HWS['swapused']=$HWS['swapused']/1024; }
        $HWS['swapused']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['swapused']), 0, -2));  $HWS['swapused']=$HWS['swapused'].' '.$xmemstr;
    //获取内存使用率/获取swap使用率
    $xMu=$xMt-$xMf;  $HWS['mem-used']=$xMu/$xMt*100;  $HWS['mem-used']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['mem-used']), 0, -2));  $HWS['mem-used-text']=$HWS['mem-used'].'%';
    $xMu=$xSt-$xSf;  $HWS['swap-used']=$xMu/$xSt*100;  $HWS['swap-used']=sprintf("%.2f",substr(sprintf("%.4f",$HWS['swap-used']), 0, -2));  $HWS['swap-used-text']=$HWS['swap-used'].'%';
    $HWS['mem-memo']="memused + memfree = memtotal / swapused + swapfree = swaptotal";//备注信息
    return $HWS;
}

function Get_info_Net() { //获取网卡流量
    $vFr=strtoupper ( md5 ( uniqid ( rand (), true ) ) ).rand(10000,99999); $vFc=env('MohistNasCmdCache').'Network.'.$vFr.'.cmd'; $vFcPS='Network.'.$vFr.'.'; $vFcS=env('MohistNasCmd_ifstat'); $vFn=env('MohistNasCmdCache').'Network.'.$vFr.'.Status';
    try {
        $vCmd='ln -f -s '.$vFcS.'  '.$vFc.' ; chmod +x '.$vFc.' ; ' ;  $vCmd=`$vCmd`;//删除程序文件链接
        $vCmd='( '.$vFc.' -aTnwq 1 > '.$vFn.' &); sleep 1.4s ; killall -9 '.$vFcPS.' ; '. 'cat '.$vFn.' ; ' ;  $vCmd=`$vCmd`; //获取网卡流量后退出
        $vFlow=explode("\n", $vCmd );
        if ( count($vFlow)>0 ) {
            $vFlow1=$vFlow[0]; //网卡名称
                $vFlow1=explode(" ", $vFlow1 ); $vFlow1 = array_filter($vFlow1); foreach($vFlow1 as $value) { $vvFlow1[] = $value; } $vFlow1=$vvFlow1;
            $vFlow2=$vFlow[1]; //进出流量单位
                $vFlow2=explode(" ", $vFlow2 ); $vFlow2 = array_filter($vFlow2); foreach($vFlow2 as $value) { $vvFlow2[] = $value; } $vFlow2=$vvFlow2;
            $vFlow3=$vFlow[2]; //进出流量
                $vFlow3=trim(str_replace(array("\r\n", "\r", "\n","\\n","\\l"), "", $vFlow3 ));
                $vFlow3=explode(" ", $vFlow3 ); $vFlow3 = array_filter($vFlow3); foreach($vFlow3 as $value) { $vvFlow3[] = $value; } $vFlow3=$vvFlow3;
            $vNCount=count($vFlow1);
            $HWS['Flow']['Count']=$vNCount;
            for ($x=0; $x<$vNCount; $x++) {
                $HWS['Flow'][$vFlow1[$x]]['Name']=$vFlow1[$x]; $HWS['Flow'][$vFlow1[$x]]['Index']=$x;
                $HWS['Flow'][$vFlow1[$x]]['in']=$vFlow3[$x*2].$vFlow2[$x*4]; //入流量(含单位)
                $HWS['Flow'][$vFlow1[$x]]['Flow-'.$vFlow2[$x*4+1]]=$vFlow3[$x*2]; //入流量
                $HWS['Flow'][$vFlow1[$x]]['Rate-'.$vFlow2[$x*4+1]]=$vFlow2[$x*4]; //入单位)
                $HWS['Flow'][$vFlow1[$x]]['out']=$vFlow3[$x*2+1].$vFlow2[$x*4+2]; //出流量(含单位)
                $HWS['Flow'][$vFlow1[$x]]['Flow-'.$vFlow2[$x*4+3]]=$vFlow3[$x*2+1]; //出流量
                $HWS['Flow'][$vFlow1[$x]]['Rate-'.$vFlow2[$x*4+3]]=$vFlow2[$x*4+2]; //出单位)
            }
            $HWS['Flow']['Status']='OK!';
        } else { $HWS['Flow']['Status']='ERR'; }
    } catch (Exception $e) { $HWS['Flow']['Status']='ERR'; }
    $vCmd='chmod 777 '.$vFc.' ; rm -rf '.$vFc.' ; ';  $vCmd=`$vCmd`;  $vCmd='chmod 777 '.$vFn.' ; rm -rf '.$vFn.' ; ';  $vCmd=`$vCmd`; //删除程序文件链接，删除网卡流量信息缓存文件
    //获取网络相关信息
    $HWS['NICs']=`sudo lshw -class network | grep "logical name:" | wc -l`; //获取系统物理网卡数量
    $HWS['NICs']=trim(str_replace(array("\r\n", "\r", "\n","\\n","\\l"), "", trim($HWS['NICs']) ));
    $NetTmp=`sudo lshw -class network;` ; //获取网卡信息
        //$vCmd='sudo lshw -class network > '.env('MohistNasCmdCache').'Network.Log'.' ; ' ;  $vCmd=`$vCmd`;
    try {
        $NetTmp=explode(" *-",$NetTmp);
        for ($x=1; $x<=$HWS['NICs']; $x++) {
            //第一部分，网卡接口类型和是否启用
            $NetVal=explode("\n", $NetTmp[$x] );
            if(strpos( strtolower(trim($NetVal[0])) , strtolower('DISABLED') ) == false){ $HWS['NICs-'.$x-1]['Status']='ENABLED'; } else { $HWS['NICs-'.$x-1]['Status']='DISABLED'; } //网卡启用状态
            //第二部分，网卡基本信息
            $NetValz=substr( $NetTmp[$x] , strlen( $NetVal[0]."\n" ) , -1);
            $str =$NetValz; //开始正则表达式查找
                //logical name: Name 网卡系统名称
                $start = 'logical name:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ( $vTmpr==1 ) { $HWS['NICs-'.$x-1]['Name']=trim($vTmp[1]); } else { $HWS['NICs-'.$x-1]['Name']=''; };
                $vName=$HWS['NICs-'.$x-1]['Name'];
                //vendor: Factory 网卡品牌
                $start = 'vendor:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ( $vTmpr==1 ) { $HWS['NICs-'.$x-1]['Factory']=trim($vTmp[1]); } else { $HWS['NICs-'.$x-1]['Factory']=''; };
                //product: Model 网卡型号
                $start = 'product:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Model']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Model']=''; };
                //serial: Mac 网卡Mac地址
                $start = 'serial:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Mac']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Mac']=''; };
                //capacity: Capacity 网卡最大速率
                $start = 'capacity:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Capacity']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Capacity']=''; };
                //width: Width 网卡位宽
                $start = 'width:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Width']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Width']=''; };
                //clock: Width 网卡时钟频率
                $start = 'clock:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Clock']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Clock']=''; };
                //bus info: Interface 网卡接口类型
                $start = 'bus info:'; $end = "@"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Interface']=strtoupper(trim($vTmp[1])); } else {$HWS['NICs-'.$x-1]['Interface']=''; };
                //网卡详细信息
                $start = 'configuration:'; $end = "\n"; $vTmpr=preg_match( '#'.preg_quote($start).'(.+?)'.preg_quote($end).'#s' , $str,$vTmp);
                if ($vTmpr==1) {$HWS['NICs-'.$x-1]['Cfg']=trim($vTmp[1]); } else {$HWS['NICs-'.$x-1]['Cfg']=''; };
                if ( trim($HWS['NICs-'.$x-1]['Cfg'])!='') {
                    $vTmp=trim($HWS['NICs-'.$x-1]['Cfg']);
                        unset($HWS['NICs-'.$x-1]['Cfg']);
                        $str=$vTmp;
                        $sp=" ";
                        $kv="=";
                        $arr = str_replace(array($kv,$sp),array('"=>"','","'),'array("'.$str.'")');
                        eval("\$arr"." = $arr;");
                        $NetValx=$arr;
                    $HWS['NICs-'.$x-1]['Speed']=trim($NetValx['speed']); //网卡当前速率
                    if(strpos( strtolower(trim( trim($NetValx['link']) )) , strtolower('yes') ) !== false){ $HWS['NICs-'.$x-1]['Link']=true; }else{ $HWS['NICs-'.$x-1]['Link']=false; }//网卡是否连接
                    $HWS['NICs-'.$x-1]['Driver']=trim($NetValx['driver']); //网卡驱动名称
                    $HWS['NICs-'.$x-1]['DriverVer']=trim($NetValx['driverversion']); //网卡驱动版本
                    if(strpos( strtolower(trim( trim($NetValx['autonegotiation']) )) , strtolower('on') ) !== false){ $HWS['NICs-'.$x-1]['Autonegotiation']=true; }else{ $HWS['NICs-'.$x-1]['Autonegotiation']=false; }//网卡是否开启自动协商
                    if(strpos( strtolower(trim( trim($NetValx['duplex']) )) , strtolower('full') ) !== false){ $HWS['NICs-'.$x-1]['Duplex']=true; }else{ $HWS['NICs-'.$x-1]['Duplex']=false; }//网卡是否全双工
                } else {
                    $HWS['NICs-'.$x-1]['Speed']=''; //网卡当前速率
                    $HWS['NICs-'.$x-1]['Link']=''; //网卡是否连接
                    $HWS['NICs-'.$x-1]['Driver']=''; //网卡驱动名称
                    $HWS['NICs-'.$x-1]['DriverVer']=''; //网卡驱动版本
                    $HWS['NICs-'.$x-1]['Autonegotiation']=false; //网卡是否开启自动协商
                    $HWS['NICs-'.$x-1]['Duplex']=false; //网卡是否全双工
                }
            //第三部分，获取网卡IP
            $vCmd='ip addr show '.$vName.' | grep -i -e inet -e inet6 | awk -F \' \' \'{printf $2", "}\' ';  $vCmd=`$vCmd`;
            $HWS['NICs-'.$x-1]['IP']=rtrim(trim($vCmd), ","); //if(array_key_exists("ip",$NetValx)) { $HWS['NICs-'.$x-1]['IP']=trim($NetValx['ip']); } else { $HWS['NICs-'.$x-1]['IP']=''; } //网卡IP
            //该网卡信息结束
            $HWS['NICs-'.$x-1]['End']='[End]';
            //复制网卡信息 
            $HWS[$vName]=$HWS['NICs-'.$x-1];
        }
        $HWS['NIC']['Status']='OK!';
    } catch (Exception $e) {
        $HWS['NIC']['Status']='ERR';
    }
    return $HWS;
}

function Get_info_Storage() { //获取存储相关信息
    $HWS['Storage']="Test";
    return $HWS;
}


/* ======  自定义全局变量  ====== */
global $qLangs; //系统支持的全部语言
    $qLangs=[
        'en' => 'en', //英语
        'zh' => 'zh-CN', 'zhcn' => 'zh-CN', 'zh-cn' => 'zh-CN', 'zh_cn' => 'zh-CN', 'zh_cn' => 'zh-CN', 'chs' => 'zh-CN',
        'zhtw' => 'zh-TW', 'zh-tw' => 'zh-TW', 'zh_tw' => 'zh-TW', 'cht' => 'zh-TW', //繁体中文
        'jp' => 'jp', //日语
        'de' => 'de', //德语
    ];

/* ======  Debug 路由区域  ====== */
global $Debug_getcookie;
    $Debug_getcookie=FALSE;
global $Debug_getsession;
    $Debug_getsession=FALSE;
global $Debug_Test;
    $Debug_Test=FALSE;

Route::get('getcookie', function (Request $request) { //调试输出全部 Cookie
    Session::put('LastRequest',date("Y-m-d H:i:s",time()));
    if ($Debug_getcookie==FALSE) { abort(404); }//默认方式不能输出调试信息;
    return response()->json($request->cookie());//输出页面;
});

Route::get('getsession', function (Request $request) { //调试输出全部 Session
    Session::put('LastRequest',date("Y-m-d H:i:s",time()));
    if ($Debug_getsession==FALSE) { abort(404); }//默认方式不能输出调试信息;
    return response()->json(Session::all());//输出页面;
});

Route::match(['get','post'],'debug', function (Request $request) { //调试内部函数使用
    Session::put('LastRequest',date("Y-m-d H:i:s",time()));
    if ($Debug_Test==FALSE) { abort(404); }//默认方式不能输出调试信息;
    $Data['Text']='Debug';
    return response()->json($Data);//输出页面;
});


/* ======  系统路由区域  ====== */
Route::match(['get','post'],'/', function () { //系统登录页面，处理登录相关功能
    if (trim(Session::get('User',''))=='' or  trim(Session::get('Pass',''))=='') { 
        return redirect('/login'); //无验证信息 , 重定向至登录页面
    } else { 
        return redirect('/index'); //有验证信息 , 重定向至主控制面板
    }
});

Route::get('/lang', function (Request $request) { //设置语言页面，处理设置语言的功能
    $LangValue = $request->input('lang'); if (!isset($LangValue)) {$LangValue = $request->input('l', 'en'); } //get和post一起取，同名post覆盖get;
    $LangValue = strtolower(trim($LangValue)); global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); }//设置语言
    $LangValue = App::getLocale(); Session::put('Lang',$LangValue); //设置Session->Lang; //其他: Session::forget(['key1', 'key2']); //删除多个Session;
    Cookie::queue('Lang', $LangValue,60*24*365*1); //设置Cookie->Lang，参数格式：$name, $value, $minutes;
    Session::put('Lang',$LangValue); //设置Session->Lang;
    Session::put('LastRequest',date("Y-m-d H:i:s",time())); /*[End]*/
    return response()->json(['Lang' =>$LangValue]); //输出页面;
});

Route::get('/message', function (Request $request) { //显示提示信息
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) { $LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
    /* ====== 处理路由 Begin ====== */
    $Message = $request->input('mid'); //get和post一起取，同名post覆盖get;
    if (!isset($Message)) {$Message = $request->input('m', '000000');}
    $Data['xMessage']=trans('main.Message_'.$Message);
    $Data['xMessage_Center']='F'; //文字左对齐
    $Data['xMessage_UrlTime']=-1; //不倒计时
    $Data['xMessage_Url']='';
    if (strtolower(trim($Data['xMessage']))==strtolower(trim('main.Message_'.$Message))) { $Data['xMessage']=trans('main.Message_000000'); }
    return view('message',$Data); //输出页面;
});

Route::get('/logout', function (Request $request) { //登出系统
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); /*[End]*/
    /* ====== 处理路由 Begin ====== */
    $Data['xMessage']=trans('main.LogoutMsg');
    $Data['xMessage_Center']='T'; //文字中间对齐
    $Data['xMessage_UrlTime']=3;
    $Data['xMessage_Url']='/';
    Log::info('Logout');
    Session::forget(['User','Pass']); return view('message',$Data); //输出页面;
});

Route::get('/reboot', function (Request $request) { //重启系统
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    /* ====== 处理路由 Begin ====== */
    $Data['xMessage']=trans('main.RebootMsg');
    $Data['xMessage_Center']='T'; //文字中间对齐
    $Data['xMessage_UrlTime']=60; //倒计时60秒
    $Data['xMessage_Url']='/';
    Log::info('Reboot');
    system("nohup sudo shutdown -r now > /dev/null &"); return view('message',$Data); //输出页面;
});

Route::get('/shutdown', function (Request $request) { //关闭系统
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue)); global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    /* ====== 处理路由 Begin ====== */
    $Data['xMessage']=trans('main.ShutdownMsg');
    $Data['xMessage_Center']='T'; //文字中间对齐
    $Data['xMessage_UrlTime']=8; //倒计时8秒
    $Data['xMessage_Url']='/';
    Session::forget(['User','Pass']);
    Log::info('Shutdown');
    system("nohup sudo shutdown -h now > /dev/null &"); return view('message',$Data); //输出页面;
});

Route::match(['get','post'],'/getapi',function(Request $request){ //系统登录页面，处理登录相关功能
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());/*[End]*/
    /* ====== 处理路由 Begin ====== */
    $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
    if ( $xU.$xP=='' ) { $Data['API']=''; $Data['[OK!]']=-1; } //无登录信息，输出空数据
    else {
        $AValue = $request->input('API'); if (!isset($AValue)) {$AValue = $request->input('A', ''); } //get和post一起取，同名post覆盖get;
        if(strpos(strtolower($AValue),strtolower('[Sys]'))!== false) {  $Data['Sys']=Get_info_Sys(); }
        if(strpos(strtolower($AValue),strtolower('[Time]'))!== false) {  $Data['Time']=Get_info_Time(); }
        if(strpos(strtolower($AValue),strtolower('[CpuModel]'))!== false) {  $Data['CpuModel']=Get_info_CpuModel(); }
        if(strpos(strtolower($AValue),strtolower('[CpuState]'))!== false) {  $Data['CpuState']=Get_info_CpuState(); }
        if(strpos(strtolower($AValue),strtolower('[Mem]'))!== false) {  $Data['Mem']=Get_info_Mem(); }
        if(strpos(strtolower($AValue),strtolower('[Net]'))!== false) {  $Data['Net']=Get_info_Net(); }
        if(strpos(strtolower($AValue),strtolower('[Storage]'))!== false) {  $Data['Storage']=Get_info_Storage(); }
        $Data['[OK!]']=0;
        $Data['API']=trim($AValue);
        if ( $Data['API']=='' ) { $Data['[OK!]']=-1; } //参数错误，输出空数据
    }
    return response()->json($Data); //输出页面;
})->name('getapi');

Route::match(['get','post'],'/login',function(Request $request){ //系统登录页面，处理登录相关功能
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
    /* ====== 处理路由 Begin ====== */
    $Data['xUser_authenticate']=''; $Data['xErr']=''; $Data['xOldUser']=''; Session::forget(['User', 'Pass']);
    if ($request->isMethod('get')) { return view('login',$Data); } 
    elseif($request->isMethod('post')){
        //检验登录信息 <<<=== /Login Post ===
        $xU=trim($request->request->get('vUser','')); $xP=trim($request->request->get('vPass', ''));
        if ( $xU=='' or $xP=='' ) { $Data['xErr']=trans('main.UPValidation1'); return view('login',$Data); } //用户名密码错误, 输出错误页面;
        $xV=Chk_Authenticate($xU,$xP);
        if ($xV[0]==false) {
            if (trim($xV[1])!='') {$Data['xOldUser']=trim($xV[1]);} //用户名存在就保留用户名，如果考虑避免被试探用户名是否在MohistNas组，可注释此行！
            $Data['xErr']=trans('main.UPValidation2'); return view('login',$Data); //用户名密码验证失败
        } else {
            //写入登录完成的信息 >>>
            $Data['xUser_authenticate']='OK!'; //密码正确;
            Session::put('User',$xV[1]); Session::put('Pass',$xV[2]); //设置 Session->zUser; Session->zPass;
            Log::info('Login');
            return redirect('/index'); //完成验证，重定向至主控制面板 >>>
            //用户名密码验证成功！
        }
        Session::forget(['User', 'Pass']); return response('Post /Login', 200); //输出页面; 
    }
})->name('login');

Route::get('/gologout', function (Request $request) {   //登出页面
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    //密码验证正确，开始输出控制面板 ===>>>
    Log::info('GoLogout');
    Session::forget(['User','Pass']); 
    $Data['xUser']=trim($xV[1]); return view('gologout',$Data); //输出页面;
});

Route::get('/index', function (Request $request) { //系统首页
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    //密码验证正确，开始输出控制面板 ===>>>
    //$HW=Get_phpSysinfo($hosturl=URL::secureAsset(''),$decode=true);
    $Data['xSysInfo']=Get_info_All();
    Log::info('Dashboard');
    $Data['xUser']=trim($xV[1]); return view('index',$Data); //输出页面;
});

Route::get('/log', function (Request $request) {   //日志页面
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    //密码验证正确，开始输出控制面板 ===>>>
    Log::info('Log');
    $Data['xUser']=trim($xV[1]); return view('log',$Data); //输出页面;
});

Route::get('/about', function (Request $request) {   //关于页面
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue));  global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    //密码验证正确，开始输出控制面板 ===>>>
    Log::info('About');
    $Data['xUser']=trim($xV[1]); return view('about',$Data); //输出页面;
});

Route::get('/preferences', function (Request $request) {   //首选项页面
        /* --- 设置语言[Begin] --- */
        $LangValue = $request->cookie('Lang'); //读取Cookie中的Lang;
        if (!isset($LangValue)) {$LangValue = Session::get('Lang','en'); } //如果Cookie未设置就读取Session中的Lang;
        $LangValue = strtolower(trim($LangValue)); global $qLangs;  if (isset($qLangs[$LangValue])) { App::setLocale($qLangs[$LangValue]); } else { App::setLocale('en'); } //设置语言
        $Data['xLang']=App::getLocale(); $Data['xUri']=trim(Route::getFacadeRoot()->current()->uri()); $Data['xUrl']=trim($request->fullUrl()); $Data['xReferer']=trim(request()->headers->get('referer')); $Data['xClientIP']=trim($request->ip());
        $Data['xLastRequest']=date("Y-m-d H:i:s",time()); Session::put('LastRequest',$Data['xLastRequest']);/*[End]*/
        /* --- 判断是否登录成功[Begin] --- */
        $xU=trim(Session::get('User','')); $xP=trim(Session::get('Pass',''));
        $xV=Chk_Authenticate_Session($xU,$xP); if ($xV[0]==false) { Session::forget(['User','Pass']); return redirect('/login'); /* 用户名密码验证失败 , 重定向至登录页面; */ }
    //密码验证正确，开始输出控制面板 ===>>>
    Log::info('Preferences');
    $Data['xUser']=trim($xV[1]); return view('preferences',$Data); //输出页面;
});

/* ======  [ END ]  ====== */
