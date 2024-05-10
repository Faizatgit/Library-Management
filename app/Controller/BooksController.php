<?php

App::uses('AppController','Controller');

class BooksController extends AppController{
    public $helpers = array('Html','Form');

    public function index()
    {
        $this->set('books',$this->Book->find('all'));
    }

    public function view($id = null)
    {
        $this->Book->id = $id;
        $this->set('book',$this->Book->read());
    }

    public function add()
    {
        if($this->request->is('post'))
        {
            if($this->Book->save($this->request->data))
            {
                $this->Session->setFlash('Data saved successfully','flash_success');
                $this->redirect(array('action' => 'index'));
            }
            else{
                $this->Session->setFlash('Unable to save data','flash_error');
            }
        }
    }

    public function edit($id = null)
    {
        $this->Book->id = $id;
        if($this->request->is('get'))
        {
            $this->request->data = $this->Book->read();
        }else{
            if($this->Book->save($this->request->data))
            {
                $this->Session->setFlash('Book updated successfully','flash_success');
                $this->redirect(array('action' => 'index'));
            }
            else{
                $this->Session->setFlash('Unable to update book','flash_error');
            }
        }
    }

    public function delete($id)
    {
        if($this->request->is('get'))
        {
            throw new MethodNotAllowedException();
        }
        if($this->Book->delete($id))
        {
            $this->Session->setFlash('Book Deleted successfully!','flash_success');
            $this->redirect(array('action'=>'index'));
        }
    }
    public function search()
    {
        $keyword = $this->request->query('keyword');
        // var_dump($keyword);
        $conditions = array('OR'=> array(
            'Book.title LIKE' => "%$keyword%",
            'Book.author LIKE' => "%$keyword%",
            'Book.isbn LIKE' => "%$keyword%"
        ));
        // debug($conditions);
        $books = $this->Book->find('all',array('conditions' => $conditions));
        $this->set('books',$books);
    }
    public function searchSuggestions() {
        $this->autoRender = false; // Disable view rendering for AJAX requests
        $this->response->type('json'); // Set response type to JSON

        $keyword = $this->request->query('keyword');

        // Fetch book titles based on $keyword from your database
        $this->Book->recursive = -1;
        $suggestions = $this->Book->find('list', array(
            'fields' => array('title'),
            'conditions' => array('title LIKE' => '%' . $keyword . '%'),
            'limit' => 5 // Limit the number of suggestions
        ));

        $this->response->body(json_encode(array_values($suggestions)));
        return $this->response;
    }
}