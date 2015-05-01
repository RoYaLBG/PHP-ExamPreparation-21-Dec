<?php
$_GET = array (
    'text' => 'Gambardella, Matthew/XML Developer\'s Guide/Computer/44.95/2000-10-01/An in-depth look at creating applications with XML.
Ralls, Kim/Midnight Rain/Fantasy/19.15/2000-12-16/A former architect battles corporate zombies, an evil sorceress, and her own childhood to become queen of the world.
Corets, Eva/Maeve Ascendant/Fantasy/6.95/2000-11-17/After the collapse of a nanotechnology society in England, the young survivors lay the foundation for a new society.
Corets, Eva/Oberon\'s Legacy/Fantasy/5.00/2001-03-10/In post-apocalypse England, the mysterious agent known only as Oberon helps to create a new life for the inhabitants of London. Sequel to Maeve Ascendant.
Randall, Cynthia/Lover Birds/Romance/5.95/2000-09-02/When Carla meets Paul at an ornithology conference, tempers fly as feathers get ruffled.
Thurman, Paula/Splish Splash/Romance/4.95/2000-11-02/A deep sea diver finds true love twenty thousand leagues beneath the sea.
O\'Brien, Tim/Microsoft .NET: The Programming Bible/Computer/36.95/2000-12-09/Microsoft\'s .NET initiative is explored in detail in this deep programmer\'s reference.
O\'Brien, Tim/MSXML3: A Comprehensive Guide/Computer/6.95/2000-12-01/The Microsoft MSXML3 parser is covered in detail, with attention to XML DOM interfaces, XSLT processing, SAX and more.',
    'min-price' => '5.00',
    'max-price' => '10.45',
    'sort' => 'genre',
    'order' => 'ascending',
);
?>

<?php
date_default_timezone_set('Europe/Sofia');
$criteria = ['genre' => 2, 'author' => 0, 'publish-date' => 4];

$data = preg_split("/\n+/", $_GET['text'], -1, PREG_SPLIT_NO_EMPTY);
$books = [];

foreach ($data as $row) {
    $books[] = preg_split("/\//", $row, -1, PREG_SPLIT_NO_EMPTY);
}

var_dump( floatval('banica') > '25kifla' );
$books = array_filter($books, function($b) {
    return $b[3] >= $_GET['min-price'] && $b[3] <= $_GET['max-price'];
});



usort($books, function($a, $b) use ($criteria) {
    $index = $criteria[$_GET['sort']];
    $compare = strcmp($a[$index], $b[$index]); //
    if ($compare == 0) {
        return date_create($a[4]) > date_create($b[4]);
    }

    if ($_GET['order'] == 'descending') {
        return $compare * -1;
    }

    return $compare;
});

foreach ($books as $book) {
    echo "<div><p>" . htmlspecialchars(trim($book[1])) . "</p>";
    echo "<ul><li>".htmlspecialchars(trim($book[0]))."</li>";
    echo "<li>" .htmlspecialchars(trim($book[2])) . "</li>";
    echo "<li>" . trim($book[3]) . "</li>";
    echo "<li>" . htmlspecialchars(trim($book[4])) . "</li>";
    echo "<li>" . htmlspecialchars(trim($book[5])) . "</li>";
    echo "</ul></div>";
}

