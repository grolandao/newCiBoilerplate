<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

/**
 * Class MY_Controller
 */
class  MY_Controller extends CI_Controller
{

    public $data = array();
    public $header = 'default/header';
    public $content = '';
    public $footer = 'default/footer';

    protected $assets = array();
    protected $css = array();
    protected $js = array();

    public function debug($data, $user_id = 0)
    {
        if($user_id != 0 && $user_id == $this->data['me']->id){
            echo "<pre>";
            print_r($data);
            exit();
        }

    }

    protected function generatePassword($size = 6, $uppercase = true, $numbers = true, $symbols = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $result = '';
        $characters = '';
        $characters .= $lmin;
        if ($uppercase) $characters .= $lmai;
        if ($numbers) $characters .= $num;
        if ($symbols) $characters .= $simb;
        $len = strlen($characters);
        for ($n = 1; $n <= $size; $n++) {
            $rand = mt_rand(1, $len);
            $result .= $characters[$rand-1];
        }
        return $result;
    }

    protected function forgotPassword($email = '', $adm = false)
    {
        if($email !== ''){
            $newPassword = MD5($this->generatePassword());
            if($adm === true){
                $this->load->model('admin_model');
                $this->admin_model->update(array('email' => $email), array('password' => $newPassword, 'force_password' => 1));
            }else{
                $this->load->model('user_model');
                $this->user_model->update(array('email' => $email), array('password' => $newPassword, 'force_password' => 1));
            }
        }
    }

    protected function getPermissions()
    {
        $this->load->model('userPermissions_model');
        $permissions = $this->userPermissions_model->get($this->data['me']->user_type);
        foreach ($permissions as $key => $row) {
            $permissions[$key] = $row->typepermissions_id;
        }
        $this->data['me']->permissions = $permissions;
    }

    private function login($admin = false)
    {
        if($admin == true){
            $this->load->model('admin_model');
        }else{
            $this->load->model('user_model');
            $this->data['me'] = $this->user_model->get_related(array('hash' => $hash), 1)->result();
        }
        $hash = $this->input->post('hash');
        if ($hash) {
            if (count($this->data['me']) === 0) {
                $this->data['output']['error'] = array('100' => 'Usuário ou senha invalidos');
            } else {
                $this->data['me'] = current($this->data['me']);
                $this->data['output']['me'] = $this->data['me'];

                unset($this->data['me']->password);

                $this->session->set_userdata('me', $this->data['me']);

                $this->load->model('useraccess_model');

                $this->useraccess_model->insert(array(
                    'user_id' => $this->data['me']->id,
                    'ip' => $this->input->ip_address()
                ));
            }
        }
    }

    public function __construct()
    {
        parent::__construct();

        $this->header = ($this->uri->segment(1) == 'adm') ? null : 'default/header';
        $this->footer = ($this->uri->segment(1) == 'adm') ? null : 'default/footer';

        $this->loadBootstrap();
        $this->loadFontAwesome();
        $this->loadAngular();

        $this->data['me'] = $this->session->userdata('me') ? $this->session->userdata('me') : null;
        $this->data['adm'] = $this->session->userdata('adm')?$this->session->userdata('adm'):null;

        if ($this->uri->segment(1) == 'adm') {
            if ($this->router->class != 'login' && isset($this->data['adm']->id) === FALSE) {
                $this->setError('É necessário estar logado');
                $this->setPreviousUrl(base_url($this->uri->uri_string()));
                redirect(base_url('/adm/login'), 'refresh');
            }
            if ($this->header !== NULL) {
                $this->header = 'adm/' . $this->header;
            }
            if ($this->footer !== NULL) {
                $this->footer = 'adm/' . $this->footer;
            }
            $this->content = file_exists(APPPATH . 'views/' . $this->uri->segment(1) . '/' . $this->router->class . '/' . $this->router->method . '.php') ? $this->uri->segment(1) . '/' . $this->router->class . '/' . $this->router->method : 'default/content';

        } elseif ($this->uri->segment(1) == 'ws') {
            $this->data['output'] = array();
        } else {
            $this->content = file_exists(APPPATH . 'views/' . $this->router->class . '/' . $this->router->method . '.php') ? $this->router->class . '/' . $this->router->method : 'default/content';
        }

        $this->data['error'] = $this->session->flashdata('error') ? $this->session->flashdata('error') : null;
        $this->data['msg'] = $this->session->flashdata('msg') ? $this->session->flashdata('msg') : null;
    }

    private function force_privacy()
    {
        if (isset($this->data['me']->id)) {
            if (isset($this->data['me']->acceptprivacy) === false || $this->data['me']->acceptprivacy == 0) {
                $this->load->model('team_model');
                $this->data['team'] = $this->team_model->get(array(
                    'id' => $this->data['me']->team_id,
                ))->result();

                $this->data['team'] = current($this->data['team']);

                if (isset($this->data['team']->privacy) && strlen($this->data['team']->privacy) > 0) {
                    $this->data['team']->privacy = nl2br($this->data['team']->privacy);

                    $this->loadJs(array(
                        'name' => 'privacy'
                    ));

                    $this->data['partial'] .= $this->load->view('partial/privacy', $this->data, true);
                }
            }
        }
    }

