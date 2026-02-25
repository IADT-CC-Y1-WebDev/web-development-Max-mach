<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No book ID provided.');
    }
    $id = $_GET['id'];

    $book = Book::findById($id);
    if ($book === null) {
        throw new Exception("Book not found.");
    }
     $bookFormats = Formats::findByBook($book->id);
    $bookFormatsIds = [];
    foreach ($bookFormats as $formatet) {
        $bookFormatsIds[] = $formatet->id;
    }
    $publishers = Publisher::findAll();
$formats = Formats::findAll();
} catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './php/inc/head_content.php'; ?>
    <title>Add New Book - Exercise</title>
</head>

<body>
    <div class="container">
        <div class="width-12">
            <?php include './php/inc/flash_message.php'; ?>
        </div>
        <div class="width-12">
            <div class="back-link">
                <a href="index.php">&larr; Back to Form Handling </a>
            </div>
        </div>
        <div class="width-12">
            <h1>Add New Book</h1>

            <!-- Display form data and errors for debugging purposes                 -->
            <?php //dd(getFormData()); ?>
            <?php //dd(getFormErrors()); ?>

        </div>
        <div class="width-12">
            <form action="book_update.php" method="POST" enctype="multipart/form-data">
                <div class="input">
                    <input type="hidden" name="id" value="<?= h($book->id) ?>">
                </div>

                <!-- =============================================================== -->
                <!-- Book Title Field                                                -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="title">Book Title:</label>
                    <!-- ===========================================================
                        STEP 6: Repopulate Fields
                        See: /examples/04-php-forms/step-06-repopulate-fields/
                        ===========================================================
                        TODO: Repopulate title field
                        
                    -->

                    <input type="text" id="title" name="title" value="<?= h(old("title", $book->title)); ?>">
                    <!--===========================================================STEP 5: Display Errors See:
                        /examples/04-php-forms/step-05-display-errors/===========================================================TODO:
                        Display error message if title validation fails -->
                    <?php if (error('title')): ?>
                        <p class="error">
                            <?= error('title') ?>
                        </p>
                    <?php endif; ?>

                </div>

                <!-- =============================================================== -->
                <!-- Author Field                                                    -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="author">Author:</label>
                    <!-- TODO: Repopulate author field                               -->
                    <input type="text" id="author" name="author" value="<?= h(old("author", $book->author)); ?>">

                    <!-- TODO: Display error message if author validation fails      -->
                    <?php if (error('author')): ?>
                        <p class="error">
                            <?= error('author') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- =============================================================== -->
                <!-- Publisher Select Field                                          -->
                <!-- See: /examples/04-php-forms/step-07-select-checkbox/            -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>
                        <!-- =======================================================
                            STEP 7: Select & Checkbox Handling
                            See: /examples/04-php-forms/step-07-select-checkbox/
                            ======================================================= 
                            TODO: Use chosen() to repopulate selected option 
                        -->
                        <?php foreach ($publishers as $pub): ?>
                            <option value="<?= h($pub->id) ?>" <?= chosen('publisher_id', $pub->id, $book->publisher_id) ? "selected" : "" ?>>
                                <?= h($pub->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- TODO: Display error message if publisher validation fails   -->
                    <?php if (error('publisher_id')): ?>
                        <p class="error">
                            <?= error('publisher_id') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- =============================================================== -->
                <!-- Year Field                                                      -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="year">Year:</label>
                    <!-- TODO: Repopulate year field                                 -->
                    <input type="text" id="year" name="year" value="<?= h(old("year", $book->year)); ?>">

                    <!-- TODO: Display error message if year validation fails        -->
                    <?php if (error('year')): ?>
                        <p class="error">
                            <?= error('year') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- =============================================================== -->
                <!-- ISBN Field                                                      -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <!-- TODO: Repopulate ISBN field                                 -->
                    <input type="text" id="isbn" name="isbn" value="<?= h(old("isbn", $book->isbn)); ?>">

                    <!-- TODO: Display error message if ISBN validation fails        -->
                    <?php if (error('isbn')): ?>
                        <p class="error">
                            <?= error('isbn') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- =============================================================== -->
                <!-- Format Checkboxes                                              -->
                <!-- See: /examples/04-php-forms/step-07-select-checkbox/            -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label>Available Formats:</label>
                    <div class="checkbox-group">
                        <!-- =======================================================
                            STEP 7: Select & Checkbox Handling
                            See: /examples/04-php-forms/step-07-select-checkbox/
                            =======================================================
                            TODO: Use chosen() to repopulate checkbox state
                        -->
                        <?php foreach ($formats as $format): ?>
                           <label class="checkbox-label">
                                <input type="checkbox" id="platform_<?= h($format->id) ?>" name="format_ids[]" value="<?= h($format->id) ?>"
                                    <?= chosen('format_ids', $format->id,$bookFormatsIds) ? 'checked' : '' ?>>
                                <!-- <?= h($format->name) ?> -->
                                <label for="platform_<?= h($format->id) ?>"><?= h($format->name) ?></label>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- TODO: Display error message if formats validation fails     -->
                    <?php if (error('format_ids')): ?>
                        <p class="error">
                            <?= error('format_ids') ?>
                        </p>
                    <?php endif; ?>

                </div>

                <!-- =============================================================== -->
                <!-- Description Field                                               -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <!-- TODO: Repopulate description field                          -->
                    <textarea id="description" name="description"
                        rows="5"><?= h(old("description", $book->description)); ?></textarea>

                    <!-- TODO: Display error message if description validation fails -->
                    <?php if (error('description')): ?>
                        <p class="error">
                            <?= error('description') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- =============================================================== -->
                <!-- Cover Image File Upload                                         -->
                <!-- See: /examples/04-php-forms/step-09-file-uploads/               -->
                <!-- =============================================================== -->
                <div class=" form-group">
                    <label for="cover">Book Cover Image (max 2MB):</label>
                    <!-- NOTE: File inputs cannot be repopulated for security reasons -->
                    <input type="file" id="cover" name="cover" accept="image/*">

                    <!-- TODO: Display error message if cover validation fails       -->
                    <?php if (error('cover')): ?>
                        <p class="error">
                            <?= error('cover') ?>
                        </p>
                    <?php endif; ?>

                </div>

                <!-- =============================================================== -->
                <!-- Submit Button                                                   -->
                <!-- =============================================================== -->
                <div class="form-group">
                    <button type="submit" class="button">Save Book</button>
                </div>
            </form>
        </div>
        <!-- =================================================================== -->
        <!-- STEP 10: Clean Up                                                   -->
        <!-- See: /examples/04-php-forms/step-10-complete/                       -->
        <!-- =================================================================== -->
        <!-- TODO: Clear form data and errors after displaying the page          -->
        <?php
        //   Clear form data and errors
        ?>
    </div>
    <?php
    // Clear form data after displaying
    clearFormData();
    // Clear errors after displaying
    clearFormErrors();
    ?>
</body>

</html>
<?php
