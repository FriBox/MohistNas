echo -n "root:" >>/MohistNas/temp_passwd.txt && \
mkpasswd -m sha-512 -S "MohistNasSalt" "MohistNas" >>/MohistNas/temp_passwd.txt && \
chpasswd -e < /MohistNas/temp_passwd.txt && \
rm -rf /MohistNas/temp_passwd.txt ; #无需确认修改密码
