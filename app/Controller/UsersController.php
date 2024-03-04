<?php
class UsersController extends AppController 
{   
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','register'); 
    }
     
    public function register() {
        $this->set('title_for_layout', 'AdminLTE 3 | Register');
        $this->layout = 'loginLayout';
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('ajax')) {
            // echo '<pre>';print_r($this->request->data); die;
            $this->User->create();
            $response = [];
            if ($this->User->save($this->request->data)) {
                if ($this->Auth->login()) {
                    $this->Session->setFlash(__('Welcome, '. $this->Auth->user('first_name').' !'), 'success');
                    $response['is_login'] = true;
                    $response['redirect'] = $this->Auth->redirectUrl('/users');
                } else {
                    $this->Session->setFlash(__('New user registered'), 'success');
                    $response['is_login'] = false;
                    $response['redirect'] = $this->Auth->redirectUrl('login');
                    // return $this->redirect(array('action' => 'login'));
                }
                $response['status'] = true;
            } else {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('first_name')));
                $response['errors'] = $this->User->validationErrors;
                $response['status'] = false;
            }
            echo json_encode($response); die;
        } 
        $this->loadModel('State');
        $stateList = $this->State->find('list', array('fields'=>array('id','name')));
        $this->set(compact('stateList'));
        
    }
 
    public function login() {
        $this->set('title_for_layout', 'AdminLTE 3 | Log in');
        $this->layout = 'loginLayout';
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
        // if we get the post information, try to authenticate
        if ($this->request->is('post') || $this->request->is('ajax')) {
            $response = [];
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('first_name').' !'), 'success');
                $response['is_login'] = true;
                $response['redirect'] = $this->Auth->redirectUrl('users');
            } else {
                $this->Session->setFlash(__('Invalid email or password'), 'error');
                $response['is_login'] = false;
                $response['redirect'] = $this->Auth->redirectUrl('login');
            }
            echo json_encode($response); die;
        }
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index(){
        $this->set('title_for_layout', 'AdminLTE 3 | User list');
        if ($this->request->is('ajax')) {

            $pagination = $this->request->data('pagination');
            $per_page = $this->request->data('per_page');
            $per_page = (isset($per_page) && $per_page != "") ? $per_page : 5;
            $page = $this->request->data('page');
            $current_page = (isset($page) && $page != '') ? $page : '';
            
            $totalUsers = $this->User->find('count');
            $users = $this->User->find('all', array(
                'conditions'=>['status'=>1],
                'order' => array('created' => 'DESC'),
                'limit' => $per_page, // int
                'page' => $page, // int,
                'contain' => array(
                    'State' => array(
                        'fields' => array('State.name'),
                    )
                )
            ));
            // echo '<pre>'; print_r($users); die;
            $current_page = $current_page == '' ? $page : $current_page;
            $total_pages = isset($pagination['perpage']) && $pagination['perpage'] > 0 ? $totalUsers / $per_page : 0;
            
            //Meta Data For Items
            $meta = array(
                'page' => $current_page,
                'perpage' => $per_page,
                'pages' => $total_pages,
                'total' => $totalUsers,
                'is_admin'=>$this->Auth->user('is_admin')
            );
            $data['meta'] = $meta;
            $data['users'] = $users;
            echo json_encode($data); die;
        }
    }
 
    public function user_list() {
        
    }
    // 18008969999
 
 
    public function add() {
        if ($this->request->is('post') && $this->request->is('ajax')){
            // echo '<pre>'; print_r($this->request->data); die; 
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'), 'success');
                $data['status'] = true;
                $data['redirect'] = 'users';
            } else {
                $data['status'] = false;
                $data['errors'] = $this->User->validationErrors;
            }
            echo json_encode($data); die;   
        }
        $this->loadModel('State');
        $stateList = $this->State->find('list', array('fields'=>array('id','name')));
        $this->set(compact('stateList'));
    }
 
    public function edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Invalid request');
                $this->redirect(array('action'=>'index'));
            }
 
            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('Invalid User');
                $this->redirect(array('action'=>'index'));
            }
 
            if ($this->request->is('post') || $this->request->is('put') || $this->request->is('ajax')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'), 'success');
                    $data['status'] = true;
                    $data['redirect'] = 'users';
                } else {
                    $data['status'] = false;
                    $data['errors'] = $this->User->validationErrors;
                }
                echo json_encode($data); die;
            } else {
                $this->request->data = $user;
            }
            $this->loadModel('State');
            $stateList = $this->State->find('list', array('fields'=>array('id','name')));
            $this->set(compact('stateList'));
    }
 
    public function delete($id = null) {     
        if (!$id) {
            $this->Session->setFlash('Please provide a user id', 'error');
            $this->redirect(array('action'=>'index'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided', 'error');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }
}