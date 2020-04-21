<?php 

class Database {

    private static $server = "mysql:host=localhost;dbname=fascalab_2020;port=3306";
    private static $user = "fascalab_2020";
    private static $pass = "w]zYV6X9{*BN";
 
    private static $options = array(
       \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
       \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    );
 
    protected static $connection;
 
    public static function openConnection()
    {
       try 
       {
          self::$connection = new \PDO(self::$server, self::$user, self::$pass, self::$options);
          return self::$connection;
       } 
       catch (PDOException $e) 
       {
          echo "There is some problem in connection: " . $e->getMessage();
       }
    }
 
    public function closeConnection()
    {
       $this->connection = null;
    }
    
 }

 ?>