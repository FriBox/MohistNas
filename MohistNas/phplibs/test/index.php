<?php
    //echo phpinfo();
    error_reporting(E_ALL); ini_set("display_errors", "On");//显示错误信息 

    function getUrlData($inurl){
        //获取指定Url中的信息
        $MN_GetUrl = curl_init();
        curl_setopt($MN_GetUrl, CURLOPT_URL,$inurl);
        curl_setopt($MN_GetUrl, CURLOPT_RETURNTRANSFER,1); //相当关键，这句话是让curl_exec($MN_GetUrl)返回的结果可以进行赋值给其他的变量进行，json的数据操作，如果没有这句话，则curl返回的数据不可以进行人为的去操作（如json_decode等格式操作）
        curl_setopt($MN_GetUrl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($MN_GetUrl, CURLOPT_SSL_VERIFYHOST, false);
        return curl_exec($MN_GetUrl);
    }

    function MN_getStatus($decode=true){
        //获取系统硬件信息
        $MN_Status=getUrlData("https://localhost:6888/phpsysinfo/xml.php?plugin=complete&json");
        if ($decode==true) { $MN_Status=json_decode($MN_Status); }
        return $MN_Status;
    }


    echo (MN_getStatus($decode=false));

    //error_reporting(E_ALL); //显示所有错误信息

?>