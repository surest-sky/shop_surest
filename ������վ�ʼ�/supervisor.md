# supervisor的使用

> supervisor 是一款后台的守护进程工具

## 安装

    sudo apt-get install supervisor
    
## 配置

    [unix_http_server]
    file=/tmp/supervisor.sock   ;UNIX socket 文件，supervisorctl 会使用
    ;chmod=0700                 ;socket文件的mode，默认是0700
    ;chown=nobody:nogroup       ;socket文件的owner，格式：uid:gid
     
    ;[inet_http_server]         ;HTTP服务器，提供web管理界面
    ;port=127.0.0.1:9001        ;Web管理后台运行的IP和端口，如果开放到公网，需要注意安全性
    ;username=user              ;登录管理后台的用户名
    ;password=123               ;登录管理后台的密码
     
    [supervisord]
    logfile=/tmp/supervisord.log ;日志文件，默认是 $CWD/supervisord.log
    logfile_maxbytes=50MB        ;日志文件大小，超出会rotate，默认 50MB，如果设成0，表示不限制大小
    logfile_backups=10           ;日志文件保留备份数量默认10，设为0表示不备份
    loglevel=info                ;日志级别，默认info，其它: debug,warn,trace
    pidfile=/tmp/supervisord.pid ;pid 文件
    nodaemon=false               ;是否在前台启动，默认是false，即以 daemon 的方式启动
    minfds=1024                  ;可以打开的文件描述符的最小值，默认 1024
    minprocs=200                 ;可以打开的进程数的最小值，默认 200
     
    [supervisorctl]
    serverurl=unix:///tmp/supervisor.sock ;通过UNIX socket连接supervisord，路径与unix_http_server部分的file一致
    ;serverurl=http://127.0.0.1:9001 ; 通过HTTP的方式连接supervisord
     
    ; [program:xx]是被管理的进程配置参数，xx是进程的名称
    [program:xx]
    command=/opt/apache-tomcat-8.0.35/bin/catalina.sh run  ; 程序启动命令
    autostart=true       ; 在supervisord启动的时候也自动启动
    startsecs=10         ; 启动10秒后没有异常退出，就表示进程正常启动了，默认为1秒
    autorestart=true     ; 程序退出后自动重启,可选值：[unexpected,true,false]，默认为unexpected，表示进程意外杀死后才重启
    startretries=3       ; 启动失败自动重试次数，默认是3
    user=tomcat          ; 用哪个用户启动进程，默认是root
    priority=999         ; 进程启动优先级，默认999，值小的优先启动
    redirect_stderr=true ; 把stderr重定向到stdout，默认false
    stdout_logfile_maxbytes=20MB  ; stdout 日志文件大小，默认50MB
    stdout_logfile_backups = 20   ; stdout 日志文件备份数，默认是10
    ; stdout 日志文件，需要注意当指定目录不存在时无法正常启动，所以需要手动创建目录（supervisord 会自动创建日志文件）
    stdout_logfile=/opt/apache-tomcat-8.0.35/logs/catalina.out
    stopasgroup=false     ;默认为false,进程被杀死时，是否向这个进程组发送stop信号，包括子进程
    killasgroup=false     ;默认为false，向进程组发送kill信号，包括子进程
     
    ;包含其它配置文件
    [include]
    files = relative/directory/*.ini    ;可以指定一个或多个以.ini结束的配置文件


## 使用 

conf.d 目录用来存放用户自定义的进程配置，参考： `/etc/supervisor/conf.d` 目录下

新建一个m_shop.conf （进程文件）

    [program:m_shop]
    process_name=%(program_name)s_%(process_num)02d
    command=php /home/forge/app.com/artisan queue:work sqs --sleep=3 --tries=3
    autostart=true
    autorestart=true
    user=vagrant
    numprocs=3
    redirect_stderr=true
    stdout_logfile=/home/forge/app.com/worker.log
    

常用配置

- numprocs ： 表示开启多少个进程

- process_name ： 与 numprocs 相辅相成，生成的进程名是唯一的，如： 

        vagrant@homestead:/etc/supervisor/conf.d$ sudo supervisorctl status
        m_shop:m_shop_00                 RUNNING   pid 12386, uptime 0:00:14
        m_shop:m_shop_01                 RUNNING   pid 12387, uptime 0:00:14
        m_shop:m_shop_02                 RUNNING   pid 12384, uptime 0:00:14
        m_shop:m_shop_03                 RUNNING   pid 12385, uptime 0:00:14
    
- autostart 是否重启

## 启动

    sudo supervisorctl reread
    sudo supervisorctl update
    sudo supervisorctl start m_shop:

## 常用命令 出现权限问题的话使用 sudo supervisorctl status  

    supervisorctl 是 supervisord的命令行客户端工具
    
    supervisorctl status：查看所有进程的状态
    supervisorctl stop m_shop：停止m_shop
    supervisorctl start m_shop：启动m_shop
    supervisorctl restart m_shop: 重启m_shop
    supervisorctl update ：配置文件修改后可以使用该命令加载新的配置
    supervisorctl reload: 重新启动配置中的所有程序
    ...
    
> 完成操作后 , 使用 sudo supervisorctl status 即可看到你的所有进程状态

