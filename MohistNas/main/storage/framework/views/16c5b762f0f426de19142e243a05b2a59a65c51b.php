<?php echo $__env->make('part-top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $CsT='';$CsV=''; for ($x=0; $x<$xSysInfo['CpuState']['cpu-cores']; $x++) { $CsT=$CsT.'"'.__("main.txt-v-cpus-text").' '.($x+1).'",'; $CsV=$CsV.' 0, '; }; $CsT=trim($CsT); $CsV=trim($CsV); ?>
    <div class="container-fluid"><div class="row"><!--  行1 Begin -->
        <!-- 1.系统信息 -->
        <div class="col-xl-6"> <center><div class="Panel1">
            <div class="PanelTitle"><span><?php echo e(__('main.txt-SysMsg')); ?></span><span id="Sys_spinner" class="spinner-grow float-end" style="width:6px;height:6px;margin-right:10px;margin-top:8px;visibility:hidden;"></span></div>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-host-name')); ?></span>&nbsp;:&nbsp;<span id='Sys_host-name'><?php echo e($xSysInfo['Sys']['host-name']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-sys-name')); ?></span>&nbsp;:&nbsp;<span id='Sys_sys-name'><?php echo e($xSysInfo['Sys']['sys-name']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-kernel')); ?></span>&nbsp;:&nbsp;<span id='Sys_kernel'><?php echo e($xSysInfo['Sys']['kernel']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-cpu-text')); ?></span>&nbsp;:&nbsp;<span id='Cpu_cpu-text'><?php echo e($xSysInfo['CpuModel']['cpu-text']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-memory-text')); ?></span>&nbsp;:&nbsp;<span id='Mem_memtext'><?php echo e($xSysInfo['Mem']['memtotal']); ?>&nbsp;&nbsp;(&nbsp;<?php echo e(__('main.txt-v-swap-text')); ?>&nbsp;:&nbsp;<?php echo e($xSysInfo['Mem']['swaptotal']); ?>&nbsp;)</span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-uptime-text')); ?></span>&nbsp;:&nbsp;<span id='Time_sys-uptimelang'><?php echo e($xSysInfo['Time']['sys-uptimelang']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName" ><?php echo e(__('main.txt-v-virtualizer-text')); ?></span>&nbsp;:&nbsp;<span id='Sys_virtualizer'><?php echo e($xSysInfo['Sys']['virtualizer']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-processes-text')); ?></span>&nbsp;:&nbsp;<span id='Sys_processes'><?php echo e($xSysInfo['Sys']['processes']); ?></span></p>
            <p class="PanelTextLine"><span class="PanelTextName"><?php echo e(__('main.txt-v-networkcounts-text')); ?></span>&nbsp;:&nbsp;<span id='Net_NICs'><?php echo e($xSysInfo['Net']['NICs']); ?></span></p>
        </div></center> </div>
        <!-- 2.存储信息 -->
        <div class="col-xl-6"> <center><div class="Panel1">
            <div class="PanelTitle"><span><?php echo e(__('main.txt-StorageMsg')); ?></span><span id="Storage_spinner" class="spinner-grow float-end" style="width:6px;height:6px;margin-right:10px;margin-top:8px;visibility:hidden;"></span></div>
                <div class="container-sm" style="padding-top:5px;">

                        <div class="row" id="NetTest" style="padding-top:5px;text-align:left;font-Size:9px;">
                            A
                        </div>

                        <div class="row">
                            B
                        </div>

                </div>
        </div></center> </div>
    </div></div><!--  行1 End -->

    <div class="container-fluid"> <div class="row"><!--  行2 Begin -->
        <!-- 3.CPU和内存信息 -->
        <div class="col-xl-6"><center><div class="Panel2">
                <div class="PanelTitle"><span><?php echo e(__('main.txt-CPUMemoryMsg')); ?></span><span id="CAndM_spinner" class="spinner-grow float-end" style="width:6px;height:6px;margin-right:10px;margin-top:8px;visibility:hidden;"></span></div>
                <div class="container-sm" style="padding-left:0px;padding-right:0px;padding-top:5px;">
                    <!-- CPU仪表盘 -->
                    <div class="row" style="padding-top:12px;">
                        <div class="col-sm" style="padding-right:0px;"><!-- CPU使用率 -->
                            <div class="container-sm"  style="padding-left:0px;padding-right:0px;"> <div class="row"><div id="EC_CPU" style="height:170px;width:190px;margin: 0 auto;"></div></div> </div>
                        </div>
                        <div class="col-sm" style="padding-left:0px;padding-right:0px;"><!-- 内存使用率 -->
                            <div class="container-sm" style="padding-left:0px;padding-right:0px;"> <div class="row"><div id="EC_MEM" style="height:170px;width:190px;margin: 0 auto;"></div></div> </div>
                        </div>
                        <div class="col-sm" style="padding-left:0px;padding-right:0px;">
                            <div class="container-sm" style="padding-left:12px;padding-right:12px;height:170px;display:flex;flex-direction:column;justify-content:center;text-align:center;"><div class="row justify-content-center" style="min-height:85px;font-Size:11px;" >
                                    <div class="row" style="padding-left:0px;padding-right:0px;padding-top:10px;">
                                        <div class="col-auto" style="min-width:68px;padding:0px;text-align:left;"><?php echo e(__('main.txt-v-memory-text')); ?>&nbsp;:&nbsp;</div>
                                        <div class="col-auto" style="min-width:75px;padding:0px;text-align:left;padding-bottom:4px;"><div  id=Mt >&nbsp;</div></div>
                                    </div>
                                    <div class="row" style="padding-left:0px;padding-right:0px;">
                                        <div class="col-auto" style="min-width:68px;padding:0px;text-align:left;"><?php echo e(__('main.txt-v-memfree')); ?>&nbsp;:&nbsp;</div>
                                        <div class="col-auto" style="min-width:75px;padding:0px;text-align:left;padding-bottom:4px;"><div  id=Mf >&nbsp;</div></div>
                                    </div>
                                    <div class="row" style="padding-left:0px;padding-right:0px;">
                                        <div class="col-auto" style="min-width:68px;padding:0px;text-align:left;"><?php echo e(__('main.txt-v-memused')); ?>&nbsp;:&nbsp;</div>
                                        <div class="col-auto" style="min-width:75px;padding:0px;text-align:left;padding-bottom:4px;"><div id=Mu >&nbsp;</div></div>
                                    </div>
                            </div></div>
                        </div>
                    </div>
                    <!-- CPU柱状图 -->
                    <div class="row"  style="padding-top:10px;">
                        <div id="EC_CPUs" style="height:160px;margin: 0 auto;"></div>
                    </div>

                </div>
        </div></center> </div>
        <!-- 4.网络信息 -->
        <div class="col-xl-6"> <center><div class="Panel2">
            <div class="PanelTitle"><span><?php echo e(__('main.txt-NetMsg')); ?></span><span id="Net_spinner" class="spinner-grow float-end" style="width:6px;height:6px;margin-right:10px;margin-top:8px;visibility:hidden;"></span></div>
                <div class="container-sm" style="padding-top:5px;text-align:left;font-Size:11px;" id="networks" >
                    <?php 
                        if ( $xSysInfo['Net']['NICs']<2 ) { $NetTH="155px"; } else { $NetTH="98px"; }
                        echo "\r\n";
                        for ($x=0; $x<=$xSysInfo['Net']['NICs']-1; $x++) {
                            echo '                    <div class="row" ><div id="network-Title-'.$x.'" style="color: #383838;letter-spacing:-0.3px;padding-left:2px;font-Size:13px;font-weight: 550;overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">'.$xSysInfo['Net']['NICs-'.$x]['Name'].' : '.$xSysInfo['Net']['NICs-'.$x]['Speed'].' '.$xSysInfo['Net']['NICs-'.$x]['Factory'].' - '.$xSysInfo['Net']['NICs-'.$x]['Model'].'</div><div id="network-'.$x.'" style="height:'.$NetTH.';padding-left:2px;padding-right:2px;padding-bottom:8px"></div></div> ';
                            echo "\r\n";
                        } 
                    ?>
                    <div class="row" ><div id="network-Title-Total" style="color: #383838;padding-left:2px;font-Size:13px;font-weight: 550;overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo e(__('main.txt-v-NetTotal')); ?></div><div id="network-Total" style="height:<?php echo e($NetTH); ?>;padding-left:2px;padding-right:2px;"></div></div>

                </div>
        </div></center> </div>
    </div></div><!--  行2 End -->

    <!--  仪表盘JS -->
    <script src="/js/echarts.min.js"></script>
    <script type="text/javascript">
        // 处理器使用率仪表
        var CpuCharts = echarts.init(document.getElementById('EC_CPU'));
        var option1;
        option1 = {
            series: [{ type: 'gauge',
                axisLine: {
                    lineStyle: { width: 20, color: [[0.3, '#67e0e3'], [0.7, '#37a2da'], [1, '#fd666d']] }
                },
                pointer: {
                    itemStyle: { color: 'auto' }, width: 4
                },
                axisTick: {
                    distance: -8, length: 10, lineStyle: { color: '#fff', width: 1 }
                },
                splitLine: {
                    distance: -20, length: 20, lineStyle: { color: '#fff', width: 2 }
                },
                axisLabel: {
                    color: 'auto', distance: -14, fontSize: 9
                },
                progress: {
                    show: true, width: 7, roundCap: true,
                    itemStyle: { color: [[0.3, '#67e0e3'], [0.7, '#37a2da'], [1, '#fd666d']], shadowColor: '#888888)', shadowBlur: 8, shadowOffsetX: 1, shadowOffsetY: 1 }
                },
                detail: {
                    offsetCenter: [0, '92%'], valueAnimation: true, formatter: '{value}%\n<?php echo e(__('main.txt-v-cpua-text')); ?>', color: '#383838', fontSize: 15
                },
                data: [{ value: 0 }]
            }]
        };
        if (option1 && typeof option1 === 'object') { CpuCharts.setOption(option1);  }; //绑定图表配置

        //内存使用率仪表
        var MemCharts = echarts.init(document.getElementById('EC_MEM'));
        var option2;
        option2 = {
            series: [{ type: 'gauge',
                axisLine: {
                    lineStyle: { width: 20, color: [[0.3, '#67e0e3'], [0.7, '#37a2da'], [1, '#fd666d']] }
                },
                pointer: {
                    itemStyle: { color: 'auto' }, width: 4
                },
                axisTick: {
                    distance: -8, length: 10, lineStyle: { color: '#fff', width: 1 }
                },
                splitLine: {
                    distance: -20, length: 20, lineStyle: { color: '#fff', width: 2 }
                },
                axisLabel: {
                    color: 'auto', distance: -14, fontSize: 9
                },
                progress: {
                    show: true, width: 7, roundCap: true,
                    itemStyle: { color: [[0.3, '#67e0e3'], [0.7, '#37a2da'], [1, '#fd666d']], shadowColor: '#888888)', shadowBlur: 8, shadowOffsetX: 1, shadowOffsetY: 1 }
                },
                detail: {
                    offsetCenter: [0, '92%'], valueAnimation: true, formatter: '{value}%\n<?php echo e(__('main.txt-v-mema-text')); ?>', color: '#383838', fontSize: 15
                },
                data: [{ value: 0 }]
            }]
        };
        if (option2 && typeof option2 === 'object') { MemCharts.setOption(option2);  }; //绑定图表配置

        //多核使用率柱状图
        var CPUsCharts = echarts.init(document.getElementById('EC_CPUs'));
        var option3;
        option3 = {
            xAxis: {
                type: 'category',
                data: [<?php echo $CsT; ?>],
                axisTick: { alignWithLabel: true },
                axisLabel:{ rotate:50 ,fontSize: 9 }
            },
            grid: { top: '12px', left: '5px', right: '8px', bottom: '0px', containLabel: true },
            dataZoom: [ { type: 'inside' } ],
            yAxis: { type: 'value', min: 0, max: 100 },
            series: [{
                data: [<?php echo $CsV; ?>], type: 'bar', showBackground: true, backgroundStyle: { color: 'rgba(180, 180, 180, 0.2)' }, barMaxWidth: 32,
                itemStyle: {
                    normal: {
                        color: function(params) {
                            var index_color = params.value;
                            if (index_color >= 70) { return '#fd666d'; } else if (index_color >= 30 && index_color < 70) { return '#37a2da'; } else { return '#67e0e3'; }
                        }
                    }
                }
            }]
        };
        if (option3 && typeof option3 === 'object') { CPUsCharts.setOption(option3);  }; //绑定图表配置
        //网卡流量图表
        var NetTt=[]; for (var i=0;i<30 ;i++) { NetTt.push(""); }; 
        var NetTd=[]; var NetTu=[]; for (var i=0;i<30 ;i++) { NetTd.push(0); };  for (var i=0;i<30 ;i++) { NetTu.push(0); };
        var NetChartsTotal = echarts.init(document.getElementById('network-Total'));
        var option4;
        option4 = {
            animation: false, backgroundColor: '#f8f8f8', title: { text: '<?php echo e(__("main.txt-v-NetinTxt")); ?> : 0.00KB/s , <?php echo e(__("main.txt-v-NetoutTxt")); ?> : 0.00KB/s', left:"16px", x: 'left', textStyle: { fontSize: 12 ,  fontWeight: 400 } },
            legend: { data: ['<?php echo e(__('main.txt-v-Netin')); ?>', '<?php echo e(__('main.txt-v-Netout')); ?>' ], textStyle: { fontSize: 12 } , right:'30px' },
            grid: { left:'20px', right: '18px', top: '30px', bottom: '3px', containLabel: true },
            xAxis: { type: 'category', boundaryGap: false, axisLabel: { rotate: 50, fontSize: 9 ,interval: 0 }, data: NetTt },
            yAxis: [ 
                { name: '<?php echo e(__('main.txt-v-Netinflow')); ?>', nameTextStyle: { padding: [0, 0, -14, 65] , fontSize:10 } , splitNumber: 4, minInterval:1000, min:0 , max:500, type: 'value', axisLabel:{fontSize: 9 , formatter:'{value} KB/s' } } , 
                { name: '<?php echo e(__('main.txt-v-Netoutflow')); ?>', nameTextStyle: { padding: [0, 0, -14, -70] , fontSize:10 } , splitNumber: 4 , minInterval:1000, min:0 , max:500, nameLocation: 'start', alignTicks: true, type: 'value', inverse: true, axisLabel:{fontSize: 9 , formatter:'{value} KB/s' } }   ],
            series: [
                { name: '<?php echo e(__('main.txt-v-Netin')); ?>', type: 'line', smooth: true, symbol: 'none', areaStyle: {}, itemStyle: { color: '#EE9494',opacity: 0.3 }, data: NetTd },
                { name: '<?php echo e(__('main.txt-v-Netout')); ?>', yAxisIndex:1 , type: 'line', smooth: true, symbol: 'none', areaStyle: {}, itemStyle: { color: '#A3D3E8' }, data: NetTu}  ] 
        };
        if (option4 && typeof option4 === 'object') { NetChartsTotal.setOption(option4);  }; //绑定图表配置
        
        <?php 
            //动态添加单个网卡流量图表
            echo "\r\n";
            $NetChartsResize=''; 
            for ($x=0; $x<=$xSysInfo['Net']['NICs']-1; $x++) {
                echo "         //网卡".$x."流量图表\r\n";
                echo '         var NetTd'.$x.'=[]; var NetTu'.$x.'=[];  for (var i=0;i<30 ;i++) { NetTd'.$x.'.push(0); };  for (var i=0;i<30 ;i++) { NetTu'.$x.'.push(0); };  ' ;
                echo "\r\n";
                echo "         var NetCharts".$x." = echarts.init(document.getElementById('network-".$x."')); \r\n";
                echo "         if (option4 && typeof option4 === 'object') { NetCharts".$x.".setOption(option4);  }; //绑定图表配置 \r\n";
                $NetChartsResize=$NetChartsResize."NetCharts".$x.".resize(); ";
                echo "\r\n\r\n";
            } 
        ?>
        //添加响应窗口resize
        window.addEventListener('resize',function () {  
            CpuCharts.resize(); MemCharts.resize(); CPUsCharts.resize(); 
            NetChartsTotal.resize();  <?php echo e($NetChartsResize); ?>

        } );
    </script>

    <!--  读取数据JS -->
    <script type=text/javascript>
        function RefreshStatusSys(){ //获取网络信息
            document.getElementById("Sys_spinner").style.visibility="visible";
                $.ajax( { type: "POST", url: '/getapi' , async : true ,  data: {"API":"[Sys][Time]",'_token':'<?php echo e(csrf_token()); ?>' },//传入后台
                    success: function(result) {  //alert(result); //调试输出服务器返回信息
                        if (result["[OK!]"]==0) {  //console.log(result["API"]);
                            document.getElementById("Time_sys-uptimelang").innerHTML=result["Time"]["sys-uptimelang"];//运行时间
                            document.getElementById("Sys_processes").innerHTML=result["Sys"]["processes"];//进程数
                            return ;
                        } 
                    }, error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(textStatus,":",errorThrown);
                    }
                });
            setTimeout( function(){document.getElementById("Sys_spinner").style.visibility="hidden";} , 250 );
        }

        function RefreshStatusStorage(){ //获取存储信息
            document.getElementById("Storage_spinner").style.visibility="visible";
                $.ajax( { type: "POST", url: '/getapi' , async : true ,  data: {"API":"[Storage]",'_token':'<?php echo e(csrf_token()); ?>' },//传入后台
                    success: function(result) {  //alert(result); //调试输出服务器返回信息
                        if (result["[OK!]"]==0) {  //console.log(result["API"]);
                            //这里插入存储信息相关代码
                            return ;
                        } 
                    }, error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(textStatus,":",errorThrown);
                    }
                });
            setTimeout( function(){document.getElementById("Storage_spinner").style.visibility="hidden";} , 250 );
        }

        function RefreshStatusCM(){ //获取CPU和内存信息
            var xCPUa=0; var xMEMa=0; var xCPUs=0; var xCPUs1=[]; var xCPUs2=[];
            document.getElementById("CAndM_spinner").style.visibility="visible";
                $.ajax( { type: "POST", url: '/getapi' , async : true ,  data: {"API":"[CpuState][Mem]",'_token':'<?php echo e(csrf_token()); ?>' },//传入后台
                    success: function(result) {  //alert(result); //调试输出服务器返回信息
                        if (result["[OK!]"]==0) {  //console.log(result);
                            document.getElementById("Mt").innerHTML=result["Mem"]["memtotal"];//物理内存
                            document.getElementById("Mf").innerHTML=result["Mem"]["memfree"];//可用内存
                            document.getElementById("Mu").innerHTML=result["Mem"]["memused"];//已用内存
                            document.getElementById("Mem_memtext").innerHTML=result["Mem"]["memtotal"]+"&nbsp;&nbsp;(&nbsp;<?php echo e(__('main.txt-v-swap-text')); ?>&nbsp;:&nbsp;"+result["Mem"]["swaptotal"]+"&nbsp;)";//内存信息
                            xCPUa=result["CpuState"]["cpu-all"]; 
                            xCPUs=result["CpuState"]["cpu-cores"];
                            xMEMa=result["Mem"]["mem-used"];
                            for (var i=0;i<xCPUs;i++) {  xCPUs1[i]='<?php echo e(__("main.txt-v-cpus-text")); ?> '+(i+1); xCPUs2[i]=result["CpuState"]["cpu-"+i]; }
                            //设置图表组件数据
                            CpuCharts.setOption({ series: [ { data: [ { value: xCPUa } ]  } ] });
                            MemCharts.setOption({ series: [ { data: [ { value: xMEMa } ]  } ] });
                            CPUsCharts.setOption({ xAxis: [ { data: xCPUs1  } ],series: [ { data: xCPUs2  } ] });
                            return ;
                        } 
                    }, error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(textStatus,":",errorThrown);
                    }
                });
            setTimeout( function(){document.getElementById("CAndM_spinner").style.visibility="hidden";} , 250 );
        }

        function RefreshStatusNet(){ //获取网络信息
            var xNICs=0;
            document.getElementById("Net_spinner").style.visibility="visible";
                $.ajax( { type: "POST", url: '/getapi' , async : true ,  data: {"API":"[Net]",'_token':'<?php echo e(csrf_token()); ?>' },//传入后台
                    success: function(result) {  //alert(result); //调试输出服务器返回信息
                        //document.getElementById("NetTest").innerHTML= JSON.stringify(result); //测试网络信息
                        if (result["[OK!]"]==0) {  //console.log(result["Net"]);
                            if ( result["Net"]["NIC"]["Status"]=="OK!" ) {
                                document.getElementById("Net_NICs").innerHTML=result["Net"]["NICs"];//网卡数量
                                xNICs=result["Net"]["NICs"]; 
                                if ( result["Net"]["Flow"]["Status"]=="OK!" ) {
                                    //设置网卡合计流量图表组件数据
                                    xNTvd=result['Net']['Flow']['Total']['Flow-in']; xNTvd = Math.floor(xNTvd * 100) / 100; xNTvu=result['Net']['Flow']['Total']['Flow-out']; xNTvu = Math.floor(xNTvu * 100) / 100;
                                    xNTvt='<?php echo e(__('main.txt-v-NetinTxt')); ?>' +' : '+ result['Net']['Flow']['Total']['in'] +' , '+'<?php echo e(__('main.txt-v-NetoutTxt')); ?>'+' : '+ result['Net']['Flow']['Total']['out'];
                                    NetTd.shift(); NetTu.shift();  NetTd.push(xNTvd); NetTu.push(xNTvu);
                                    vMy=NetTd.concat(NetTu);  vMy=Math.max.apply(null, vMy);//求刻度最大值
                                    vMy=Math.ceil( vMy / 500 ) * 500; vMy=parseInt(vMy)+500; //最大值取整
                                    NetChartsTotal.setOption({ title: { text: xNTvt },xAxis: [ { data: NetTt } ],series: [ { data: NetTd } , { data: NetTu } ] , yAxis: [ { max: vMy } , { max: vMy } ] });
                                    //console.log( 'Total in : '+JSON.stringify(NetTd));
                                    //console.log( 'Total Out : '+JSON.stringify(NetTu));
                                    <?php 
                                        echo "\r\n";
                                        for ($x=0; $x<=$xSysInfo['Net']['NICs']-1; $x++) {
                                            echo "                                        //设置网卡".$x."流量图表组件数据\r\n";
                                            echo "                                        document.getElementById('network-Title-".$x."').innerHTML= result['Net']['NICs-".$x."']['Name'] +' : '+ result['Net']['NICs-".$x."']['Speed'] +' '+ result['Net']['NICs-".$x."']['Factory'] +' - '+ result['Net']['NICs-".$x."']['Model'] ; \r\n";
                                            echo "                                        vNetDis=' '; if ( result['Net'][ result['Net']['NICs-'+".$x."]['Name'] ]['Link']==false ) { vNetDis=' ".__('main.txt-v-NetDisabled') ."'; } \r\n";
                                            echo "                                        xNTvd".$x."=result['Net']['Flow'][ result['Net']['NICs-'+".$x."]['Name'] ]['Flow-in']; xNTvd".$x."= Math.floor(xNTvd".$x." * 100) / 100; xNTvu".$x."=result['Net']['Flow'][ result['Net']['NICs-'+".$x."]['Name']]['Flow-out']; xNTvu".$x."= Math.floor(xNTvu".$x." * 100) / 100; \r\n";
                                            echo "                                        xNTvt".$x."='". __('main.txt-v-NetinTxt') ."' +' : '+ result['Net']['Flow'][ result['Net']['NICs-'+".$x."]['Name']]['in'] +' , '+'". __('main.txt-v-NetoutTxt') ."'+' : '+ result['Net']['Flow'][ result['Net']['NICs-'+".$x."]['Name']]['out'] + vNetDis ; \r\n";
                                            echo "                                        NetTd".$x.".shift(); NetTu".$x.".shift();  NetTd".$x.".push(xNTvd".$x."); NetTu".$x.".push(xNTvu".$x."); \r\n";
                                            echo "                                        vMy".$x."=NetTd".$x.".concat(NetTu".$x.");  vMy".$x."=Math.max.apply(null, vMy".$x.");//求刻度最大值 \r\n";
                                            echo "                                        vMy".$x."=Math.ceil( vMy".$x." / 500 ) * 500; vMy".$x."=parseInt(vMy".$x.")+500; //最大值取整 \r\n";
                                            echo "                                        NetCharts".$x.".setOption({ title: { text: xNTvt".$x." },xAxis: [ { data: NetTt } ],series: [ { data: NetTd".$x." } , { data: NetTu".$x." } ] , yAxis: [ { max: vMy".$x." } , { max: vMy".$x." } ] }); \r\n";
                                            echo "                                        //console.log( result['Net']['NICs-'+".$x."]['Name']+' in : '+ JSON.stringify( NetTd".$x." ) ); \r\n";
                                            echo "                                        //console.log( result['Net']['NICs-'+".$x."]['Name']+' Out : '+ JSON.stringify( NetTu".$x." ) ); \r\n";
                                            echo "\r\n";
                                        } 
                                    ?>
                                }
                                //网卡信息获取正确
                            }
                            return ;
                        } 
                    }, error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(textStatus,":",errorThrown);
                    }
                });
            setTimeout( function(){document.getElementById("Net_spinner").style.visibility="hidden";} , 250 );
        }

        window.onload=function(){ RefreshStatusCM(); RefreshStatusNet(); }; //页面显示时马上刷新
        setInterval( RefreshStatusSys , 6000 ); //系统信息计时器定期刷新
        setInterval( RefreshStatusStorage , 10000 ); //存储信息计时器定期刷新
        setInterval( RefreshStatusCM , 2000 ); //CPU和内存信息计时器定期刷新
        setInterval( RefreshStatusNet , 3000 ); //网络信息计时器定期刷新
    </script>

<?php echo $__env->make('part-bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /MohistNas/main/resources/views/index.blade.php ENDPATH**/ ?>