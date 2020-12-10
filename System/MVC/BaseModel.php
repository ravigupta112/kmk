<?php

namespace MVC;


abstract class BaseModel extends Model
{

    //Table Variables
    protected $tblHcp = 'hcp';
    protected $tblHco = 'hco';
    protected $tblSpecialty = 'specialty';
    protected $tblHcoHcp = 'hco_hcp';
    protected $tblHcoSpecialty = 'hco_specialty';
    
    // Variables
    protected $deleted = 1;
    protected $table;

    /**
     * Abstract Method for get current table
     */
    abstract protected function getTableName();

    /**
     * Calling parent constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = DB_PREFIX . $this->getTableName();
        
    }

    /**
     * Fetch all data of current model
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} WHERE is_deleted != {$this->deleted}";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * Delete data of current model
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $return = false;
        $id = abs($id);
        $sql = "UPDATE {$this->table} SET is_deleted = {$this->deleted} WHERE id = {$id}";
        $query =  $this->db->query($sql);
        if ($query->num_rows) {
            $return = true;
        }
        return $return;
    }

    /**
     * Get data of current model by id
     * @param integer $id
     * @return array
     */
    public function findById($id)
    {
        $id = abs($id);
        $sql = "SELECT * FROM {$this->table} WHERE is_deleted != {$this->deleted} AND id = {$id}";
        $query = $this->db->query($sql);
        return $query->row;
    }

}
