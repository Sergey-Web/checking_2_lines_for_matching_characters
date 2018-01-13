<?php
declare(strict_types=1);

class CheckStr {

    static private $_arrString;
    static private $_arrCheckString;
    static private $_result = FALSE;

    static private function _trimCompbinationStr(string $string)
    {
        $arrLetter = str_split(str_replace(' ', '', $string));
        $arrGroupLetter = [];

        foreach($arrLetter as $letterKey => $letter) {
            if(array_key_exists($letter, $arrGroupLetter)) {
                $arrGroupLetter[$letter] = ++$arrGroupLetter[$letter];
                continue;
            }
            $arrGroupLetter[$letter] = 1;
        }

        return $arrGroupLetter;
    }

    static private function _stringComparison()
    {
        if(count(self::$_arrString) !== count(self::$_arrCheckString)) {
            return FALSE;
        }

        foreach(self::$_arrString as $stringKey => $stringVal) {
            if(!array_key_exists($stringKey, self::$_arrCheckString) 
                || $stringVal !== self::$_arrCheckString[$stringKey]) {
                return FALSE;
            }
        }

        return self::$_result = TRUE;
    }

    static public function handler(string $string, string $checkString)
    {
        self::$_arrString = self::_trimCompbinationStr($string);
        self::$_arrCheckString = self::_trimCompbinationStr($checkString);
        self::_stringComparison();

        return self::$_result;
    }
}

//print_r(CheckStr::handler('clockwise', 'clockwork'));