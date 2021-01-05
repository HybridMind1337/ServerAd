<?php

/**
 *
 * @class Main
 * @created 1.1.2021 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Main
{
    protected $db;

    public function __construct()
    {
        $this->db = new Queries();
    }

    /**
     * @return mixed|string
     */
    public static function getUserIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    /**
     * @param $str
     * @param int $limit
     * @param false $bekind
     * @param null $maxkind
     * @param null $end
     * @return false|mixed|string
     */
    public static function truncate_chars($str, $limit = 15, $bekind = false, $maxkind = NULL, $end = NULL)
    {
        if (empty($str) || gettype($str) != 'string') {
            return false;
        }
        $end = empty($end) || gettype($end) != 'string' ? '...' : $end;
        $limit = intval($limit) <= 0 ? 15 : intval($limit);
        if (mb_strlen($str, 'UTF-8') > $limit) {
            if ($bekind == true) {
                $maxkind = $maxkind == NULL || intval($maxkind) <= 0 ? 5 : intval($maxkind);
                $chars = preg_split('/(?<!^)(?!$)/u', $str);
                $cut = mb_substr($str, 0, $limit, 'UTF-8');
                $buffer = '';
                $total = $limit;
                for ($i = $limit; $i < count($chars); $i++) {
                    if (!($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i]))) {
                        if ($maxkind > 0) {
                            $maxkind--;
                            $buffer = $buffer . $chars[$i];
                        } else {
                            $buffer = !($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i])) ? '' : $buffer;
                            $total = !($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i])) ? 0 : ($total + 1);
                            break;
                        }
                        $total++;
                    } else {
                        break;
                    }
                }
                return $total == mb_strlen($str, 'UTF-8') ? $str : ($cut . $buffer . $end);
            }
            return mb_substr($str, 0, $limit, 'UTF-8') . $end;
        } else {
            return $str;
        }
    }
}