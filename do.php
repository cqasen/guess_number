<?php

$filePath = 'data.txt';

$uid = $_POST['uid'] ?? 0;
$unum = $_POST['num'] ?? 0;
$do = $_POST['do'] ?? 'guess';

if (!file_exists($filePath)) {
    file_put_contents($filePath, '');
}


if ($do == 'generate') {
    $num = mt_rand(1, 20);

    $data = [
        'uid' => $uid,
        'num' => $num,
        'beg_time' => time(),
    ];

    file_put_contents($filePath, implode(',', $data) . PHP_EOL, FILE_APPEND);
    echo '生成数据了';

} elseif ($do == 'guess') {

    $file = fopen($filePath, 'r');
    $list = [];
    while (!feof($file)) {
        $string = fgets($file);
        if (!$string) {
            continue;
        }
        $tmp = explode(',', $string);
        $list[$tmp[0]] = [
            'uid' => $tmp[0],
            'num' => $tmp[1],
            'beg_time' => $tmp[2],
        ];
    }

    fclose($file);

    $num = $list[$uid]['num'] ?? 0;
    $num = (int)$num;
    $t = $unum - $num;
    if ($t > 0) {

        echo $unum . ',猜大了';

    } elseif ($t < 0) {

        echo $unum . ',猜小了';

    } else {

        $begTime = $list[$uid]['beg_time'] ?? time();
        $time = time() - $begTime;
        echo $unum . ',猜对了 用时:' . $time . ' s';
        //形成一个排名
        $data = [
            'uid' => $uid,
            'num' => $num,
            'time' => $time,
        ];

        $leaderboardPath = 'leaderboard.txt';
        file_put_contents($leaderboardPath, implode(',', $data) . PHP_EOL, FILE_APPEND);
    }
}



