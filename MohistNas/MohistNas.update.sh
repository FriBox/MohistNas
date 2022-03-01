#设置代理
export https_proxy='192.168.100.253:6004';
export http_proxy='192.168.100.253:6004';
cd /MohistNas/main/
composer update
#去除代理
unset  https_proxy
unset  http_proxy
#[End]