    private function force_password()
    {
        //dont force password if user need to accept the privacy
        if (isset($this->data['me']->id) && isset($this->data['me']->acceptprivacy) && $this->data['me']->acceptprivacy == 1) {

            if (isset($this->data['me']->changepassword) === false || $this->data['me']->changepassword == 1) {

                $this->loadJs(array(
                    'name' => 'force_password'
                ));

                $this->data['partial'] .= $this->load->view('partial/force_password', $this->data, true);
            }
        }
    }

    public function index()
    {
        $this->renderer();
    }

    public function setError($str)
    {
        if (strlen($str) > 0) {
            $this->session->set_flashdata('error', $this->session->flashdata('error') . '<p>' . $str . '</p>');
        }
    }

    public function setMsg($str)
    {
        if (strlen($str) > 0) {
            $this->session->set_flashdata('msg', $this->session->flashdata('msg') . '<p>' . $str . '</p>');
        }

    }

    public function renderer()
    {
        $this->loadCss(array(
            'name' => 'main',
            'path' => $this->uri->segment(1) == 'adm' ? 'assets/adm/css/' : null
        ), true);
        $this->loadCss(array(
            'name' => $this->router->class . '_' . $this->router->method,
            'path' => $this->uri->segment(1) == 'adm' ? 'assets/adm/css/' : null
        ));

        $this->loadJs(
            array(
                array(
                    'name' => 'script',
                    'path' => $this->uri->segment(1) == 'adm' ? 'assets/adm/js/' : null
                ),
                array(
                    'name' => $this->router->class . '_' . $this->router->method,
                    'path' => $this->uri->segment(1) == 'adm' ? 'assets/adm/js/' : null
                )
            )
        );

        $this->data['js'] = implode(null, $this->js);
        $this->data['css'] = implode(null, $this->css);
        $this->data['assets'] = implode(null, $this->assets);

        $this->getPageTitle();

        if ($this->header !== NULL) {
            $this->load->view($this->header, $this->data);
        }
        $this->load->view($this->content, $this->data);

        if ($this->footer !== NULL) {
            $this->load->view($this->footer, $this->data);
        }
    }

    public function getPageTitle()
    {
        if (isset($this->data['pageTitle']) == false) {
            $this->setPageTitle(ucfirst($this->router->class));
        }
        return $this->data['pageTitle'];
    }

    public function setPageTitle($page = '', $separator = ' - ')
    {
        $this->data['pageTitle'] = $page . $separator . NAME_SITE;
    }

    public function setPreviousUrl($address)
    {
        if(strpos($address, 'login') === false){
            $previousUrl = $this->session->userdata('previousUrl')?$this->session->userdata('previousUrl'):array();
            $previousUrl[] = $address;
            $this->session->set_userdata('previousUrl',$previousUrl);
        }
    }

    public function goToPreviousUrl()
    {
        $previousUrl = $this->session->userdata('previousUrl')?$this->session->userdata('previousUrl'):array();

        if (is_array($previousUrl) && count($previousUrl) > 0) {
            $previous = array_pop($previousUrl);
            $this->session->set_userdata('previousUrl',$previousUrl);
            redirect($previous, 'refresh');
        } else {
            return FALSE;
        }
    }

    protected function loadBootstrap($onlyCss = false){
        $this->loadCss(array(
            array(
                'name' => 'bootstrap',
                'path' => 'assets/bootstrap/css/'
            )
        ),true);
        if($onlyCss == false){
            $this->loadJquery();
            $this->loadJs(array(
                array(
                    'name' => 'bootstrap',
                    'path' => 'assets/bootstrap/js/'
                )
            ), true);
        }
    }

    protected function loadJquery(){
        $this->loadJs(array(
            array(
                'name' => 'jquery',
                'path' => 'assets/jquery/'
            )
        ), true);
    }

    protected function loadAngular(){
        $this->loadJs(array(
            array(
                'name' => 'angular',
                'path' => 'assets/angular/'
            )
        ), true);
    }

    protected function loadFontAwesome(){
        $this->loadCss(array(
            array(
                'name' => 'fontAwesome',
                'path' => 'assets/fontAwesome/css/'
            )
        ), true);
    }


