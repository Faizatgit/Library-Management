<!-- app/View/Books/search.ctp -->
<h2>Search Results</h2>
<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <?php echo $this->Html->link($book['Book']['title'], array('action' => 'view', $book['Book']['id'])); ?>
            by <?php echo $book['Book']['author']; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php echo $this->Html->link('Back', array('controller' => 'books', 'action' => 'index')); ?>
