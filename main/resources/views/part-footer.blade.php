            <!-- ================================================================ -->
            
            <!-- 切换语言功能 -->
            <script type="text/javascript">
                function SwitchLang(xLang) {
                    //切换语言
                    var xUrl = window.location.protocol+'//'+window.location.host+'/lang';
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
            </script>

            <!-- 页脚区域开始 -->
            <div class="row align-items-end" style="font-size:14px;">
                <div class="col-md-auto align-self-start" style="height:30px;padding-left: 20px;padding-top:12px;padding-bottom:3px;">
                    <!-- 版权信息区域 --><span>{{ __('main.meta_Copyright') }}</span>
                </div>

                <!-- 页脚功能区域开始 -->
                <div class="col align-items-center"><table border=0 rules=none cellspacing=0 width=100%><tr>
                        <!-- 页脚功能区域 -->
                        <td valign="top"><div style="float:right">
                            
                        </div></td>

                        <td style="width:100px;" valign="top"><div style="float:left;padding-top:10px;">
                            功能1
                        </div></td>
                        
                        <!-- 页脚切换语言功能区域 -->
                        <td style="width:160px;" valign="top"><div style="float:right;padding-top:4px;padding-bottom:4px;">
                                <div class="btn-group" role="group">
                                    <button id="btnSwitchLang" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:14px;">
                                        <i class="bi bi-globe2"></i>&nbsp;{{ __('main.SwitchLang') }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size:14px;">
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="SwitchLang('zh-CN')">简体中文</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="SwitchLang('zh-TW')">繁體中文</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="SwitchLang('jp')">日本语</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="SwitchLang('en')">English</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="SwitchLang('de')">German</a></li>
                                    </ul>
                                    <i class="bi bi-device-hdd" style="font-size:23px;padding-left:8px;padding-right:8px;"></i>
                                </div>
                        </div></td>

                </tr></table></div><!-- 页脚功能区域结束 -->
                
            </div><!-- 页脚区域结束 -->

            <!-- 显示提示功能 -->
            <script type="text/javascript">
                //显示tooltip
                var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            </script>

