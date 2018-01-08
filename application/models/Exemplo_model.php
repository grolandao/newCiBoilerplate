<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exemplo_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_related(array $where = array(), $fields = null ,$limit = null, $offset = 0)
    {
        $this->db->join('userType', $this->getAlias() . '.userType_id = usertype.id', 'left');
        $this->db->select('
            userType.name AS userType_name,
        ');
        return $this->get($where, $fields ,$limit, $offset);
    }

    public function get_login(array $where = array(), $fields = null ,$limit = null, $offset = 0)
    {
        return parent::get($where, $fields ,$limit, $offset);
    }

    public function get(array $where = array(), $fields = null ,$limit = null, $offset = 0)
    {
        $this->db->order_by($this->getAlias() . '.nome', 'ASC');
        if (isset($where['q'])) {
            $this->db->where('(' . $this->getAlias() . '.`name` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\' OR  `' . $this->getAlias() . '`.`username` LIKE \'%' . $where['q'] . '%\' ESCAPE \'!\')');
            unset($where['q']);
        }
        return parent::get($where, $fields ,$limit, $offset);
    }

    public function insert(array $data = array(), $insert_id = false )
    {
        $this->db->set('cliente_id', $this->data['me']->cliente_id, FALSE);
        $this->db->set('criacao_datahora', 'NOW()', FALSE);
        $this->db->set('criacao_usuario', $this->data['me']->id, FALSE);
        return parent::insert($data, $insert_id);
    }

    public function update(array $where = array(), array $data =array() )
    {
        $this->db->set('alteracao_datahora', 'NOW()', FALSE);
        $this->db->set('alteracao_usuario', $this->data['me']->id, FALSE);
        return parent::update($where, $data);
    }

}