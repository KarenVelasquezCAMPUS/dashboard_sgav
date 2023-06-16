<?php 
    namespace Models;
    class City{
        protected static $conn;
        protected static $columnsTbl=['id_city','name_city','id_region'];
        private $id_city;
        private $name_city;
        private $id_region;
        public function __construct($args=[]){
            $this->id_city = $args['id_city'] ?? '';
            $this->name_city = $args['name_city'] ?? '';
            $this->id_region = $args['id_region'] ?? '';
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO cities ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            try {
                $stmt->execute($data);
                $response=[[
                    'id_city' => self::$conn->lastInsertId(),
                    'name_city' => $data['name_country'],
                    'id_region' => $data['id_region']
                ]];
            }catch(\PDOException $e) {
                return $sql . "<br>" . $e->getMessage();
            }
            return json_encode($response);
        }
        
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'id_city') continue;
                $atributos [$columna]=$this->$columna;
             }
             return $atributos;
        }
        public function sanitizarAttributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }
    }

?>