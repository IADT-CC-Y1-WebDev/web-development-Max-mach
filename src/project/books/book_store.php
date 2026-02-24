<?php
/**
 * User Registration Handler - Exercise
 *
 * Follow the steps below to progressively implement form handling.
 * Each step corresponds to an example in /examples/04-php-forms/
 *
 * This file processes the form submission from book_create.php
 */


// =============================================================================
// Write your code here
// =============================================================================
// Include the required library files
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

$data = [];
$errors = [];

// Start the session
startSession();

try {
    // =========================================================================
    // STEP 1: View Posted Data
    // See: /examples/04-php-forms/step-01-form-submission/
    // =========================================================================
    // TODO: First, just dump the posted data to see what's submitted

    // dd($_POST);

    // =========================================================================
    // STEP 2: Check Request Method
    // See: /examples/04-php-forms/step-02-request-method/
    // =========================================================================
    // TODO: Check that the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }


    // =========================================================================
    // STEP 3: Extract Data
    // See: /examples/04-php-forms/step-03-data-extraction/
    // =========================================================================
    // TODO: Extract form data into $data array
    // Use the null coalescing operator (??) to provide default values
    //
    // Hint: The format_ids field uses an array (format_ids[]) because multiple
    // checkboxes can be selected. This is already handled in the $data 
    // extraction:
    // 'format_ids' => $_POST['format_ids'] ?? []
    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null
    ];
    // dd($data);

    // =========================================================================
    // STEP 4: Validate Data
    // See: /examples/04-php-forms/step-04-validation/
    // =========================================================================
    // TODO: Define validation rules for each field
    // TODO: Check validation data against the rules
    // Create validator and check if validation fails; if so, store the first 
    // error for each field in the $errors array and throw an exception
    $year = date('Y');
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'publisher_id' => 'required|notempty|integer',
        'year' => 'required|notempty|minvalue:1900|maxvalue:' . $year,
        'isbn' => 'required|notempty|min:13|max:13',
        'format_ids' => 'required|notempty|array|min:1|max:4',
        'description' => 'required|notempty|min:10',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];
    $validator = new Validator($data, $rules);
    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception("Validation failed.");
    }
    $genre = Genre::findById($data['publisher_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover']);
    // echo "Validation passed";
    $book = new Book();
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->isbn = $data['isbn'];
    $book->year = $data['year'];
    $book->format_ids = $data['format_ids'];
    $book->description = $data['description'];
    if ($imageFilename) {
        $book->cover_filename = $imageFilename;
    }

    // Save to database
    $book->save();


    clearFormData();
    clearFormErrors();
    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On successful registration, set a success flash message and 
    // redirect back to the form
    setFlashMessage('success', 'Form validated successfully!');
    redirect("index.php");
} catch (Exception $e) {
    // =========================================================================
    // STEP 5: Store Errors and Redirect
    // See: /examples/04-php-forms/step-05-display-errors/
    // =========================================================================
    // TODO: In the catch block, store validation errors in the session
    // TODO: Redirect back to the form
    setFormErrors($errors);
    // =========================================================================
    // STEP 6: Store Form Data for Repopulation
    // See: /examples/04-php-forms/step-06-repopulate-fields/
    // =========================================================================
    // TODO: Before redirecting on error, also store the form data
    setFormData($data);

    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On validation error, you set an error flash message
    setFlashMessage('error', 'Form validated failed!');
    redirect("book_create.php");
}
