<!-- app/View/Books/add.ctp -->
<h2>Add Book</h2>
<?php
echo $this->Form->create('Book');
echo $this->Form->input('title');
echo $this->Form->input('author');
echo $this->Form->input('isbn');
echo $this->Form->input('availability', array('options' => array('available' => 'Available', 'checked_out' => 'Checked Out')));
echo $this->Form->end('Save');
?>
<?php echo $this->Html->link('Cancel', array('controller' => 'books', 'action' => 'index')); ?>
