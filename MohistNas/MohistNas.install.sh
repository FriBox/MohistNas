#设置系统依赖等组件
    #设置密码
    echo mkpasswd -m sha-512 -S "MohistNas" "MohistNas" | passwd --stdin root

    #系统基本配置
    cp -rf /MohistNas/sshd_config.conf /etc/ssh/sshd_config
    cp -rf /MohistNas/hostname.conf /etc/hostname
    #安装源准备
    sudo apt -y install software-properties-common
    sudo add-apt-repository -y ppa:ondrej/php
    apt update
    #安装基本组件
    apt -y install ntp ntpdate openssl aptitude whois net-tools sysstat ifstat curl perl libnet-ssleay-perl openssl libauthen-pam-perl libpam-runtime libio-pty-perl apt-show-versions unzip
    apt -y python
    apt -y install apache2
    sudo a2enmod rewrite
    sudo a2enmod ssl
    sudo a2enmod speling
    #安装PHP
    apt -y install php8.1 libapache2-mod-php8.1 php8.1-common
    apt -y install php8.1-dom php8.1-bcmath php8.1-xml php8.1-curl php8.1-zip php8.1-mbstring
    #设置时区
    timedatectl set-timezone Asia/Shanghai
    systemctl restart rsyslog
    ntpdate cn.pool.ntp.org
    #按照硬件传感器监测工具
    apt -y install lm-sensors hddtemp smartmontools
    sensors-detect 

        #设置代理，部分组件在国外，下载太慢，加上代理加速安装
        export https_proxy='192.168.100.253:6004';
        export http_proxy='192.168.100.253:6004';
        #安装Webmin
        #wget http://prdownloads.sourceforge.net/webadmin/webmin_1.994_all.deb
        dpkg --install ./webmin_1.994_all.deb

    #安装Composer
    cd /root
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

#安装MohistNas控制台
    #安装MohistNas
    #mkdir /MohistNas
    cp -rf /MohistNas/apache2.ports.conf /etc/apache2/ports.conf
    cp -rf /MohistNas/VirtualHost.80.conf /etc/apache2/sites-available/
    cp -rf /MohistNas/VirtualHost.443.conf /etc/apache2/sites-available/
    cp -rf /MohistNas/VirtualHost.6888.conf /etc/apache2/sites-available/
    ln -s /etc/apache2/sites-available/VirtualHost.80.conf /etc/apache2/sites-enabled/VirtualHost.80.conf
    ln -s /etc/apache2/sites-available/VirtualHost.443.conf /etc/apache2/sites-enabled/VirtualHost.443.conf
    ln -s /etc/apache2/sites-available/VirtualHost.6888.conf /etc/apache2/sites-enabled/VirtualHost.6888.conf
    mv -f /etc/apache2/sites-enabled/000-default.conf /etc/apache2/sites-enabled/000-default.conf.bak
    rm -rf /MohistNas/phplibs/test/*.*
    rm -rf /MohistNas/main/README.md
    #安装证书
    mkdir /MohistNas/cert
    cp -rf /MohistNas/MohistNas_Key.key /MohistNas/cert/MohistNas_Key.key
    cp -rf /MohistNas/MohistNas_public.crt /MohistNas/cert/MohistNas_public.crt
    #建立日志文件夹
    mkdir /MohistNas/log
    #设置用户组
    sudo groupadd MohistNas
    sudo usermod -a -G MohistNas root
    #配置Apache权限
    if (( cat '/etc/sudoers' | grep "www-data" > /dev/null ))
    then
        echo 'Edit >> /etc/sudoers ';
        sed -i "/^www-data*/d" /etc/sudoers
        echo "www-data ALL=(ALL) NOPASSWD : ALL"  >>  '/etc/sudoers' ; 
    else
        echo 'Add >> /etc/sudoers ';
        echo ""  >>  '/etc/sudoers' ; 
        echo "www-data ALL=(ALL) NOPASSWD : ALL"  >>  '/etc/sudoers' ; 
    fi
    systemctl restart apache2
    #配置开启装载内存盘
    if (( cat '/usr/lib/systemd/system/rc-local.service' | grep "[Install]" > /dev/null ))
    then
        #可能已经有了开机启动的[Install]内容
        echo 'Edit >> /usr/lib/systemd/system/rc-local.service ';
    else
        echo 'Add >> rc.local ';
        echo ""  >>  '/usr/lib/systemd/system/rc-local.service' ; 
        echo "[Install]"  >>  '/usr/lib/systemd/system/rc-local.service' ; 
        echo "WantedBy=multi-user.target"  >>  '/usr/lib/systemd/system/rc-local.service' ; 
        echo "Alias=rc-local.service"  >>  '/usr/lib/systemd/system/rc-local.service' ; 
        echo ""  >>  '/usr/lib/systemd/system/rc-local.service' ; 
    fi
    cp -rf /MohistNas/MohistNas.rc.local /etc/rc.local
    chmod 755 /etc/rc.local
    #设置全局环境变量
    if (( cat '/etc/profile' | grep "MohistNasCache" > /dev/null ))
    then
        echo 'Edit >> /etc/profile ';
        sed -i "/^export MohistNasCache*/d" /etc/profile
        echo 'export MohistNasCache="/MohistNas/cache/"'  >>  '/etc/profile' ; 
    else
        echo 'Add >> /etc/profile ';
        echo ""  >>  '/etc/profile' ; 
        echo 'export MohistNasCache="/MohistNas/cache/"'  >>  '/etc/profile' ; 
        echo ""  >>  '/etc/profile' ; 
    fi
    # 安装 laravel
    echo yes | composer global require "laravel/installer"
    cd /MohistNas/
    /root/.config/composer/vendor/bin/laravel new main
    cd main/
    echo yes | composer update
    sudo chmod -R 777 /MohistNas/main/storage
    sudo chmod -R 777 /MohistNas/main/bootstrap/cache
    cp -rf /MohistNas/MohistNas.Web.env /MohistNas/main/.env
    systemctl restart apache2

#安装后整理
    #去除代理
    unset  https_proxy
    unset  http_proxy
    #系统更新
    apt update
    apt -y dist-upgrade
    #清理系统
    apt -y autoclean
    apt -y autoremove
    aptitude purge

#[End]
