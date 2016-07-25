<?php

// ** Created by Bill Radja Pono on 07/23/2016

include "./includes/includes.php";

$selection = new InputSelect();

$selection->setKeyValuePairArrayMap(
        array(
            "satu" => "1",
            "dua" => "2",
            "tiga" => "3"
        )
);

$selection->setKeyValuePair("empat", "4");
$selection->setKeyValuePair("lima", "5");
$selection->setKeyValuePair("enam", "6");

print_r($selection->getKeyValuePair());

echo "<p>";

$selection->createKeyValueSelection("coba");

echo "<p>";

$fullstring = "[coba]";

echo getStringBetween($fullstring, "[", "]") . "<p>";

if (isInString($fullstring, "coba")) {
    echo "TRUE";
} else {
    echo "FALSE";
}

//$array_of_strings = "empat:4,lima:5,enam:6";
//$strings = explode(",",$array_of_strings);
////print_r($strings);
//$array = array();
//foreach ($strings as $string) {
//    preg_match_all("/ ([^:]+) : ([^,]+) /x", $string, $p);
////    array_push($array, array_combine($p[1], $p[2]));
//    $array[$p[1]] = $p[2];
//}
//print_r($array);



print_r($keyValuePair);