<?php

include __DIR__.'/src/functions.php';

$breeds = getBreeds();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cat Carousel</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous" />

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Cat Carousel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Pick a Cat Breed</h1>

    <form class="row g-3 justify-content-center" method="get" action="carousel.php">

        <div class="col-md-6">
            <label for="breedSelect" class="form-label visually-hidden">Breed</label>
            <select id="breedSelect" class="form-select" name="breed_id" required>
                <option value="">— Choose a breed —</option>
                <?php foreach ($breeds as $breed): ?>
                    <option value="<?= htmlspecialchars($breed['id']) ?>">
                        <?= htmlspecialchars($breed['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-auto">
            <button type="submit" class="btn btn-primary w-100">
                Show Carousel
            </button>
        </div>
    </form>

    <?php if (empty($breeds)) : ?>
        <div class="alert alert-danger mt-4" role="alert">
            Cat api doesnt work
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
