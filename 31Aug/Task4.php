<?php
$_GET = array (
    'column' => 'username',
    'order' => 'descending',
    'students' => 'Pesho, pesho.g@gmail.com, onsite, 400
Mariika, mariika@gmail.com, online, 350
Geri, geri@gmail.com, online, 50
Pesho, peshkata@gmail.com, onsite, 0
Gosho & Kiro, gosho@gmail.com, onsite, 400
Mincho, praznikov@vremeto.bg, online, 50',
);
?>

<?php
$data = explode("\n", $_GET['students']);

$students = [];
$id = 1;
$columns = [];
$ids = [];
foreach ($data as $k => $row) {
    if (empty($row)) continue;
    $student = explode(", ", $row);
    $students[$k] = [
        'id' => $id++,
        'username' => htmlspecialchars($student[0]),
        'email' => htmlspecialchars($student[1]),
        'type' => htmlspecialchars($student[2]),
        'result' => htmlspecialchars(trim($student[3]))
    ];
    $columns[] = $students[$k][$_GET['column']];
    $ids[] = $students[$k]['id'];
}
$sort = $_GET['order'] == 'descending' ? SORT_DESC : SORT_ASC;
array_multisort($columns, $sort, $ids, $sort, $students);
echo "<table><thead><tr><th>Id</th><th>Username</th><th>Email</th><th>Type</th><th>Result</th></tr></thead>";
foreach ($students as $student) {
    $id = (($student['id']));
    $name = (($student['name']));
    $email = (($student['email']));
    $type = (($student['type']));
    $result = $student['result'];
    echo "<tr><td>$id</td><td>$name</td><td>$email</td><td>$type</td><td>$result</td></tr>";
}
echo "</table>";
//usort($students, function($a, $b) {
//    $multiplier = 1;
//    $idCompare = $a['id'] > $b['id'] ? 1 : -1;
//    if ($_GET['order'] == 'descending') {
//        $multiplier = -1;
//    }
//    if ($_GET['column'] == 'id') {
//        return $idCompare * $multiplier;
//    } else {
//        if ($_GET['column'] == 'result') {
//            $compare = 0;
//            if ($a[$_GET['column']] > $b[$_GET['column']]) {
//                $compare = 1;
//            } elseif ($a[$_GET['column']] < $b[$_GET['column']]) {
//                $compare = -1;
//            }
//            if ($compare == 0) {
//                return $idCompare * $multiplier;
//            }
//            return $compare * $multiplier;
//        } else {
//            $compare = strcmp($a[$_GET['column']], $b[$_GET['column']]);
//            if ($compare == 0) {
//                return $idCompare * $multiplier;
//            }
//            return $compare * $multiplier;
//        }
//
//    }
//});




