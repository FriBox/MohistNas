#coding=UTF-8
# MohistNas WebService v0.99.20220526
# FriBox China (http://FriBox.cn/)
# Create by Stream.Wang 2022-05-26
# Modify by Stream.Wang 2022-05-26

import os,sys,datetime,json;
import tornado.web, tornado.ioloop;

#=======================================================
# 基础函数
def sys_p(inStr):
    print('>>> '+ inStr);
    return ;

def time_getUtcDateTimestr(inDateTpye=0,inDSeparator='-',inDTSeparator=' ',inTimeTpye=10,inTSeparator=':',inMSeparator='.',inTimeZone=+8,inTZSeparator=' '):
    # Time GetUtcDateTimestr 格式化输出UTC日期时间字符串
    import datetime
    dt=datetime.datetime.utcnow()
    dt=dt+datetime.timedelta(hours=inTimeZone)
    # 格式化日期输出
    if inDateTpye==-1: #年-月-日
        tDStr=''
    elif inDateTpye==0: #年-月-日
        tDStr=dt.strftime('%Y'+inDSeparator+'%m'+inDSeparator+'%d')
    elif inDateTpye==1: #月-日
        tDStr=dt.strftime('%m'+inDSeparator+'%d')
    elif inDateTpye==2: #年
        tDStr=dt.strftime('%Y')
    elif inDateTpye==3: #月
        tDStr=dt.strftime('%m')
    elif inDateTpye==4: #日
        tDStr=dt.strftime('%d')
    elif inDateTpye==5: #年-月
        tDStr=dt.strftime('%Y'+inDSeparator+'%m')
    elif inDateTpye==6: #月-日-年
        tDStr=dt.strftime('%m'+inDSeparator+'%d'+inDSeparator+'%Y')
    elif inDateTpye==7: #年-月-日 星期
        tDStr=dt.strftime('%Y'+inDSeparator+'%m'+inDSeparator+'%d'+' '+'%A')
    elif inDateTpye==8: #年-月-日 星期
        tDStr=dt.strftime('%Y'+inDSeparator+'%m'+inDSeparator+'%d'+' '+'%w')
    else :
        tDStr=dt.strftime('%Y'+inDSeparator+'%m'+inDSeparator+'%d')
    #格式化时间输出
    tDtStr2=str(int(dt.microsecond/1000))
    TimeZoneStr=inTZSeparator+( '%+0.2d00' % inTimeZone)
    tDtStr2=tDtStr2.format("%03d", int(tDtStr2));
    if inTimeTpye==-1: #时：分：秒.毫秒
        tDtStr=''
    elif inTimeTpye==0: #时：分：秒.毫秒
        tDtStr=dt.strftime('%H'+inTSeparator+'%M'+inTSeparator+'%S')+inMSeparator+tDtStr2
    elif inTimeTpye==1: #时：分：秒
        tDtStr=dt.strftime('%H'+inTSeparator+'%M'+inTSeparator+'%S')
    elif inTimeTpye==2: #时：分
        tDtStr=dt.strftime('%H'+inTSeparator+'%M')
    elif inTimeTpye==3: #时
        tDtStr=dt.strftime('%H')
    elif inTimeTpye==4: #分：秒
        tDtStr=dt.strftime('%M'+inTSeparator+'%S')
    elif inTimeTpye==5: #分：秒.毫秒
        tDtStr=dt.strftime('%M'+inTSeparator+'%S')+'.'+tDtStr2
    elif inTimeTpye==10: #时：分：秒.毫秒 时区
        tDtStr=dt.strftime('%H'+inTSeparator+'%M'+inTSeparator+'%S')+inMSeparator+tDtStr2+TimeZoneStr
    elif inTimeTpye==11: #时：分：秒 时区
        tDtStr=dt.strftime('%H'+inTSeparator+'%M'+inTSeparator+'%S')+TimeZoneStr
    elif inTimeTpye==12: #时：分 时区
        tDtStr=dt.strftime('%H'+inTSeparator+'%M')+TimeZoneStr
    elif inTimeTpye==13: #时 时区
        tDtStr=dt.strftime('%H')+TimeZoneStr
    elif inTimeTpye==14: #分：秒 时区
        tDtStr=dt.strftime('%M'+inTSeparator+'%S')+TimeZoneStr
    elif inTimeTpye==15: #分：秒.毫秒 时区
        tDtStr=dt.strftime('%M'+inTSeparator+'%S')+'.'+tDtStr2+TimeZoneStr
    else :
        tDtStr=dt.strftime('%H'+inTSeparator+'%M'+inTSeparator+'%S')
    return tDStr+inDTSeparator+tDtStr;

