<?php 
class Model{

    static $connections = array();

    public $db = 'default';
    public $table = false;

    public function __construct(){
        // connection 
        $conf = Conf::$databases[$this->db];
        if (isset(Model::$connections[$this->db])){
            return true;
        }
        try {
            $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'],$conf['login'],$conf['password']);
            Model::$connections[$this->db] = $pdo;
        }catch(PDOException $e){
            if(Conf::$debug >= 1 ){
                die($e->getMessage()); 
            }else{
                die('Impossible de se connecter');
            }
        }

        if($this->table === false){
            $this->table = get_class($this);
        }
    }

    public function find($req){
        die($this->table);
       // $sql = 'SELECT * FROM table WHERE conditions'
    }


}