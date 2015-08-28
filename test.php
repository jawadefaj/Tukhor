<?
$element1 = array('key1' => 4, 'key2' => 'hey');
$element2 = array('key1' => 5, 'key2' => 'heyy');
$arr = array($element1,$element2);
echo array_search(array('key1' => 4, 'key2' => 'hey'), $arr);