def time_GUDT():
    return time_getUtcDateTimestr();

def time_GLogDT():
    return time_getUtcDateTimestr(inDateTpye=0,inDSeparator='',inDTSeparator='',inTimeTpye=-1);

def fil_writelog(filename='log.txt',logtext='',add=True):
    # FIL WRITELOG 写日志文件
    # filename='log.txt'    日志文件路径名
    # logtext=''            日志内容
    # add=True              是否添加模式
    import datetime
    if add==True : uf=open(filename,"a+")
    else : uf=open(filename,"w+")
    dt=datetime.datetime.now()
    uf.write(time_getUtcDateTimestr()+' >> '+logtext+'\n')
    uf.close;
    return ;

def sys_CPU_info():
    tOutVar={}
    # 获取CPU相关信息
    vCR1=os.popen("cat /proc/cpuinfo | grep 'model name' |uniq && grep 'core id' /proc/cpuinfo | sort -u |wc -l && grep 'processor' /proc/cpuinfo | sort -u | wc -l "); #获取CPU名称/核心数/逻辑核心数
    vCR2=vCR1.read();
    tOutVar["cpu-name"]=vCR2.split("\n")[0].replace('model name','').replace(':','').strip();
    tOutVar["cpu-corestxt"]=vCR2.split("\n")[1].strip();#获取CPU核心数
    tOutVar["cpu-processor"]=vCR2.split("\n")[2].strip(); #获取CPU逻辑核心数
    tOutVar["cpu-text"]=tOutVar["cpu-name"]+' , '+tOutVar["cpu-processor"]+' cores'; #获取CPU详细描述
    # 获取CPU使用率
    vCR1 = os.popen("mpstat -o JSON -P ALL 1 1 "); #获取CPU使用率
    vCR2 = json.loads(vCR1.read());
    tOutVar["cpu-cores"]=vCR2["sysstat"]['hosts'][0]['number-of-cpus'];
    vCR2=vCR2["sysstat"]['hosts'][0]['statistics'][0]['cpu-load'];
    for i in range( int(tOutVar["cpu-cores"])+1 ):
        if (i==0) : 
            xCpuName='all'
        else: 
            xCpuName=str(i-1);
        if ( round(100-float(vCR2[i]['idle']),1)<0 ) : 
            tOutVar["cpu-"+xCpuName]=0;
        else: 
            tOutVar["cpu-"+xCpuName]=round(100-float(vCR2[i]['idle']),1);
    del vCR1,vCR2;
    return tOutVar;

#=======================================================
# 系统初始化->初始化变量
global sys_showdebug; #是否输出调试信息
sys_showdebug=False;
global sys_log; #是否写日志文件
sys_log=False;
global sys_cookie_secret;
sys_cookie_secret='00d5da67-6012-4611-94d7-523cf1901980';

# 系统输出调试信息
def sys_debug(inDebugStr=''):
    if sys_showdebug==True : print('[Debug] '+time_GUDT()+' >> '+inDebugStr.rstrip())
    return ;
#系统写入日志信息
def Setlog(logstr=''):
    if (sys_log==True):
        if not os.path.exists(sys_logpath) : os.makedirs(sys_logpath);
        LogFile=sys_logpath+time_GLogDT()+'.log'#日志文件
        fil_writelog(LogFile,logstr);
    
# 系统初始化->服务名称和版本
global sys_servicename;
sys_servicename='MohistNas WebService';
global sys_servicever;
sys_servicever=r'v0.99.20220526';
sys_debug('Sys_ServiceName: '+sys_servicename+' '+sys_servicever);
# 系统初始化->系统应用程序名    
global sys_appname;
sys_appname=os.path.basename(sys.argv[0]); #系统应用程序名
sys_debug('Sys_AppName: '+sys_appname);
# 系统初始化->系统所在路径
global sys_apppath;
sys_apppath=os.path.dirname(sys.argv[0])+'/'; #系统所在路径
sys_debug('Sys_AppPath: '+sys_apppath);
# 系统初始化->日子文件所在路径
global sys_logpath;
sys_logpath=os.path.abspath(os.path.join(os.getcwd(), ".."))+'/log'+'/'; #日子文件所在路径
sys_debug('Sys_LogPath: '+sys_logpath);
# 系统初始化->输出其他调试信息
sys_debug('sys_Debug: '+str(sys_showdebug));
sys_debug('sys_Log: '+str(sys_log));
# 系统初始化->初始化HTTP监听端口 sys_httpport
argvhp='6898'; #保存web端口参数
sys_httpport = int(argvhp); #HTTP监听端口 > 来自外部参数
sys_debug('Sys_HttpPort: 127.0.0.1:'+argvhp);

