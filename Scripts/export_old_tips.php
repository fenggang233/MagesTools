<?php
function f2h($str)
{
    $arr = array(
        '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
        '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
        'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
        'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
        'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
        'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
        'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
        'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
        'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
        'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
        'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
        'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
        'ｙ' => 'y', 'ｚ' => 'z', '（' => '(', '）' => ')',
        '〔' => '[', '〕' => ']', '【' => '[', '】' => ']',
        '〖' => '[', '〗' => ']', '“' => '[', '”' => ']', '‘' => '[',
        '’' => ']', '｛' => '{', '｝' => '}', '《' => '<', '》' => '>',
        '％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-',
        '：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.',
        '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|',
        '”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"',
        '　' => ' ', '＄' => '$', '＠' => '@', '＃' => '#', '＾' => '^', '＆' => '&',
        '＊' => '*', '＂' => '"'
    );
    return strtr($str, $arr);
}

$data = json_decode(file_get_contents('local/tips_old.json'), true);
$result = array();
for ($i = 0; $i < count($data); $i += 5) {
    $xd = array(
        'category' => f2h($data[$i][0]),
        'content' => f2h($data[$i + 4][0]),
        'name' => f2h($data[$i + 1][0]),
        'extra' => f2h($data[$i + 2][0]),
        'sort_key' => $data[$i + 3][0]
    );
    while (isset($data[$i + 5]) && mb_strlen($data[$i + 5][0]) > 15) {
        $xd['content'] .= "\n" . $data[$i + 5][0];
        $i++;
    }
    $result[] = $xd;
}
file_put_contents('local/tips_old.json', json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));