<?php

class NumHash
{
    private static $SALT = 0xd0c0adbf;

    public static function encrypt($n) {
        return (PHP_INT_SIZE == 4 ? self::encrypt32($n) : self::encrypt64($n)) ^ self::$SALT;
    }

    public static function decrypt($n) {
        $n ^= self::$SALT;
        return PHP_INT_SIZE == 4 ? self::decrypt32($n) : self::decrypt64($n);
    }

    public static function encrypt32($n) {
        return ((0x000000FF & $n) << 24) + (((0xFFFFFF00 & $n) >> 8) & 0x00FFFFFF);
    }

    public static function decrypt32($n) {
        return ((0x00FFFFFF & $n) << 8) + (((0xFF000000 & $n) >> 24) & 0x000000FF);
    }

    public static function encrypt64($n) {
        /*
        echo PHP_EOL . $n . PHP_EOL;
        printf("n   :%20X\n", $n);
        printf("<<  :%20X\n", (0x000000000000FFFF & $n) << 48);
        printf(">>  :%20X\n", (0xFFFFFFFFFFFF0000 & $n) >> 16);
        printf(">>& :%20X\n", ((0xFFFFFFFFFFFF0000 & $n) >> 16) & 0x0000FFFFFFFFFFFF);
        printf("=   :%20X\n", ((0x000000000000FFFF & $n) << 48) + (((0xFFFFFFFFFFFF0000 & $n) >> 16) & 0x0000FFFFFFFFFFFF));
        /* */
        return ((0x000000000000FFFF & $n) << 48) + (((0xFFFFFFFFFFFF0000 & $n) >> 16) & 0x0000FFFFFFFFFFFF);
    }

    public static function decrypt64($n) {
        /*
        echo PHP_EOL;
        printf("n   :%20X\n", $n);
        printf("<<  :%20X\n", (0x0000FFFFFFFFFFFF & $n) << 16);
        printf(">>  :%20X\n", (0xFFFF000000000000 & $n) >> 48);
        printf(">>& :%20X\n", ((0xFFFF000000000000 & $n) >> 48) & 0x000000000000FFFF);
        printf("=   :%20X\n", ((0x0000FFFFFFFFFFFF & $n) << 16) + (((0xFFFF000000000000 & $n) >> 48) & 0x000000000000FFFF));
        /* */
        return ((0x0000FFFFFFFFFFFF & $n) << 16) + (((0xFFFF000000000000 & $n) >> 48) & 0x000000000000FFFF);
    }
}