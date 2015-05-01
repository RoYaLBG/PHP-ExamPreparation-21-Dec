<?php
$_GET = array (
    'jsonTable' => '[["xx","a","a","a","a","a","a"],["a","a","z","z","a","php","a"],["a","a","x","x","a","a","a"],["xx","a","sql","a","a","js","a"],["xx","a","a","a","a","a","a"],["xx","a","z","z","a","php","w"]]',
);

$matrix = json_decode($_GET['jsonTable']);
//var_dump($matrix);


$maxArea = 0;
$maxRowEnd = 0;
$minRowEnd = 0;
$maxColEnd = 0;
$minColEnd = 0;
for ($minRow = 0; $minRow < count($matrix); $minRow++) {
    for ($maxRow = $minRow; $maxRow < count($matrix[$minRow]); $maxRow++) {
        for ($minCol = 0; $minCol < count($matrix[$minRow]); $minCol++) {
            for ($maxCol = $minCol; $maxCol < count($matrix[$minRow]); $maxCol++) {
                if (rectangle($matrix, $minRow, $maxRow, $minCol, $maxCol)) {
                    $area = (($maxRow - $minRow) + 1) * (($maxCol - $minCol) + 1);
                    if ($area > $maxArea) {
                        $maxArea = $area;
                        $maxRowEnd = $maxRow;
                        $minRowEnd = $minRow;
                        $maxColEnd = $maxCol;
                        $minColEnd = $minCol;
                    }
                }
            }
        }
    }
}


echo "<table border='1' cellpadding='5'>";
for ($i = 0; $i < count($matrix); $i++) {
    echo '<tr>';
    for ($j = 0; $j < count($matrix[$i]); $j++) {
        $color = "";
        if ($i >= $minRowEnd && $i <= $maxRowEnd && $j == $minColEnd) {
            $color = " style='background:#CCC'";
        }
        if ($i == $maxRowEnd && $j >= $minColEnd && $j <= $maxColEnd) {
            $color = " style='background:#CCC'";
        }
        if ($i == $minRowEnd && $j >= $minColEnd && $j <= $maxColEnd) {
            $color = " style='background:#CCC'";
        }
        if ($i >= $minRowEnd && $i <= $maxRowEnd && $j == $maxColEnd) {
            $color = " style='background:#CCC'";
        }
        echo '<td'.$color.'>' . htmlspecialchars($matrix[$i][$j]) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

function rectangle($matrix, $minR, $maxR, $minC, $maxC) {
    $initialChar = $matrix[$minR][$minC];
    for ($r = $minR; $r < $maxR; $r++) {
        if ($matrix[$r][$minC] != $initialChar) {
            return false;
        }
        if ($matrix[$r][$maxC] != $initialChar) {
            return false;
        }
    }

    for ($c = $minC; $c < $maxC; $c++) {
        if ($matrix[$minR][$c] != $initialChar) {
           return false;
        }
        if ($matrix[$maxR][$c] != $initialChar) {
            return false;
        }
    }

    return true;
}
