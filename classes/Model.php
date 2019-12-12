<?php
abstract class Model {
    
    protected $con;
    public $lang;
    public $val;
    
    public function __construct(){
            // settings local
            $dsn = 'mysql:host=localhost;dbname=o_pcfootball.store';
            $username = 'root';
            $password = '';
            // settings server
//            $dsn = 'mysql:host=localhost;dbname=o_pcfootball.store';
//            $username = 'root';
//            $password = '';
            // PDO options
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8, time_zone = '+04:00'"
            );
            // connection
            try {
                $this->con = new PDO($dsn, $username, $password, $opt);
            } catch(PDOException $e) {
                echo 'Connection failed: '.$e->getMessage();
            }
        
    }
    
    /* Get Data Model */
    public function getDataModel($table = '', $query = '', $count = 1) {
        $sql = $this->con->prepare("SELECT * FROM `$table` $query");
        $sql->execute();
        // return row
        if($count == 1) {
            return $sql->fetch();
        }
        // return rows
        else if ($count == 'all') {
            return $sql->fetchAll();  
        }
    }
    /* AJAX notify */
    protected function responseJson($_args = []){
        $data = [
            "messageType"=>$_args['type'],
            "messageTitle"=>$_args['title'],
            "message"=>$_args['message'],
            "reload" => (isset($_args['reload']) && !empty($_args['reload'])) ? $_args['reload'] : false,
        ];
        echo json_encode($data);
    }
}
?>