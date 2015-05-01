<?php
$_GET = array (
    'jsonTable' => '[[""],[7,2]]',
);
?>

<?php
// all letters are capital
// 0 x 0 default size

$m = 26;
// $k -> 0; S -> 1
// ord('A') - 65; // $x

$input = json_decode($_GET['jsonTable'], true);

$words = $input[0];
$k = $input[1][0];
$s = $input[1][1];

$newWords = [];
$longestWord = 0;
foreach ($words as $word) {
    $word = strtoupper($word);
    $currWord = "";
    for ($i = 0; $i < strlen($word); $i++) {
        if (ord($word[$i]) - 65 < 0 || ord($word[$i]) - 65 > 25) {
            $currWord .= $word[$i];
        } else {
            $currCharCode = ord($word[$i]) - 65;
            $cipheredChar = ($k * $currCharCode + $s) % $m;
            $currWord .= chr($cipheredChar + 65);
        }
    }
    $newWords[] = $currWord;
    if (strlen($currWord) > $longestWord) {
        $longestWord = strlen($currWord);
    }
}

$rows = count($newWords);
$cols = $longestWord;

echo "<table border='1' cellpadding='5'>";
if (count($words) == 0) {
    echo "<tr><td></td></tr>";
}
foreach ($newWords as $word) {
    echo "<tr>";
    if (strlen($word) == 0) {
        echo "<td></td>";
    }
    for ($i = 0; $i < strlen($word); $i++) {
        $color = '';
        if (trim($word[$i]) != "") $color = " style='background:#CCC'";
        echo "<td{$color}>{$word[$i]}</td>";
    }
    for ($j = $i; $j < $cols; $j++) {
        echo "<td></td>";
    }
    echo "</tr>";
}
echo "</table>";


