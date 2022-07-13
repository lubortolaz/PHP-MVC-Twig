<?php 

namespace App\Core\Helper;

use DateTime;

/**
 * Some usefull functions
 */
class Utils
{
    /**
     * Sanitizing data
     * @param $data string : the data to sanitize
     * @return string : the data sanitized
     */
    public static function sanitize($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}