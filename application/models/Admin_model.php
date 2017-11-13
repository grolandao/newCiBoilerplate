<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get(array $where = array(), $limit = null, $offset = 0)
    {
        $this->db->order_by($this->getAlias() . '.name', 'ASC');
        if (isset($where['q'])) {
            $this->db->where('(' . $this->getAlias() . '.`name` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\' OR  `' . $this->getAlias() . '`.`username` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\')');
            unset($where['q']);
        }
        return parent::get($where, $limit, $offset);
    }

}