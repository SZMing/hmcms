<?php

/*

test server
118.190.104.201
root
A0a2fe9a3cbe5474


mysql -usst -pA0a2fe9a3cbe5474 -h 118.190.104.201 -P 3306 -D sst


master server
118.190.84.194
A61aee7c96d72145


// new.7618.com
服务器IP:123.57.5.131
服务器账号：test  服务器密码：646DF3BF7CE8DB1A
服务器账号：root  服务器密码：1cBDCrZEaSHV1RkM
数据库账号：root  数据库密码：NelvMSSNM3Nhuw9P


ssl on;
ssl_certificate /etc/nginx/conf.d/server.crt;
ssl_certificate_key /etc/nginx/conf.d/server.key;
ssl_session_timeout 5m;
ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
ssl_ciphers ECDH:AESGCM:HIGH:!RC4:!DH:!MD5:!aNULL:!eNULL;
ssl_prefer_server_ciphers on;


700MB --- 734003200

log_slow_admin_statements
log_slow_slave_statements
slow_launch_time
slow_query_log
slow_query_log_file

1、 接口的请求方式均为POST
2、 接口交互的数据格式只支持JSON
3、 接口采用对比签名的方式校验请求，客户端每次请求（GET、POST）都需要带上签名sign，签名过程如下：
将 get 或者 post 提交的参数按照键字典升序排序（key直接拼接在字符串的最后）如下拼接：
md5(ali=maleks&password=passxxxxx&username=yunchuang&key= Ae74EL8!GX@X23WQacaADES8145!*XXAb)
私钥： key=Ae74EL8!GX@X23WQacaADES8145!*XXAb
生成的即为签名sign，以下接口中不再写入该参数
4、 请求参数如无要求，请使用一下格式：
小写字母_下划线：user_id
5、返回中的page参数：0代表没有分页或者没有下一页，1代表有下一页
6、所有code返回10000均为请求成功，code返回10001代表请求没有数据，code返回10002均为验证失败，其他   具体信息见返回编码表
7、所有需要登陆的接口均需要带上参数 token

//启用当前目录下php代码提示
cd /path/to/your/projects/root
ctags -R --fields=+laimS --languages=php


//打开折叠
全选 ggvG + zo

//全部替换
:%s/olg/new/c   (需要确认替换)
:%s/old/new/g   (不需要确认替换)

//搜索下一个按键：n
//搜索上一个按键：N


ctrl+z 最小化vim后，使用在终端 fg 命令再次打开

-------------------------------------------------

redis 和 mongo

1.启动redis
cd /soft/redis
src/redis-server

redis shell
src/redis-cli

2. mongo的安装
dnf install mongodb

mongo启动服务 mongod
mongod --dbpath=/data/db
mongo shell: mongo
启动shell的时候会提示安装mongodb，直接安装就行


mongodb 的使用参考这个网址：http://www.yiibai.com/mongodb/mongodb_quick_guide.html




---------------------------------------------------------------------------


slow_query_log = 1
slow_query_log_file = /var/log/mysql/mysql-slow.log
long_query_time = 3
log_queries_not_using_indexes = ON



//iptables
//单个IP限制最大并发
iptables -I INPUT -p TCP --syn --dport 80 -m connlimit --connlimit-above 55 -j REJECT

//limit（限速、控制流量）
(例子) iptables -A INPUT -m limit --limit 3/hour --limit-burst 5

//限制icmp(允许10个连接，超过以后，每分钟只允许一个连接)
iptables -A INPUT -p icmp -m limit --limit 1/m --limit-burst 10 -j ACCEPT
//将默认的icmp给关掉
iptables -A INPUT -p icmp -j DROP





grant all PRIVILEGES on yc.* to ming@'%' identified by 'A61aee7c96d72145';
flush privileges;


https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxa2375607dd237f94&secret=f08026df6e977c68f461be5e4bef6b47





//sst svn

http://114.215.66.223:81/svn/ss.7618.com
hblc_hmm
0144A5A70107A25D






 */
