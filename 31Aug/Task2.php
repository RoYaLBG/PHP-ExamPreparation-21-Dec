<?php
$_GET = array (
    'html' => '  <p class = "section" >
    <div style = "border: 1px" id = "header" >
        Header
        <div id = "nav" >
            <div class="article">
            dsfdgdfg
</div> <!-- article -->
            Nav
        </div>   <!--   nav   -->
    </div>  <!--header-->
  </p> <!-- end paragraph section -->',
);

?>

<?php
// \b(header|footer|nav|article|aside|section)\b
$html = $_GET['html'];
$pattern = <<<HUM
/(<div\s+.*\b(class|id)\b\s*=\s*"\b(header|footer|nav|article|aside|section)\b"\s*.*>)([\S\s]*)(<\s*\/div\s*>\s*<!--\s*(.*)\s*-->)/
HUM;

do {
    preg_match_all($pattern, $html, $matches);
    $toReplace = $matches[0];
    $startLines = $matches[1];
    $attributes = $matches[2];
    $semanticTags = $matches[3];
    $contents = $matches[4];
    $closingTags = $matches[5];
    $closingAttributes = $matches[6];

    foreach ($startLines as $k => $line) {
        $replacement = "";
        $replacement = str_replace("div", $semanticTags[$k], $line);
        $replacement = preg_replace('/'.$attributes[$k].'\s*=\s*"' . $semanticTags[$k] . '"/', "", $replacement);
        $replacement = preg_replace('/\s{2,}/', " ", $replacement);
        $replacement = str_replace(" >", ">", $replacement);
        $replacement = str_replace("< ", "<", $replacement);
        $replacement .= $contents[$k];
        $replacement .= "</{$semanticTags[$k]}>";
        $html = str_replace($toReplace[$k], $replacement, $html);
    }
} while(!empty($matches[0]));

echo $html;


