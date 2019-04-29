<?php

class DBFactory
{
    private static $db;
    
    
    
    
    public static function getDBO()
    {
        $dbname = 'quiz_component';
        $host = 'localhost';
        $user = 'root';
        $pass = '123456';
        $charset = 'utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        if (!self::$db)
            self::$db = new PDO($dsn, $user, $pass, $options);

        return self::$db;
    }
}
?>