<?php
namespace Core\Database;
use \PDO;

Class MysqlDatabase extends Database {
        /**
        * @var string
        */
        private $db_name;
        /**
        * @var string
        */
        private $db_user;
        /**
        * @var string
        */
        private $db_pass;
        /**
        * @var string
        */
        private $db_host;
        /**
        * @var
        */
        private $pdo;

        /**
        * MysqlDataBase constructor.
        * @param $db_name
        * @param string $db_user
        * @param string $db_pass
        * @param string $db_host
        */
        public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost'){
                $this->db_name = $db_name;
                $this->db_user = $db_user;
                $this->db_pass = $db_pass;
                $this->db_host = $db_host;
        }

    /**
     * @return PDO
*/
    private function getPDO(){
        if ($this->pdo === null){
            $pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.'',$this->db_user,$this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @return array
     */
    public function query($statement, $class_name){
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_CLASS,$class_name);
        return $datas;
    }

    public function prepare($statement, $values, $class_name,$one=false){
        $req=$this->getPDO()->prepare($statement);
        $req->execute($values);
        $req->setFetchMode(PDO::FETCH_CLASS,$class_name);
        if ($one){
            $datas = $req->fetch();
        }else {
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    //SMEF = Sans Mise En Forme
    public function querySMEF($statement){
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetch();
        return $datas;
    }

    public function queryAllSMEF($statement){
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll();
        return $datas;
    }

    public function prepareSMEF($statement, $values){
        $req=$this->getPDO()->prepare($statement);
        $req->execute($values);
        $datas = $req->fetch();
        return $datas;
    }

}
