<?php
    class DBC{
        $file;
        $connection;
        $is_connected;
        function __construct($file){
            $this->file = $file;
            $this->user = $user;
            $this->password = password;            
        }
        
        function connect(){
            if(!$this->is_connected){            
               this->connection = sqlite_open($file, 0666, $sqlite_error);
                if(!$this->connection)
                {
                    die(“Errore Sqlite: “.$sqlite_error);
                }
                $this->is_connected = true;
        }
        function disconnect(){
            if($is_connected)
                sqlite_close($this->connection);
        }
        
        function query($query){
            if(!$this->is_connected)
                return false;
            else{
                return sqlite_query($this->connection, $query);
            }
        }
    }
?>