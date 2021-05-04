<?php

function searchForCoin(&$pair) {
    $coins = array(
        // Fiat
        "EUR",
        "USD",

        // Stablecoins
        "USDT",
        "USDC",
        "BUSD",

        // Normal coins
        "BTC",
        "ETH",
        "REEF",
        "LINA",
        "TRU",
        "BCH",
        "ZEC",
        "ETC",
        "WTC",
        "XRP",
        "STRAX",
        "DODO",
        "BNB",
        "VIBE",
        "ADA",
        "DOGE",
        "CAKE",
        "POPE",
        "BEL",
        "ANT",
        "WING",
        "XTZ",
        "ARK",
        "OMG",
        "XVG",
        "XLM",
        "JUV",
        "CRV",
    );

    foreach ($coins as $coin) {
        $shortenedPair = substr($pair, 0, 5);
        if(strpos($shortenedPair, $coin) !== false) {
            $pair = str_replace($coin, "", $pair);
            return $coin;
        }
    }
}

function extractPairAsArray($pairString) {
    $first = searchForCoin($pairString);
    // First has been removed by reference
    $second = $pairString;

    return [$first, $second];
}

$filePath = "./test.csv";

$file = fopen($filePath, "r");

$fileSize = filesize($filePath);

if($file) {

    $row = 0;

    while (($data = fgetcsv($file))) {
        if($row > 0) {
            $num = count($data);
            echo "<p> $num champs à la ligne $row: <br /></p>\n";
            for ($c=0; $c < $num; $c++) {

                // Date
                if($c == 0 || $c == 7) {
                    echo date("Y F jS - G:i:s", strtotime($data[$c])) . "<br />\n";
                }
                // Pair
                else if($c == 2) {
                    $pairArray = extractPairAsArray($data[$c]);
                    echo $pairArray[0] . " / " . $pairArray[1]  . "<br />\n";
                }
                // Other
                else {
                    echo $data[$c] . "<br />\n";
                }
            }
        }
        $row++;
    }

    fclose($file);
}
else {
    echo("Error opening file");
}
