<?php

App::uses('AppModel', 'Model');
class Book extends AppModel{
    public $name = 'Book';
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'message' => 'Title cannot be empty'
        ),
        'author' => array(
            'rule' => 'notBlank',
            'message' => 'Author cannot be empty'
        ),
        'isbn' => array(
            'rule' => 'notBlank',
            'message' => 'ISBN cannot be empty'
        )
        );
}

