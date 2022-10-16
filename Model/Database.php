<?php

// CREATE TABLE IF NOT EXISTS `todos` (
//     `id` varchar(255) NOT NULL,
//     `todo` varchar(255) NOT NULL,
//     `done` varchar(255) NOT NULL,
//     `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

namespace ppa\Model;

use ppa\Library\Msg;

abstract class Database {
    
    /**
     * Zugangsdaten für die Datenbank 
     */
    private $dbName = "todo_backend"; //Datenbankname
    private $linkName = "localhost"; //Datenbank-Server
    private $user = "root"; //Benutzername
    private $pw = "root"; //Passwort
    
    /**
     * Stellt eine Verbindung zur Datenbank her
     * 
     * @return \PDO Gibt eine Datenbankverbindung zurueck
     */
    public function linkDB() {
        try {
            $pdo = new \PDO("mysql:dbname=$this->dbName;host=$this->linkName"
                , $this->user
                , $this->pw
                , array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $pdo;
        } catch (\PDOException $e) {
            new Msg(true, null, $e);
        }
    }

    /**
     * Zum serverseitigen generieren einer UUID
     * 
     * @return string Liefert eine UUID
     */
    public function createUUID()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    } 
}