#=======================================================
# 页面处理过程
class App_Root(tornado.web.RequestHandler):
    #网页入口
    def get(self):
        stt = datetime.datetime.now()-datetime.timedelta(microseconds=1000)
        sys_p('Get '+str(self.request.uri));
        Setlog(str(self.request)) #HTTP日志
        self.set_header('Server', sys_servicename)
        self.set_header("Cache-Control","no-cache, must-revalidate")
        #输出开始
        self.write(sys_servicename +' '+ sys_servicever);
        #输出结束
        self.write('\n<!-- '+sys_servicename+' - Processing time ['+ format((datetime.datetime.now()-stt).microseconds/1000/1000.000000, '.6f') +'] -->\n')
        return ;

class App_Get(tornado.web.RequestHandler):
    #网页主入口
    def get(self):
        stt = datetime.datetime.now()-datetime.timedelta(microseconds=1000)
        sys_p('Get '+str(self.request.uri));
        Setlog(str(self.request)) #HTTP日志
        self.set_header('Server', sys_servicename)
        self.set_header("Cache-Control","no-cache, must-revalidate")
        #输出信息
        self.write(sys_servicename +' '+ sys_servicever+'\n<!-- '+sys_servicename+' - Processing time ['+ format((datetime.datetime.now()-stt).microseconds/1000/1000.000000, '.6f') +'] -->')
        return ;
    def post(self):
        sys_p('Get '+str(self.request.uri));
        Setlog(str(self.request)) #HTTP日志
        self.set_header('Server', sys_servicename)
        self.set_header("Cache-Control","no-cache, must-revalidate")
        #获取传入参数
        # curl -X POST -F 'V=[CPU_info][Debug]' http://127.0.0.1:6898/Get
        self.request.arguments = {k.lower():v for k,v in self.request.arguments.items()}
        try:
            tVar=self.get_argument("Var".lower());
        except:
            tVar='';
        if (tVar.strip()=='') :
            try:
                tVar=self.get_argument("V".lower());
            except:
                tVar='';
        #判断参数
        if (tVar.strip()=='') : 
            #无输出
            vOut={"code":"-1"};
        else :
            #输出信息
            vOut={"code":"0"};
            if ("[CPU_info]".lower() in tVar.lower()) : vOut["CPU_info"]=sys_CPU_info();
        #输出开始
        self.write(json.dumps(vOut));
        #输出结束
        return ;      
        '''
        PHP 访问代码实例
        $data = array ('Var' => '[CPU_info]');
            $data = http_build_query($data);
            $opts = array (
            'http' => array (
                'method' => 'POST',
                'header'=> "Content-type: application/x-www-form-urlencoded" .
                "Content-Length: " . strlen($data) . "",
                'content' => $data
            ),
            'SSL' => array(
                'verify_peer' => false,
            )
        );
        $vCurl = file_get_contents('http://127.0.0.1:6898/Get', false, stream_context_create($opts) ); 
        $HWS = json_decode($vCurl,true)["CPU_info"];
        '''
        
# Tornado设置信息
settings = {
            'gzip':True,                        #启用压缩
            'debug':False,                      #关闭调试模式
            'cookie_secret':sys_cookie_secret,  #设置cookie密钥
            'xsrf_cookies':False                #防御跨站请求攻击
            }

# Tornado.web
application = tornado.web.Application([
                                       ('/', App_Root),  #根路径
                                       (r"/[Gg][Ee][Tt]", App_Get), (r"/[Gg]", App_Get), #Get路径
                                       ],**settings)

#=======================================================
#系统主程序开始
if __name__ == '__main__':
    #Http Service Start
    application.listen(sys_httpport,address="0.0.0.0"); #Web服务监听端口
    print('='*(len(sys_servicename +' '+ sys_servicever)+46));
    sys_p(sys_servicename +' '+ sys_servicever + ' (Http) [ 0.0.0.0:'+str(sys_httpport)+' ] is Running !');
    print('='*(len(sys_servicename +' '+ sys_servicever)+46));
    try:
        Setlog(str(sys_servicename +' '+ sys_servicever+' Running... ')); #写日志
        tornado.ioloop.IOLoop.instance().start();
    except:
        print('>>> '+sys_servicename + ' (Http) failed to Start !');
        Setlog(str(sys_servicename +' '+ sys_servicever+' Start failed ! ')); #写日志     
#=======================================================
#[END]
