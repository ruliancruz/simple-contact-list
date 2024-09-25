<?php
class Contact
{
  private $atributes = [];

  public function __construct() {}

  public function __set(string $atribute, $value)
  {
    $this->atributes[$atribute] = $value;
    return $this;
  }

  public function __get(string $atribute)
  {
    return $this->atributes[$atribute] ?? null;
  }

  public function __isset($atribute)
  {
    return isset($this->atributes[$atribute]);
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