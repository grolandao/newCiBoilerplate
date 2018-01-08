<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 08/01/18
 * Time: 15:19
 */

class Exemplo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('exemplo_model');
    }

    public function index()
    {
        $this->data['exemplo'] = $this->exemplo_model->get()->result();
        $this->renderer();
    }

    public function save($id = NULL)
    {

        $id = (int)$id;
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
            $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');


            if ($this->form_validation->run() === FALSE) {
                $this->setError(validation_errors());
                if ($id === 0) {
                    $redirect = '/novo';
                } else {
                    $redirect = '/editar/' . $id;
                }
                redirect($this->uri->segment(1) . '/' .$redirect);
            } else {
                $data = array(
                    'nome' => strtoupper($this->input->post('nome')),
                    'sobrenome' => strtoupper($this->input->post('sobrenome')),
                    'email' => $this->input->post('email'),
                    'ativo' => $this->input->post('ativo')
                );

                if ($id === 0) {
                    $senha = $this->generatePassword();
                    print_r($senha);
                    $data['senha'] = md5($senha);
                    $id = $this->exemplo_model->insert($data, true);
                } else {
                    $this->exemplo_model->update(array('id' => $id), $data);
                }
                if ($id === 0) {
                    $this->setError('Erro ao salvar, tente novamente mais tarde');
                } else {
                    $this->setMsg('Usuario gravado com sucesso');
                }
            }
        } else {
            $this->setError('Ocorreu um erro ao processar o formulario, tente novamente mais tarde');
        }
        redirect($this->uri->segment(1));
    }


    public function edit($id = NULL)
    {
        if ($this->uri->segment(3) == 'editar' && (int)$id === 0) {
            redirect($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/novo');
        } elseif ($id > 0) {
            $data = $this->exemplo_model->get(array('id' => $id))->result();
            if (count($data) > 0) {
                $data = current($data);
                $this->data['data'] = $data;
            }
        }
        $this->renderer();
    }

    public function delete($id)
    {
        $this->exemplo_model->delete(array('id' => $id));
        $this->setMsg('Usuario apagado com sucesso');
        redirect($this->uri->segment(1));
    }
}

