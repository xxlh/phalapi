<?php
   // error_reporting(1);

    $target = '/home/shenebwx/public_html/sina/api'; // 生产环境web目录
    //密钥
    $secret = "sina";
    $wwwUser = 'www';
    $wwwGroup = 'www';

    //日志文件地址
    $fs = fopen('/home/shenebwx/logs/gitHubAuto_hook_sina.log', 'a');

    //获取GitHub发送的内容 
    $json = file_get_contents('php://input');
    $content = json_decode($json, true);
    //github发送过来的签名  
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

    if (!$signature) {
       fclose($fs);
       return http_response_code(404);
     }

    list($algo, $hash) = explode('=', $signature, 2);
    //计算签名  
    $payloadHash = hash_hmac($algo, $json, $secret);

    // 判断签名是否匹配  
    if ($hash === $payloadHash) {
        // $cmds = array(
        //     "cd $target && git pull",
        //     "chown -R {$wwwUser}:{$wwwGroup} $target/",
        // );
        
        // foreach ($cmds as $cmd) {
        //     shell_exec($cmd);
        // }
        // 感谢@墨迹凡指正，可以直接用www用户拉取代码而不用每次拉取后再修改用户组
        // $cmd = "sudo -Hu www cd $target && git pull";
        $cmd = "cd $target && git pull 2>&1";
        $res = shell_exec($cmd);

        $res_log .= 'Success:'.PHP_EOL;
        $res_log .= $content['head_commit']['author']['name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . count($content['commits']) . '个commit：' . PHP_EOL;
        $res_log .= $res.PHP_EOL;
        $res_log .= '======================================================================='.PHP_EOL;

        fwrite($fs, $res_log);
        $fs and fclose($fs);


      } else {
            $res_log  = 'Error:'.PHP_EOL;
            $res_log .= $content['head_commit']['author']['name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . count($content['commits']) . '>个commit：' . PHP_EOL;
            $res_log .= '密钥不正确不能pull'.PHP_EOL;
            $res_log .= '======================================================================='.PHP_EOL;
           fwrite($fs, $res_log);
           $fs and fclose($fs);
      }