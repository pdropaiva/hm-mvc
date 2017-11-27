<?php
/**
 *
 */
class Model
{

  protected $db;
  protected $query;

  function __construct()
  {

    $this->db = new mysqli(HOSTNAME, DB_USER, DB_PASSWORD, DB_NAME);

    if (mysqli_connect_errno()) {
        if(DEBUG) printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
  }

  /**
   * Executa a query no banco de dados
   *
   * @param  string $sql [description]
   */
  public function query($sql) {

      $this->query = $this->db->query($sql);

      return $this;
  }

  /**
   * Pega o id da inserção
   *
   * @return integer [description]
   */
  public function getInsertedId() {

      return $this->db->insert_id;
  }

  public function getAffectedRows() {

      return $this->db->affected_rows;
  }

  /**
   * Retorna a quantidade de linhas da última consulta
   *
   * @return integer [description]
   */
  public function count() {

      return $this->query->num_rows;
  }

  /**
   * Verifica se existe mais resultado e seta caso houver
   *
   * @return boolean [description]
   */
  public function hasNext() {

      if(!$this->query) return false;

      $result = $this->query->fetch_array();

      if($result)
        $this->setAll($result);

      return ($result);
  }

  public function all() {

      $this->query("SELECT * FROM {$this->table}");
  }

  public function first() {

      return $this->hasNext();
  }

  public function find($id) {

      if(!isset($this->table)) return null;

      $this->query("SELECT * FROM {$this->table} WHERE id = $id");

      return $this->first();
  }

  public function delete($id = null) {

      if(!isset($id)) $id = $this->id;
      if(!isset($this->table)) return false;
      if(!isset($id)) return false;

      $this->query("DELETE FROM {$this->table} WHERE id = $id");

      return $this->getAffectedRows();
  }

  /**
   * Adiciona os valores pegos do banco no objeto
   *
   * @param array $result [description]
   */
  private function setAll($result) {

      foreach ($result as $field => $value) {

          if(!is_numeric($field))
            $this->{$field} = $value;
      }
  }

  function __destruct() {

      $this->db->close();
  }
}
