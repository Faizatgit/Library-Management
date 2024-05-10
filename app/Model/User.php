<?php
App::uses('AppModel', 'Model');

// app/Model/User.php

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Username is required.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Username already exists.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required.'
            )
        )
    );
}

?>