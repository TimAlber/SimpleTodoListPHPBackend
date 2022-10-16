<?php

namespace ppa\Controller;

use ppa\Model\DataModel;

class DataController
{
    private $dataModel;

    public function __construct()
    {
        $this->dataModel = new DataModel();
    }

    public function testApi() {
        echo "Api Online";
    }

    public function addtodos() {
        $logValue = filter_input(INPUT_GET, 'todo', FILTER_SANITIZE_STRING);
        $this->dataModel->instertNewTodo($logValue);
        $successMsg =["success"=>"true", "message" => "Dataset was added to the Database successfully.", "status" =>"200"];
        echo json_encode($successMsg);
    }

    public function getallTodos() {
        $todos = $this->dataModel->getAllTodos();
        echo json_encode($todos);
    }

    public function setTodoDone(){
        $todoId = filter_input(INPUT_GET, 'todoId', FILTER_SANITIZE_STRING);
        $this->dataModel->setTodoDone($todoId);
        $successMsg =["success"=>"true", "message" => "Dataset was changed in the Database successfully.", "status" =>"200"];
        echo json_encode($successMsg);
    }

    public function setTodoNotDone(){
        $todoId = filter_input(INPUT_GET, 'todoId', FILTER_SANITIZE_STRING);
        $this->dataModel->setTodoNotDone($todoId);
        $successMsg =["success"=>"true", "message" => "Dataset was changed in the Database successfully.", "status" =>"200"];
        echo json_encode($successMsg);
    }

    public function deleteTodo(){
        $todoId = filter_input(INPUT_GET, 'todoId', FILTER_SANITIZE_STRING);
        $this->dataModel->deleteTodo($todoId);
        $successMsg =["success"=>"true", "message" => "Dataset was deleted in the Database successfully.", "status" =>"200"];
        echo json_encode($successMsg);
    }
}