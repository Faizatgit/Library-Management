<!-- app/View/Books/index.ctp -->
<h2>List of Books</h2>
<!-- Search Form -->
<!-- <?php echo $this->Form->create('Book', array('url' => array('controller' => 'books', 'action' => 'search' ), 'type' => 'get')); ?>
    <?php echo $this->Form->input('keyword', array('placeholder' => 'Search books')); ?>
    <?php echo $this->Form->submit('Search'); ?>
<?php echo $this->Form->end(); ?> -->

<!-- app/View/Books/index.ctp -->

<?php echo $this->Form->create('Book', array('url' => array('controller' => 'books', 'action' => 'search' ), 'type' => 'get')); ?>
    <?php echo $this->Form->input('keyword', array('id' => 'keyword', 'placeholder' => 'Search books')); ?>
    <?php echo $this->Form->submit('Search'); ?>
<?php echo $this->Form->end(); ?>

<ul id="search-suggestions"></ul>

<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>ISBN</th>
        <th>Availability</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?php echo $book['Book']['title']; ?></td>
        <td><?php echo $book['Book']['author']; ?></td>
        <td><?php echo $book['Book']['isbn']; ?></td>
        <td><?php echo $book['Book']['availability']; ?></td>
        <td>
            <?php echo $this->Html->link('View', array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?>
            <?php echo $this->Html->link('Edit', array('controller' => 'books', 'action' => 'edit', $book['Book']['id'])); ?>
            <?php echo $this->Form->postLink('Delete', array('controller' => 'books', 'action' => 'delete', $book['Book']['id']), array('confirm' => 'Are you sure?')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
 // app/webroot/js/search.js

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('keyword');
    const searchSuggestions = document.getElementById('search-suggestions');

    // Event listener for input changes
    searchInput.addEventListener('input', async () => {
        const keyword = searchInput.value;

        if (keyword.length >= 1) {
            try {
                const response = await fetch(`http://localhost/library/books/searchSuggestions?keyword=${encodeURIComponent(keyword)}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }

                const suggestions = await response.json();
                updateSuggestions(suggestions);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        } else {
            clearSuggestions();
        }
    });

    // Event delegation for li click (since li elements are generated dynamically)
    searchSuggestions.addEventListener('click', (event) => {
        if (event.target.tagName === 'LI') {
            searchInput.value = event.target.textContent.trim();
        }
    });

    function updateSuggestions(suggestions) {
        searchSuggestions.innerHTML = ''; // Clear previous suggestions
        suggestions.forEach(suggestion => {
            const li = document.createElement('li');
            li.textContent = suggestion;
            searchSuggestions.appendChild(li);
        });
    }

    function clearSuggestions() {
        searchSuggestions.innerHTML = ''; // Clear suggestions
    }
});

</script>

<?php echo $this->Html->link('Add Book', array('action' => 'add')); ?>
