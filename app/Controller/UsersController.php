<?php
// app/Controller/UsersController.php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppController','Controller');
class UsersController extends AppController {
    public $name = 'Users';
    public $uses = array('User');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'books', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'You are not authorized to access that page.',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'username', 'password' => 'password')
                )
            )
        )
    );
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login'); // Allow login action without authentication
        $this->Auth->allow('signup');
    }

    public function login() {
        if ($this->request->is('post')) {
            $this->User->recursive = -1;//typically means that no associated records will be automatically fetched along with the main record. 
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            if ($user && AuthComponent::password($this->request->data['User']['password']) === $user['User']['password']) {
                unset($user['User']['password']); // Remove password from user data before login
                $this->Auth->login($user['User']);
                $this->Session->write('User', $this->Auth->user());
                $this->redirect($this->Auth->redirect(array('controller' => 'books', 'action' => 'index')));
            } else {
                $this->Session->setFlash('Invalid username or password.', 'default', array(), 'auth');
            }
        }
    }

    public function logout() {
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    public function signup() {
        if ($this->request->is('post')) {
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('User registered successfully.');
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash('Error registering user. Please try again.');
            }
        }
    }
}
?>