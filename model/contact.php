<?php
require_once "core/database.php";

class Contact
{
  private $attributes = [];

  public function __construct() {}

  public function __set(string $atribute, $value)
  {
    $this->attributes[$atribute] = $value;
  }

  public function __get(string $atribute)
  {
    return $this->attributes[$atribute] ?? null;
  }

  public function __isset($atribute)
  {
    return isset($this->attributes[$atribute]);
  }

  public static function all()
  {
    $sql = "SELECT * FROM contacts";
    $contacts = array();

    Database::useConnection(function($connection) use ($sql, &$contacts)
    {
      $result = $connection->query($sql);

      while($contact = $result->fetchObject(Contact::class))
      {
        $contacts[] = $contact;
      }
    });

    return $contacts;
  }

  public static function count()
  {
    $sql = "SELECT count(*) FROM contacts";
    $count = null;

    Database::useConnection(function($connection) use ($sql, &$count)
    {
      $count = $connection->query($sql)->fetchColumn();
    });

    return $count ? (int) $count : false;
  }

  public static function find($id)
  {
    $sql = "SELECT * FROM contacts WHERE id = :id";
    $contact = false;

    Database::useConnection(function($connection) use ($sql, $id, &$contact)
    {
      $statement = $connection->prepare($sql);
      $statement->bindParam(':id', $id, PDO::PARAM_INT)->execute();

      if($statement->rowCount() > 0)
      {
        $contact = $statement->fetchObject(Contact::class);
      }
    });

    return $contact;
  }

  public static function destroy($id)
  {
    $sql = "DELETE FROM contacts WHERE id = :id";
    $success = false;

    Database::useConnection(function($connection) use ($sql, $id, &$success)
    {
      $statement = $connection->prepare($sql);
      $success = $statement->bindParam(':id', $id, PDO::PARAM_INT)->execute();
    });

    return $success;
  }

  public function save()
  {
    $columns = $this->prepare($this->attributes);
    $sql = $this->saveSQL($columns);
    $count = false;

    Database::useConnection(function($connection) use ($sql, &$count)
    {
      $statement = $connection->prepare($sql);

      if($statement->execute()) { $count = $statement->rowCount(); }
    });

    return $count;
  }

  private function escape(string $data)
  {
    if(is_string($data) & !empty($data))
    {
      return "'" . addslashes($data) . "'";
    } 
    
    if(is_bool($data)) { return $data ? 'TRUE' : 'FALSE'; }
    if($data !== '') { return $data; }

    return 'NULL';
  }
  
  private function prepare($data)
  {
    $result = array();

    foreach($data as $key => $value)
    {
      if(is_scalar($value)) { $result[$key] = $this->escape($value); }
    }

    return $result;
  }

  private function saveSQL($columns)
  {
    if(!isset($this->id)) { return $this->createSQL($columns); }

    return $this->updateSQL($columns);
  }

  private function createSQL($columns)
  {
    $sql = "INSERT INTO contacts (" .
      implode(',', array_keys($columns)) .
      ") VALUES (" .
      implode(',', array_values($columns)) .
      ")";

    return $sql;
  }

  private function updateSQL($columns)
  {
    foreach($columns as $key => $value)
    {
      if($key !== 'id') { $set[] = "{$key}={$value}"; }
    }

    return "UPDATE contacts SET " .
           implode(',', $set) .
           " WHERE id={$this->id}";
  }
}
?>