    protected function loadCss(array $files, $priority = false)
    {
        $version = 0;
        if(is_array(current($files)) === false) {
            $files = array($files);
        }
        foreach ($files as $row) {
            if(isset($row['name']) === false) {
                log_message('error', __METHOD__ . ROOT_PATH . DIRECTORY_SEPARATOR . 'css name not defined. Dump: ' . var_export($row, true));
                continue;
            }
            if(isset($row['path']) === false || $row['path'] === null) {
                $row['path'] = 'assets/css/';
            }
            $fileNoMin = $row['path'] . $row['name'] . '.css';
            $fileMin = $row['path'] . $row['name'] . '.min.css';

            if(isset($row['key']) === false) {
                $row['key'] = md5($fileNoMin);
            }
            //Put as the last one if was defined before
            if(isset($this->css[$row['key']]) === true) {
                $data = $this->css[$row['key']];
                unset($this->css[$row['key']]);
                $this->css[$row['key']] = $data;
                continue;
            }
            if (file_exists(ROOT_PATH . DIRECTORY_SEPARATOR . $fileNoMin) === TRUE) {
                if($this->config->item('minify_output') === true) {
                    if (ENVIRONMENT == 'development' ||
                        file_exists(ROOT_PATH . DIRECTORY_SEPARATOR . $fileMin) === FALSE
                        || isset($this->data['adm']->id) === true
                    ) {
                        $this->load->helper('file');
                        $contents = file_get_contents($fileNoMin);
                        $contents = $this->output->minify($contents,'text/css');
                        write_file($fileMin, $contents);
                    }
                }else{
                    @unlink($fileMin);
                    $fileMin = $fileNoMin;
                }
                if($priority === true) {
                    $this->css[$row['key']] = '';
                    $this->assets[$row['key']] = PHP_EOL . '    <link rel="stylesheet" type="text/css" href="./' . $fileMin . '?v=' . $version . '"/>';
                }else{
                    $this->css[$row['key']] = PHP_EOL . '    <link rel="stylesheet" type="text/css" href="./' . $fileMin . '?v=' . $version . '"/>';
                }
            } else {
                log_message('debug', __METHOD__ . ROOT_PATH . DIRECTORY_SEPARATOR . $fileNoMin . ' does not exists');
            }
        }
    }

    protected function loadJs(array $files, $priority = false){
        $version = 0;
        if(is_array(current($files)) === false) {
            $files = array($files);
        }
        foreach ($files as $row) {
            if(isset($row['name']) === false) {
                log_message('error', __METHOD__ . ROOT_PATH . DIRECTORY_SEPARATOR . 'js name not defined. Dump: ' . var_export($row, true));
                continue;
            }
            if(isset($row['path']) === false || $row['path'] === null) {
                $row['path'] = 'assets/js/';
            }
            $fileNoMin = $row['path'] . $row['name'] . '.js';
            $fileMin = $row['path'] . $row['name'] . '.min.js';

            if(isset($row['key']) === false) {
                $row['key'] = md5($fileNoMin);
            }
            //Put as the last one if was defined before
            if(isset($this->js[$row['key']]) === true) {
                $data = $this->js[$row['key']];
                unset($this->js[$row['key']]);
                $this->js[$row['key']] = $data;
                continue;
            }
            if (file_exists(ROOT_PATH . DIRECTORY_SEPARATOR . $fileNoMin) === TRUE) {
                if($this->config->item('minify_output') === true) {
                    if (ENVIRONMENT == 'development' ||
                        file_exists(ROOT_PATH . DIRECTORY_SEPARATOR . $fileMin) === FALSE) {
                        $this->load->helper('file');
                        $contents = file_get_contents($fileNoMin);
                        $contents = $this->output->minify($contents, 'text/javascript');
                        write_file($fileMin, $contents);
                    }
                }else{
                    @unlink($fileMin);
                    $fileMin = $fileNoMin;
                }
                if($priority === true) {
                    $this->js[$row['key']] = '';
                    $this->assets[$row['key']] = PHP_EOL . '    <script type="text/javascript" src="./' . $fileMin . '?v=' . $version . '"></script>';
                }else{
                    $this->js[$row['key']] = PHP_EOL . '    <script type="text/javascript" src="./' . $fileMin . '?v=' . $version . '"></script>';
                }

            } else {
                log_message('debug', __METHOD__ . ROOT_PATH . DIRECTORY_SEPARATOR . $fileNoMin . ' does not exists');
            }
        }
    }

    public function output_json($data)
    {
        $array_rack = false;
        if (is_array($data) == false) {
            $data = array($data);
            $array_rack = true;
        }
        $filter = $this->input->post('filter');
        $remove = $this->input->post('remove');

        if ($filter !== null) {
            $filter = explode(',', $filter);
            foreach ($data as $row) {
                foreach ($row as $key => $col) {
                    if (in_array($key, $filter) == false) {
                        unset($row->$key);
                    }
                }
            }
        }
        if ($remove !== null) {
            $remove = explode(',', $remove);
            foreach ($data as $row) {
                foreach ($row as $key => $col) {
                    if (in_array($key, $remove)) {
                        unset($row->$key);
                    }
                }
            }
        }
        if ($array_rack) {
            $data = $data[0];
        }
        if (isset($data->error) && count($data->error) === 0) {
            unset($data->error);
        }
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}