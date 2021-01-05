<?php

/**
 *
 * @class Config
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Config
{
    /**
     * @param null $path
     * @return false|mixed|string
     */
    public static function GET($path = null)
    {
        if ($path) {
            if (!isset($GLOBALS['project'])) {
                return '5';
            }

            $config = $GLOBALS['project'];

            $path = explode('/', $path);

            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}