<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats = Formats::findAll();
} catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Books</title>
</head>

<body>
    <div class="container">
        <div class="width-12 header">
            <?php require 'php/inc/flash_message.php'; ?>
            <div class="button">
                <a href="book_create.php">Add New Book</a>
            </div>
        </div>
        <?php if (!empty($books)) { ?>
            <div class="width-12 filters">
                <form id="filters" class="filters">
                    <div>
                        <label for="title_filter">Title:</label>
                        <input type="text" id="title_filter" name="title_filter" placeholder="Title">
                    </div>
                    <div>
                        <label for="sort_publisher">Publisher:</label>
                        <select id="sort_publisher" name="sort_publisher">
                            <option value="all_publisher">All publishers</option>
                            <?php foreach ($publishers as $publisher) { ?>
                                <option value="<?= $publisher->id ?>"><?= $publisher->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="sort_formats">Formats:</label>
                        <select id="sort_formats" name="sort_formats">
                            <option value="all_formats">All Formats</option>
                            <?php foreach ($formats as $format) { ?>
                                <option value="<?= $format->id ?>">
                                    <?= $format->name ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div>
                        <label for="sort_by">Year:</label>
                        <select id="sort_by" name="sort_by">
                            <option value="all">All Years</option>
                            <option value="before">Before 2000</option>
                            <option value="later">2000 and later</option>
                        </select>
                    </div>
                    <div>
                        <button type="button" id="apply_filters">Apply Filters</button>
                        <button type="button" id="clear_filters">Clear Filters</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <?php if (empty($books)) { ?>
            <p>No games found.</p>
        <?php } else { ?>
            <div id="book-cards" class="width-12 cards">
                <?php foreach ($books as $book) { ?>
                    <?php $formates = Formats::findByBook($book->id);
                    $formatNames = [];
                    foreach ($formates as $format) {
                        $formatNames[] = $format->id;
                    } ?>
                    <div class="card" data-title="<?= htmlspecialchars($book->title) ?>" data-year="<?= $book->year ?>"
                        data-publisher="
                        <?= $book->publisher_id ?>" data-formats="
                         <?= implode(', ', $formatNames) ?>">
                        <div class="top-content">
                            <h2>Title:
                                <!-- <?= h($book->title) ?> -->
                                <?= h(htmlspecialchars($book->title)) ?>
                            </h2>
                            <p>Author:
                                <?= h($book->author) ?>
                            </p>
                            <p>ISBN:
                                <?= h($book->isbn) ?>
                            </p>
                            <p></p>
                            <p>Year:
                                <!-- <?= h($book->year) ?> -->
                                <?= (int) $book->year ?>
                            </p>
                            <p>Description:
                                <?= h($book->description) ?>
                            </p>
                        </div>
                        <div class="bottom-content">
                            <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                            <div class="actions">
                                <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/
                                <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/
                                <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <script src="./js/books-filters.js"></script>
</body>

</html>