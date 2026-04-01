<?php
$games = [
    ['title' => 'The Silent Observatory', 'author' => 'Clara Whitmore', 'year' => 1998],
    ['title' => 'Ashes of Tomorrow', 'author' => 'Daniel K. Reeves', 'year' => 2007],
    ['title' => 'The Clockmaker’s Secret', 'author' => 'Elena Marquez', 'year' => 1985],
    ['title' => 'A Map of Forgotten Places', 'author' => 'Jonah Pierce', 'year' => 2016],
    ['title' => 'Whispers in the Fog', 'author' => 'Lydia Chen', 'year' => 2003],
    ['title' => 'The Last Ember', 'author' => 'Marcus Holloway', 'year' => 1992],
    ['title' => 'Paper Stars', 'author' => 'Amelia Brooks', 'year' => 2021],
    ['title' => 'Beneath Crimson Skies', 'author' => 'Victor Salazar', 'year' => 2010],
    ['title' => 'The Glass Library', 'author' => 'Sophie Laurent', 'year' => 1999],
];
$authors = ['Clara Whitmore', 'Daniel K. Reeves', 'Elena Marquez', 'Jonah Pierce', 'Lydia Chen', 'Action-Adventure'];
$platforms = ['PC', 'PS5', 'Xbox', 'Nintendo Switch'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>08-2 – Games-style Filters with Events</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        .filters {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .filters .input {
            display: flex;
            gap: 20px;
        }

        .filters .input label.filter-label {
            width: 108px;
            display: flex;
            justify-content: flex-end;
            color: #252525;
            font-weight: 900;
            font-size: 0.9rem;
        }

        .filters input,
        .filters select,
        .filters button {
            font-size: 0.9rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .card {
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #f5f5f5;
        }

        .card.hidden {
            display: none;
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 08 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>08-2 – Games filters with events</h1>

    <p>
        This example is a simplified version of the filters you will add to the games
        and books applications. PHP renders the filter controls and cards;
        JavaScript listens for button clicks and applies the filters.
    </p>

    <form id="filters" class="filters">
        <div class="input">
            <label class="filter-label" for="title_filter">Title:</label>
            <div>
                <input type="text" id="title_filter" name="title_filter" placeholder="Part of a title">
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="author_filter">Author:</label>
            <div>
                <input type="text" id="author_filter" name="author_filter" placeholder="Part of a title">
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="sort_by">Sort:</label>
            <div>
                <select name="sort_by" id="sort_by">
                    <option value="all">All years</option>
                    <option value="before_2000">Before 2000</option>
                    <option value="2000_and_later">2000 and later</option>
                </select>
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="apply_filters">Actions</label>
            <div>
                <button type="button" id="apply_filters">Apply Filters</button>
                <button type="button" id="clear_filters">Clear Filters</button>
            </div>
        </div>
    </form>

    <div id="game_cards" class="cards">
        <?php foreach ($games as $game): ?>
            <div class="card" data-title="<?= htmlspecialchars($game['title']) ?>"
                data-author="<?= htmlspecialchars($game['author']) ?>" data-year="<?= $game['year'] ?>">
                <h3>
                    <?= htmlspecialchars($game['title']) ?>
                </h3>
                <p>
                    <?= htmlspecialchars($game['author']) ?> (<?= (int) $game['year'] ?>)
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="books-filters.js"></script>
</body>

</html>