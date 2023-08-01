<?php
/*

Toute classe du modèle devra impérativement :
- avoir le même nom que la table avec une majuscule
- la table doit avoir une clé primaire nommée "id$table". Exemple : idbeer
- la table doit autoriser les champs nuls
- étendre la classe Model 

*/

class Model
{
    private $primaryKey;
    public static $tempId;

    public function __construct(string $primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    // Retourne un objet chargé depuis la base de données à partir de sont id
    public static function one($id): ?self
    {

        $class = get_called_class();
        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];

        $table = strtoupper($class);
        try {
            $st = db()->prepare("select * from $table where  $primaryKey=:id");
            $st->bindValue(":id", $id);
            $st->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }

        $row = $st->fetch(PDO::FETCH_ASSOC);
        if (!$row)
            return null;
        else {
            $o = new $class();
            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;

                }
            }
            return $o;
        }
    }

    // Retourne le contenu de la table
    public static function all()
    {
        $class = get_called_class();
        $table = strtoupper($class);
        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];

        try {
            $st = db()->prepare("select * from $table");
            $st->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }


        $list = array();
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;

            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;

                }
            }
        }

        return $list;
    }

    public static function find($parametre,$groupBy ="")
    {
        $class = get_called_class();
        $table = strtoupper($class);
        $column = "";

        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];

        $i = 1;
        foreach ($parametre as $key=>$value) {
            if ($i > 1){
                $column .= " AND ";
            }
            $column .= " $key = :a".$i;
            $i++;
        }

        $sql = "SELECT * FROM $table WHERE".$column;
       if (!empty($groupBy)){
           $sql .= " GROUP BY $groupBy";
       }
        try {
            $st = db()->prepare($sql);
            $i = 1;
            foreach ($parametre as $value) {
                $st->bindValue('a'.$i, $value);
                $i++;
            }
            $st->execute();
        } catch (PDOException $exception) {
            echo $sql."\n";
            echo $exception->getMessage();
            die();
        }

        $list = array();
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;

                }
            }
        }

        return $list;
    }


    public function hasMany(string $class, string $primaryKeyTable, string $referenceKey)
    {
        $thisClass = get_called_class();
        $thisTable = strtoupper($thisClass);
        $joinTable = strtoupper($class);

        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];

        try {
            $getColumn = db()->prepare("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = :table");
            $getColumn->bindValue('table', $joinTable);
            $getColumn->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }
        $list = array();
        while ($row = $getColumn->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value)
                $o->$key = $value;
        }

        $sql = 'SELECT b.' . $list[0]->COLUMN_NAME;
        if (count($list) > 1) {
            $list = array_slice($list, 1);
            foreach ($list as $key => $item) {
                $sql .= ', b.' . $item->COLUMN_NAME;
            }
        }
        $sql .= " from $thisTable AS a JOIN $joinTable AS b ON a.$primaryKeyTable = b.$referenceKey WHERE a.$this->primaryKey = :id";

        try {
            $st2 = db()->prepare($sql);
            $st2->bindValue('id', $this->tempId, PDO::PARAM_STR);
            $st2->execute();
        } catch (PDOException $exception) {
            echo $sql. '    ';
            echo $exception->getMessage();
            die();
        }

        $list = array();
        while ($row = $st2->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;

                }
            }
        }

        return $list;
    }


    public function belongsTo(string $class, string $foreignKey, string $localKey): ?self
    {
        $thisClass = get_called_class();
        $thisTable = strtoupper($thisClass);
        $joinTable = strtoupper($class);

        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];
        try {
            $getColumn = db()->prepare("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = :table");
            $getColumn->bindValue('table', $joinTable);
            $getColumn->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }


        $list = array();
        while ($row = $getColumn->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value)
                $o->$key = $value;
        }

        $sql = 'SELECT b.' . $list[0]->COLUMN_NAME;
        if (count($list) > 1) {
            $list = array_slice($list, 1);
            foreach ($list as $key => $item) {
                $sql .= ', b.' . $item->COLUMN_NAME;
            }
        }
        $sql .= " from $thisTable AS a JOIN $joinTable AS b ON a.$foreignKey = b.$localKey WHERE a.$this->primaryKey = :id";

        try {
            $st2 = db()->prepare($sql);
            $st2->bindValue('id', $this->tempId, PDO::PARAM_STR);
            $st2->execute();

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }

        $row = $st2->fetch(PDO::FETCH_ASSOC);
        if (!$row)
            return null;
        else {
            $o = new $class();
            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;
                }
            }
            return $o;
        }
    }


    public function belongsToMany(string $class, string $tableName, string $thisId, string $foreignId)
    {
        $thisClass = get_called_class();
        $thisTable = strtoupper($thisClass);
        $middleTable = strtoupper($tableName);
        $joinTable = strtoupper($class);


        $attrs = get_class_vars($class);
        $primaryKey = $attrs['primaryKey'];

        try {
            $getColumn = db()->prepare("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = :table");
            $getColumn->bindValue('table', $joinTable);
            $getColumn->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }

        $list = array();
        while ($row = $getColumn->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value)
                $o->$key = $value;
        }

        $sql = 'SELECT b.' . $list[0]->COLUMN_NAME;
        if (count($list) > 1) {
            $list = array_slice($list, 1);
            foreach ($list as $key => $item) {
                $sql .= ', b.' . $item->COLUMN_NAME;
            }
        }
        $sql .= " from $thisTable AS a 
                  JOIN $middleTable AS j ON a.$thisId = j.$thisId
                  JOIN $joinTable AS b ON j.$foreignId = b.$foreignId
                  WHERE a.$this->primaryKey = :id";

        try {
            $st2 = db()->prepare($sql);
            $st2->bindValue('id', $this->tempId, PDO::PARAM_STR);
            $st2->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }
        $list = array();
        while ($row = $st2->fetch(PDO::FETCH_ASSOC)) {
            $o = new $class();
            $list[] = $o;
            foreach ($row as $key => $value) {
                $o->$key = $value;
                if ($key === $primaryKey) {
                    $o->tempId = $value;
                }
            }
        }

        return $list;
    }


    static public function delete(int $id)
    {
        $class = get_called_class();
        $table = strtoupper($class);
        $attrs = get_class_vars($class);
        $ids = $attrs['primaryKey'];

        try {
            $st = db()->prepare("delete from $table where $ids=:id");
            $st->bindValue('id', $id, PDO::PARAM_INT);
            $st->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }

        return true;
    }


    // Enregistre un objet dans la base de données (en le créant si besoin)
    // faire comme pour récupéré le non des variables dans la methode relationships
    public function save()
    {
        $class = get_called_class();
        $table = strtoupper($class);
        $id = $this->primaryKey;


        if (!isset($this->$id)) {
            try {
                $getColumn = db()->prepare("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = :table");
                $getColumn->bindValue('table', $table);
                $getColumn->execute();
            }catch (PDOException $exception) {
                echo $exception->getMessage();
                die();
            }

            $list = array();
            while ($row = $getColumn->fetch(PDO::FETCH_ASSOC)) {
                $o = new $class();
                $list[] = $o;
                foreach ($row as $key => $value)
                    $o->$key = $value;
            }

            $column = '(' . $list[0]->COLUMN_NAME;
            if (count($list) > 1) {
                $list = array_slice($list, 1);
                foreach ($list as $item) {
                    $column .= ' , ' . $item->COLUMN_NAME;
                }
            }
            $column .= ')';

            $values = '(default';
            for ($i = 0; $i < count($list); $i++) {
                $values .= ',default';
            }
            $values .= ')';
            $sql = "INSERT INTO $table $column VALUES $values RETURNING $this->primaryKey";

            try {
                $st = db()->prepare($sql);
                $st->execute();
            }catch (PDOException $exception) {
                echo $exception->getMessage();
                die();
            }

            $row = $st->fetch();
            $field = $this->primaryKey;
            $this->$field = $row[$field];
        }

        $test = array_diff_key(get_object_vars($this), ['primaryKey' => ''],['tempId' => '']);

        foreach ($test as $key => $value) {
            try {
                $st = db()->prepare("update $table set $key=:val where $this->primaryKey=:id");
                $st->bindValue(":val", $value);
                $st->bindValue(":id", $this->$id);
            }catch (PDOException $exception) {
                echo $exception->getMessage();
                die();
            }

            $st->execute();
        }
    }


    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }


    public function __toString()
    {
        $s = "<h4>" . get_class($this) . "</h4>";
        $s .= "<ul>";
        foreach (get_object_vars($this) as $key => $value)
            $s .= "<li>" . $key . " = " . $value . "</li>";
        $s .= "</ul>";
        return $s;
    }
}
