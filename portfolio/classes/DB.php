<?php
// Side/sti konfiguration
$frontPage = 'dashboard.php';
$pagesFolderPath = 'pages/';

class DB {
  private $host      = 'localhost';
  private $user      = 'root';
  private $pass      = '';
  private $dbname    = 'db_serigrafen';
    //private $dbprefix  = Config::$db_prefix;

    private $dbh;
    private $error;

		private $stmt;

    public function __construct() {

    }

    public function openDB() {
        // Sætter host og tabel
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname .';charset=utf8';
        // Sætter muligheder
        $options = array(
            \PDO::ATTR_PERSISTENT    => true,
            \PDO::ATTR_ERRMODE       => \PDO::ERRMODE_EXCEPTION
        );
        // Laver ny instance
        try{
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
        }
        // Tjekker efter fejl
        catch(\PDOException $e){
            $this->error = $e->getMessage();
        }
    }

		//Klargører queryen
		public function query($query) {
			$this->stmt = $this->dbh->prepare($query);
		}

		// Binder inputet til placeholderen
		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = \PDO::PARAM_INT;
						break;
					case is_bool($value):
            $type = \PDO::PARAM_BOOL;
						break;
          case is_null($value):
            $type = \PDO::PARAM_NULL;
            break;
					default:
						$type = \PDO::PARAM_STR;
						break;
				}
			}
      $this->stmt->bindValue($param, $value, $type);
		}

    // Udfører den klargjorte statement for insert osv
    public function execute() {
      return $this->stmt->execute();
    }

    public function getFields() {
      $this->execute();
      return $this->stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    // Retunere alle resultater i objecter
    public function resultset() {
      $this->execute();
      return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Return single object
    public function single() {
      $this->execute();
      return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    // Retunere antal påvirkede rækker
    public function rowCount() {
      return $this->stmt->rowCount();
    }

    //Retunere sidst indsatte id
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    // TODO Læs mere på transactions
    public function beginTransaction(){
      return $this->dbh->beginTransaction();
    }
    public function endTransaction(){
      return $this->dbh->commit();
    }
    public function cancelTransaction(){
      return $this->dbh->rollBack();
    }

    // TODO Læs mere på debug dump
    public function debugDumpParams(){
      return $this->stmt->debugDumpParams();
    }

    public function constructFields($table) {
      $this->db->query('DESCRIBE '. $table);
      $fields = $this->db->getFields();
      return $fields;
    }


}
