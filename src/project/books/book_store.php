<?php
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

$data = [];
$errors = [];

startSession();

try {


    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }


    $isbn = $_POST['isbn'];
    $isbnCheck =  preg_replace('/\D/', '', $isbn);

    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' =>  $isbnCheck ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null
    ];


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

    $publisher_id = Publisher::findById($data['publisher_id']);
    if (!$publisher_id) {
        throw new Exception('Selected genre does not exist.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover']);
    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }


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

    $book->save();


    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            // Verify platform exists before creating relationship
            if (Formats::findById($formatId)) {
                BookPlatform::create($book->id, $formatId);
            }
        }
    }

    clearFormData();

    clearFormErrors();

    setFlashMessage('success', 'Book create successfully!');

    redirect("book_list.php");

} catch (Exception $e) {
    setFormErrors($errors);

    setFormData($data);

    setFlashMessage('error', 'Form validated failed!');

    redirect("book_create.php");
}
