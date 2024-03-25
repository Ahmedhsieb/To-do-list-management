<?php

namespace Todo_list\Lib;
class db 
{
    public $connnection;
    public $query;
    public $sql;

    public function __construct($dbname)
    {
        $this->connnection = mysqli_connect("localhost", "root", "1234", $dbname);
    }

    public function select($table, $column)
    {
        $this->sql = "SELECT $column FROM `$table` ";
        return $this;
    }

    public function where($column, $compair, $value)
    {
        $this->sql .= " WHERE `$column` $compair '$value'";
        return $this;
    }

    public function andWhere($column, $compair, $value)
    {
        $this->sql .= " AND  `$column` $compair '$value'";
        return $this;
    }

    public function orWhere($column, $compair, $value)
    {
        $this->sql .= " OR  `$column` $compair '$value'";
        return $this;
    }

    public function join($tablename, $column1, $column2)
    {
        $this->sql .= " INNER JOIN $tablename ON $column1 = $column2";
//         echo $this->sql;die;
        return $this;
    }

    public function getAll()
    {

        $this->query();
        while ($row = mysqli_fetch_assoc($this->query)) {
            $data[] = $row;
        }
//         echo empty($data);die;
        return (empty($data)) ? 0 : $data;
    }

    public function getRow()
    {
        $this->query();
//           echo $this->query();die;
        $row = mysqli_fetch_assoc($this->query);
        return $row;
    }

    public function insert($table, $data)
    {

        $row = $this->preparData($data);
        $this->sql = "INSERT INTO `$table` SET $row";
        // echo $this->sql;die;
        return $this;
    }

    public function update($table, $data)
    {

        $row = $this->preparData($data);
        $this->sql = "UPDATE `$table` SET $row";
        return $this;
    }

    public function delete($table)
    {
        $this->sql = "DELETE FROM `$table` ";
        return $this;
    }

    public function excu()
    {
        $this->query();
        if (mysqli_affected_rows($this->connnection) > 0) {
            return true;
        } else {
            return $this->showError();
        }
    }

    public function preparData($data)
    {
        // print_r($data);die;
        $row = "";
        foreach ($data as $key => $value) {
            $row .= " `$key` = " . ((gettype($value) == 'string') ? "'$value'" : "$value") . ",";
        }
        $row = rtrim($row, ",");
        // echo $row;die;
        return $row;
    }


    public function query()
    {
        $this->query = mysqli_query($this->connnection, $this->sql);
//         print_r($this->query);die;
    }

    public function showError()
    {
        //   return  mysqli_error($this->connnection);
        $errors = mysqli_error_list($this->connnection);
        foreach ($errors as $error) {
            echo "<h2 style='color:red'>Error</h2> : " . $error['error'] . "<br> <h3 style='color:red'>Error Code : </h3>" . $error['errno'];
        }
    }

    public function __destruct()
    {
        mysqli_close($this->connnection);
    }
}