#系统更新
apt  update
apt dist-upgrade -y
apt autoclean -y
apt autoremove -y
aptitude purge -y
#设置代理
export https_proxy='192.168.100.253:6004';
export http_proxy='192.168.100.253:6004';
cd /MohistNas/main/
echo yes | composer update
#去除代理
unset  https_proxy
unset  http_proxy
#[End]
