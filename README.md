# Use Swoole and Jieba to cut Chinese words

### 安装
- 安装 PHP 7+, Swoole 4+
- git clone 至任一目录

### 启动
- cd 至 shell 目录, 执行 sh socket.sh restart 开启 API 服务
- 启动成功使用 sh socket.sh status 将看到以下进程在默默的等候命令了
```
Swoole_nlp_master
Swoole_nlp_manager
Swoole_nlp_worker
```

### 访问
- curl "http://127.0.0.1:9502/nlp/parse?text=%E6%88%91%E4%B8%80%E4%BC%9A%E5%BC%80%E8%BD%A6%E8%BF%87%E5%8E%BB%E7%9C%8B%E7%9C%8B"
- 或者 cd 至 client 目录，执行 php http.php，成功的话则得到如下返回值
```
Array
(
    [segmentation] => Array
        (
            [0] => 我
            [1] => 一会
            [2] => 开车
            [3] => 过去
            [4] => 看看
        )

    [trunk] => Array
        (
            [开车] => 1.9574849809925
            [一会] => 1.75661978913
            [看看] => 1.352611160535
            [过去] => 1.1887989630875
        )

    [start] => 1596677807.9851
    [end] => 1596677807.9853
    [cost] => 0.00020003318786621
)
```

(⊙v⊙)嗯，仅用了 0.0002 秒就完成了，还不错

### 心跳检测
- 利用Crond 定时运行 shell/socket.sh heartbeat 即可, 妈妈再也不用担心我不会分词了