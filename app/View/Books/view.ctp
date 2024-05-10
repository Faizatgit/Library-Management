<!-- app/View/Books/view.ctp -->
<h2>Book Details</h2>
<table>
    <tr>
        <th>Title</th>
        <td><?php echo $book['Book']['title']; ?></td>
    </tr>
    <tr>
        <th>Author</th>
        <td><?php echo $book['Book']['author']; ?></td>
    </tr>
    <tr>
        <th>ISBN</th>
        <td><?php echo $book['Book']['isbn']; ?></td>
    </tr>
    <tr>
        <th>Availability</th>
        <td><?php echo $book['Book']['availability']; ?></td>
    </tr>
</table>
<?php echo $this->Html->link('Back', array('controller' => 'books', 'action' => 'index')); ?>
