<?php

require_once __DIR__ . "/../config.php";

class BaseDao
{
  protected $conn;
  private $table;

  public function __construct($table)
  {
    $this->table = $table;
    try {
      $this->conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT,
        DB_USER,
        DB_PASSWORD,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } catch (PDOException $e) {
      throw $e;
    }
  }

  protected function query($query, $params)
  {
    $statement = $this->conn->prepare($query);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function query_unique($query, $params)
  {
    $results = $this->query($query, $params);
    return reset($results);
  }

  protected function execute($query, $params)
  {
    $prepared_statement = $this->conn->prepare($query);
    if ($params) {
      foreach ($params as $key => $param) {
        $prepared_statement->bindValue($key, $param);
      }
    }
    $prepared_statement->execute();
    return $prepared_statement;
  }

  public function insert($table, $entity)
  {
    $query = "INSERT INTO {$table} (";
    // INSERT INTO users (
    foreach ($entity as $column => $value) {
      $query .= $column . ", ";
    }
    // INSERT INTO users (first_name, last_name, 
    $query = substr($query, 0, -2);
    // INSERT INTO users (first_name, last_name
    $query .= ") VALUES (";
    // INSERT INTO users (first_name, last_name) VALUES (
    foreach ($entity as $column => $value) {
      $query .= ":" . $column . ", ";
    }
    // INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name, 
    $query = substr($query, 0, -2);
    // INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name
    $query .= ")";
    // INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name)

    $statement = $this->conn->prepare($query);
    $statement->execute($entity); // SQL injection prevention
    $entity['id'] = $this->conn->lastInsertId();
    return $entity;
  }
}