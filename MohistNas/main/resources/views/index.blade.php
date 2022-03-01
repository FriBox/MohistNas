@include('part-top')
    <?php $CsT='';$CsV=''; for ($x=0; $x<$xSysInfo['Status']['cpu-cores']; $x++) { $CsT=$CsT.'"'.__("main.txt-v-cpus-text").' '.($x+1).'",'; $CsV=$CsV.' 0, '; }; $CsT=trim($CsT); $CsV=trim($CsV); ?>
    <div class="container-fluid"><div class="row"><!--  行1 Begin -->
        <!-- 1.系统信息 -->
        <div class="col-xl-6"> <center><div class="Panel1">
            <div class="PanelTitle">{{ __('main.txt-SysMsg') }}</div>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-host-name') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Sys']['host-name']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-sys-name') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Sys']['sys-name']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-kernel') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Sys']['kernel']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-cpu-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Cpu']['cpu-text']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-memory-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Mem']['memtotal']}}&nbsp;&nbsp;(&nbsp;{{ __('main.txt-v-swap-text') }}&nbsp;:&nbsp;{{$xSysInfo['Mem']['swaptotal']}}&nbsp;)</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-uptime-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Time']['sys-uptimelang']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName" >{{ __('main.txt-v-virtualizer-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Sys']['virtualizer']}}</p>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-processes-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Sys']['processes']}}</p>
        </div></center> </div>
        <!-- 2.存储信息 -->
        <div class="col-xl-6"> <center><div class="Panel1">
            <div class="PanelTitle">{{ __('main.txt-StorageMsg') }}</div>
        </div></center> </div>
    </div></div><!--  行1 End -->

    <div class="container-fluid"> <div class="row"><!--  行2 Begin -->
        <!-- 3.CPU和内存信息 -->
        <div class="col-xl-6"><center><div class="Panel2">
                <div class="PanelTitle"><span>{{ __('main.txt-CPUMemoryMsg') }}</span><span id="CAndM_spinner" class="spinner-grow spinner-grow-sm float-end" style="margin-right: 10px;margin-top: 3px;visibility:hidden;"></span></div>
                <div class="container-sm" style="padding-left:0px;padding-right:0px;">

                    <div class="row">
                        <div class="col-sm"><!-- CPU使用率 -->
                            <div class="container-sm"  style="padding-left:0px;padding-right:0px;"> <div class="row"><div id="EC_CPU" style="height:180px;width:200px;margin: 0 auto;"></div></div> </div>
                        </div>
                        <div class="col-sm"><!-- 内存使用率 -->
                            <div class="container-sm" style="padding-left:0px;padding-right:0px;"> <div class="row"><div id="EC_MEM" style="height:180px;width:200px;margin: 0 auto;"></div></div> </div>
                        </div>
                    </div>

                    <div class="row">
                        <div id="EC_CPUs" style="height:150px;margin: 0 auto;"></div>
                    </div>

                </div>
        </div></center> </div>
        <!-- 4.网络信息 -->
        <div class="col-xl-6"> <center><div class="Panel2">
            <div class="PanelTitle">{{ __('main.txt-NetMsg') }}</div>
            <p class="PanelTextLine"><span class="PanelTextName">{{ __('main.txt-v-networkcounts-text') }}</span>&nbsp;:&nbsp;{{$xSysInfo['Net']['NICs']}}</p>
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
                    offsetCenter: [0, '92%'], valueAnimation: true, formatter: '{value}%\n{{ __('main.txt-v-cpua-text') }}', color: '#222222', fontSize: 16
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
                    offsetCenter: [0, '92%'], valueAnimation: true, formatter: '{value}%\n{{ __('main.txt-v-mema-text') }}', color: '#222222', fontSize: 16
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

        //添加响应窗口resize
        window.addEventListener('resize',function () {  CpuCharts.resize(); MemCharts.resize(); CPUsCharts.resize();  } );
    </script>

    <!--  读取数据JS -->
    <script type=text/javascript>
        function RefreshStatus(){ //获取系统信息
            var xCPUa=0; var xMEMa=0; var xCPUs=0; var xCPUs1=[]; var xCPUs2=[];
            document.getElementById("CAndM_spinner").style.visibility="visible";
                $.ajax( { type: "POST", url: '/getapi' , async : true ,  data: {"API":"info_Status",'_token':'{{csrf_token()}}' },//传入后台
                    success: function(result) {  //alert(result); //调试输出服务器返回信息
                        if (result["[OK!]"]==0) {
                            xCPUa=result["API"]["cpu-all"]; // document.getElementById("HW_CPU").innerHTML=xCPUa+'%';
                            xCPUs=result["API"]["cpu-cores"];
                            xMEMa=result["API"]["mem-used"];
                            for (var i=0;i<xCPUs;i++) {  xCPUs1[i]='{{ __("main.txt-v-cpus-text") }} '+(i+1); xCPUs2[i]=result["API"]["cpu-"+i]; }
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
        window.onload=function(){ RefreshStatus(); }; //页面显示时马上刷新
        setInterval( RefreshStatus , 2000 ); //计时器定期刷新
    </script>

@include('part-bottom')
