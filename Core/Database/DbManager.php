<?php 

namespace App\Core\Database;

use PDO;

/**
 * Manage the database connection
 */
abstract class DbManager{

    protected $db;

    // constants from config file
    const HOST = DB_HOST;
    const DATABASE = DB_NAME;
    const USER = DB_USER;
    const PASSWORD = DB_PASS;

    public function __construct(){

        $this->db = new PDO(
                'mysql:host='.self::HOST.';dbname='.self::DATABASE.';charset=utf8',
                self::USER,
                self::PASSWORD);

        $this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

        $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    }

}