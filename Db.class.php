<?php

/**
 * Класс для работы с базой данных
 */
Class Db{

    /**
     * object объект соединения с базой данных
     */
    var $db;

    /**
     * Конструктор класса подключается к базе данных и выбирает базу
     * $host string Хост
     * $database string База данных
     * $user string Пользователь
     * $password string пароль
     */
    public function __construct($config_db){
        $this->db = mysqli_connect($config_db['host'],$config_db['user'],$config_db['password'],$config_db['database']);
        if(is_object($this->db)){
            mysqli_query($this->db, 'SET NAMES utf8mb4');
            mysqli_set_charset($this->db, 'utf8mb4');
            mysqli_query($this->db, 'SET sql_mode = \'\'');
//            mysqli_select_db($this->db, $config_db['database']);
        } else{
            echo '<div style="margin: 10% auto;text-align: center;width: 500px;">Извините, ведутся технические работы.</div>';
            die;
        }
        return $this->db;
    }

    /**
     * Функция делает запрос в базу
     * $sql string SQL запрос
     * return array
     */
    private function run_query($sql){
        return mysqli_query($this->db, $sql);
    }

    /**
     * Функция получает объект с ответом
     * $sql string SQL запрос
     * return array
     */
    public function query($sql){
        $result=array();
        $mysql_result = $this->run_query($sql);
        if(is_object($mysql_result)){
            while($row = mysqli_fetch_assoc($mysql_result)){
                $result[] = $row;
            }
        }else{
            return false;
        }
        return $result;
    }

    /*
 * Единая функция вставки
 * $table string Таблицы
 * $values array пары ключ значение при вставке
 * return integer Id вставленной записи
 */

    public function insert($table,$values){

        $result = false;
        if($table){
            $name = $val = $where = '';
            if(is_array($values)){
                foreach($values as $key => $value){
                    $name .= ($name == '') ? $key : ', ' . $key;
                    $val .= ($val == '') ? '"' . $value . '"' : ', "' . $value . '"';
                }
            }
            $sql = "INSERT INTO {$table} ({$name}) VALUES ({$val})";
            $result = $this->run_query($sql);
//            var_dump($result);
            if(!$result) {
                var_dump($sql); die;
            }
            if($result){
                $result = mysqli_insert_id($this->db);
                $result = ($result > 0) ? $result : true;
            }
        }
        return $result;
    }

    /**
     * Общая функция обнавления полей
     * $table string Название таблицы
     * $v array значения
     * $w array условие
     * return boolean
     */
    public function update($table,$v,$w){
        if($table){
            $set = $where = '';
            if(is_array($v)){
                foreach($v as $key => $value){
                    $set .= ($set == '') ? '' : ', ';
                    $set .= $key . ' = \'' . $value . '\'';
                }
            }
            if(is_array($w)){
                foreach($w as $key => $value){
                    $where .= ($where == '') ? '' : ' AND ';
                    $where .= "{$key} = '{$value}'";
                }
            }
            $where = ($where == '') ? '' : ' WHERE ' . $where;
            if($where != ''){
                $sql = "UPDATE {$table} SET {$set} {$where}";
            }
        }
//        var_dump($sql); die;
        return $this->run_query($sql);
    }

}
