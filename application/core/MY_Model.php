<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MY_Model
 */
class MY_Model extends CI_Model {


    protected $table = NULL;
    protected $alias = NULL;

    function __construct() {
        parent::__construct();
    }

    protected function getTable()
    {
        if($this->table === NULL) {
            $this->table = get_called_class();
            $this->table = explode('_model', $this->table);
            $this->table = current($this->table);
            $this->table = strtolower($this->table);
        }
        return $this->table;
    }

    protected function getAlias()
    {
        if($this->alias === NULL) {
            $table = $this->getTable();
            $this->alias = substr($table, 0, 1);
        }
        return $this->alias;
    }

    public function get(array $where = array(), $fields = null, $limit = null, $offset = 0)
    {
        if(count($where) !== 0) {
            foreach ($where as $key => $value) {
                if(is_array($value)) {
                    $this->db->where_in($this->getAlias() . '.' . $key, $value);
                }else{
                    $this->db->where($this->getAlias() . '.' . $key, $value);
                }
            }
        }
        if($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        if($fields !== null){
            $this->db->select($fields);
        }
        return $this->db->get($this->getTable() . ' AS ' . $this->getAlias());
    }

    public function insert(array $data, $insert_id = FALSE) {
        $this->db->insert($this->getTable(), $data);
        if($insert_id === TRUE) {
            return (int)$this->db->insert_id();
        }
    }

    public function update(array $where, array $data) {
        if(count($where) !== 0) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->update($this->getTable(), $data);
    }

    public function delete(array $where, $return = true) {
        $this->db->delete($this->getTable(), $where);
        if($return) {
            $data = $this->get($where)->result();
            return count($data) === 0;
        }
    }

    public function insert_batch(array $data)
    {
        $this->db->insert_batch($this->getTable(), $data);
    }
}
