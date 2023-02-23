<?php

class QueryBuilder extends Connection {
    
    protected $dbh;
    protected static $sql,$data,$res,$count;
    
    public function __construct() {
        $this->dbh = $this->make();;
    }

    public function get() 
    {
        return self::$data = self::$res -> fetchAll(PDO::FETCH_OBJ);
    }
    public function getOne() 
    {
        return self::$data = self::$res -> fetch(PDO::FETCH_OBJ);
    }

    public function raw($sql)  // DB::raw("select * from users")->getOne();
    {
        self::$sql = $sql;
        $this->query();
        return $this;
    }
    public function query($exe=[]) 
    {
        self::$res = $this->dbh->prepare(self::$sql);
        self::$res -> execute($exe);
        return $this;
    }

// -----------------------------------------------------------------------------------------------------------//

    public function selectAll($table) {
        $query = "select * from $table";
        self::$res = $this->dbh->prepare($query);
        self::$res->execute();
        return $this;
    }

    public function insert(array $data,$table) {
        $dataKeys = array_keys($data);
        $dataValues = array_values($data);
        $cols = implode(",",$dataKeys);
        $q = "";
        foreach($dataKeys as $key) {
            $q .= "?,";
        }
        $values = trim($q,",");
        $query = "insert into $table ($cols) values ($values)";
        $statement = $this->pdo->prepare($query);
        $statement->execute($dataValues);
    }

}

