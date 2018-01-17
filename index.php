<?php
declare(strict_types=1);

$str1 = 'acloackwisewisewiezz';
$str2 = 'aclockwiseawisewizze';

class StrHandler{
    static private $_str1;
    static private $_str2;

    static public function get($str1, $str2)
    {
        self::$_str1 = $str1;
        self::$_str2 = $str2;

        return self::_checkStr();
    }

    static private function _splitStr($str)
    {
        return str_split(str_replace(' ','', $str));
    }

    static private function _groupArrLetter($arr)
    {
        $arrLetter = [];

        foreach($arr as $keyLetter => $letter) {
            if(isset($arrLetter[$letter])) {
                $arrLetter[$letter] = ++$arrLetter[$letter];
                continue;
            }
            $arrLetter[$letter] = 1;
        }

        return $arrLetter;
    }

    static private function _checkStr()
    {
        $strSplit1 = self::_splitStr(self::$_str1);
        $strSplit2 = self::_splitStr(self::$_str2);

        $arrGroupLetter1 = self::_groupArrLetter($strSplit1);
        $arrGroupLetter2 = self::_groupArrLetter($strSplit2);

        if(array_diff_key($arrGroupLetter1, $arrGroupLetter2)
            || array_diff_key($arrGroupLetter2, $arrGroupLetter1)) {
                return FALSE;
        }

        foreach($arrGroupLetter1 as $letter => $countLetter) {
            if($arrGroupLetter1[$letter] !== $arrGroupLetter2[$letter]) {
                return FALSE;
            }
        }

        return TRUE;
    }
}

print_r(StrHandler::get($str1, $str2));