<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_related(array $where = array(), $fields = null,$limit = null, $offset = 0)
    {
        $this->db->join('type', $this->getAlias() . '.type_id = type.id', 'left');
        $this->db->select('
            type.name AS type_name,
        ');
        return $this->get($where, $fields, $limit, $offset);
    }

    public function get(array $where = array(), $fields = null, $limit = null, $offset = 0)
    {
        $this->db->order_by($this->getAlias() . '.name', 'ASC');
        if (isset($where['q'])) {
            $this->db->where('(' . $this->getAlias() . '.`name` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\' OR  `' . $this->getAlias() . '`.`username` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\')');
            unset($where['q']);
        }
        return parent::get($where, $fields, $limit, $offset);
    }

}