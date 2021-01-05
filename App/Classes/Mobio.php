<?php

/**
 *
 * @class Mobio
 * @created 4.1.2021 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Mobio
{
    /**
     * Mobio constructor.
     * @param $servID
     * @param $code
     * @param int $debug
     */
    public static function CheckCode($servID, $code, $debug = 0): int
    {
        $res_lines = file("http://www.mobio.bg/code/checkcode.php?servID=$servID&code=$code");
        $ret = 0;
        if ($res_lines) {
            if (strstr("PAYBG=OK", $res_lines[0])) {
                $ret = 1;
            } else {
                if ($debug) echo $line . "\n";
            }
        } else {
            if ($debug) echo "Unable to connect to mobio.bg server.\n";
            $ret = 0;
        }
        return $ret;
    }
}