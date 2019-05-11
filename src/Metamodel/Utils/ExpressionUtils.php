<?php


namespace App\Metamodel\Utils;


use App\Metamodel\Model\DoubleCurlyBrackets;
use App\Metamodel\Model\Text;
use App\Metamodel\Model\Variable;

class ExpressionUtils
{
    public static function createExpressionsFromText($text, $expressions = [])
    {
        if (trim($text) == '') {
            return $expressions;
        }

        if (self::isDoubleCurlyBrackets($text)) {
            return ExpressionUtils::findDoubleCurlyBrackets($text, $expressions);
        }

        return $expressions;
    }

    protected static function isDoubleCurlyBrackets($text)
    {
        preg_match(DoubleCurlyBrackets::REG_EXP, $text, $doubleCurlyBrackets);
        return count($doubleCurlyBrackets) > 0;
    }

    protected static function findDoubleCurlyBrackets($text, $expressions)
    {
        preg_match(DoubleCurlyBrackets::REG_EXP, $text, $doubleCurlyBrackets);

        $text = array_map('trim', explode($doubleCurlyBrackets[0], $text));

        if (is_array($text) && $text[0] != '') {
            array_merge($expressions, self::createExpressionsFromText($text[0]));
        }

        $expressions[] = new DoubleCurlyBrackets(new Variable($doubleCurlyBrackets[1]));

        if (is_array($text) && $text[1] != '') {
            array_merge($expressions, self::createExpressionsFromText($text[1]));
        }

        return $expressions;
    }
}