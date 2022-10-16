<?php

namespace ppa\Model;

class DataModel extends Database {


    public function getAllTodos(){
        $sql = "SELECT * FROM todos;";

        $pdo = $this->linkDB();

        try {
            $res = $pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $res->execute();
        } catch (\PDOException $e) {
            new \ppa\Library\Msg("Ihre Anfrage konnte nicht verarbeitet werden", $e); 
            die;
        }

        return $res->fetchAll(\PDO::FETCH_OBJ);
    }

    public function instertNewTodo($todo)
    {
        $guid = $this->createUUID();
        $done = 'false';

        date_default_timezone_set('Europe/Berlin');
        $created = date('Y-m-d H:i:s');

        $sql = "INSERT INTO todos (`id`, `todo`, `done`, `changed`, `created`) VALUES (:id, :todo, :done, :changed, :created)";

        $pdo = $this->linkDB();

        try {
            $res = $pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $res->execute(array(':id' => $guid, ':todo' => $todo, ':done' => $done, ':changed' => $created, ':created' => $created));
        } catch (\PDOException $e) {
            new \ppa\Library\Msg("Fehler beim Schreiben der Daten.", $e); 
            die;
        }
    }

    public function setTodoDone($todoId){
        date_default_timezone_set('Europe/Berlin');
        $changed = date('Y-m-d H:i:s');

        $done = 'true';
        $sql = "UPDATE todos SET done = :done, changed = :changed WHERE id= :todoId";

        $pdo = $this->linkDB();

        try {
            $res = $pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $res->execute(array(':done' => $done, ':changed' => $changed, ':todoId' => $todoId));
        } catch (\PDOException $e) {
            new \ppa\Library\Msg("Fehler beim Schreiben der Daten.", $e); 
            die;
        }
    }

    public function setTodoNotDone($todoId){
        date_default_timezone_set('Europe/Berlin');
        $changed = date('Y-m-d H:i:s');

        $done = 'flase';
        $$sql = "UPDATE todos SET done = :done, changed = :changed WHERE id= :todoId";

        $pdo = $this->linkDB();

        try {
            $res = $pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $res->execute(array(':done' => $done, ':changed' => $changed, ':todoId' => $todoId));
        } catch (\PDOException $e) {
            new \ppa\Library\Msg("Fehler beim Schreiben der Daten.", $e); 
            die;
        }
    }

    public function deleteTodo($todoId){
        $sql = "DELETE FROM todos WHERE id= :todoId";

        $pdo = $this->linkDB();

        try {
            $res = $pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $res->execute(array(':todoId' => $todoId));
        } catch (\PDOException $e) {
            new \ppa\Library\Msg("Fehler beim Schreiben der Daten.", $e); 
            die;
        }
    }
}