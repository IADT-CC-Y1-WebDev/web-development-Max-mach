<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>09-1 – Simple Contact Form Validation</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        form {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-width: 420px;
        }

        label {
            font-weight: 600;
        }

        input {
            font-size: 1rem;
            padding: 0.35rem 0.5rem;
        }

        .error {
            color: #b00020;
            font-size: 0.85rem;
            display: inline-block;
        }

        .input-error {
            border-color: #b00020;
            background: #fff5f5;
        }

        #submit_btn {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 09 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>09-1 – Comment Form Validation</h1>

    <p>
        This example validates a comment-style form in the browser before it is sent
        to the server. The same pattern will be used for the games and books forms.
    </p>

    <form id="book_form" novalidate>
        <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

        <div class="form-group">
            Title:
            <input id="title" type="text" name="title">
            <span id="title_error" class="error"></span>
        </div>
        <div class="form-group">
            Author:
            <input id="author" type="text" name="author">
            <span id="author_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="form-label" for="release_date">Release Year:</label>
            <div>
                <input type="date" id="year" name="year">
                <span id="year_error" class="error"></span>
            </div>
        </div>
        <div class="form-group">
            ISBN:
            <input id="isbn" type="text" name="isbn">
            <span id="isbn_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description:</label>
            <div>
                <textarea id="description" name="description" data-minlength="10"></textarea>
                <span id="description_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <button id="submit_btn" type="submit">Submit</button>
        </div>
    </form>

    <script src="books-form.js"></script>
</body>

</html>