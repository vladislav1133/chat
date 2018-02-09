<?php


namespace App\Services;


class ColorGenerateService
{
    /**
     * Generate hex code
     *
     * @return string
     */
    public static function getHex()
    {

        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

        $color = '#'.$rand[rand(0,15)].'0'.$rand[rand(0,15)].'0'.$rand[rand(0,15)].'0';

        return $color;
    }
}