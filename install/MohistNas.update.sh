# ================================================
# MohistNas Update Shell
# Last modified from stream.Wang 20220531
# ================================================

#系统更新
apt clean
apt update
apt dist-upgrade -y
apt autoclean -y
apt autoremove -y
aptitude purge -y
#设置代理
export https_proxy='192.168.100.253:6004';
export http_proxy='192.168.100.253:6004';
#更新MohistNas及其依赖组件
cd /MohistNas/main/
echo yes | composer update
    sudo chmod -R 777 /MohistNas/main/storage
    sudo chmod -R 777 /MohistNas/main/bootstrap/cache
    cp -rf /MohistNas/install/MohistNas.Web.env /MohistNas/main/.env
#去除代理
unset  https_proxy
unset  http_proxy
#[End]
