<?php

class Task
{
  private $connection;
  private $database_table = 'tasks';

  public $id;
  public $title;
  public $description;
  public $status;
  public $timelimit;
  public $created_at;
  public $updated_at;

  public function __construct($db)
  {
    $this->connection = $db;
  }

  public function getTasks()
  {
    $sqlQuery = "SELECT * FROM " . $this->database_table . "";
    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
  }

  public function createTask()
  {
    $sqlQuery = "INSERT INTO
      " . $this->database_table . "
      SET
        title = :title, 
        description = :description, 
        status = :status, 
        timelimit = :timelimit,
        created_at = :created_at";

    $stmt = $this->connection->prepare($sqlQuery);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->timelimit = htmlspecialchars(strip_tags($this->timelimit));
    $this->created_at = date('Y-m-d H:i:s');

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":timelimit", $this->timelimit);
    $stmt->bindParam(":created_at", $this->created_at);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function updateTask()
  {
    $sqlQuery = "UPDATE
      " . $this->database_table . "
      SET
        title = :title, 
        description = :description, 
        status = :status,
        timelimit = :timelimit
      WHERE 
        id = :id";


    $stmt = $this->connection->prepare($sqlQuery);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->timelimit = htmlspecialchars(strip_tags($this->timelimit));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":timelimit", $this->timelimit);
    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function getSingleTask()
  {
    $sqlQuery = "SELECT
      id, 
      title, 
      description, 
      timelimit,
      status
    FROM
      " . $this->database_table . "
    WHERE 
      id = ?
    LIMIT 0,1";

    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->title = $dataRow['title'];
    $this->description = $dataRow['description'];
    $this->status = $dataRow['status'];
    $this->created_at = $dataRow['created_at'];
  }


  public function deleteTask()
  {
    $sqlQuery = "DELETE FROM " . $this->database_table . " WHERE id = ?";
    $stmt = $this->connection->prepare($sqlQuery);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
