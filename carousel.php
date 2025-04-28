<?php

include __DIR__.'/src/functions.php';

$breedId = $_GET['breed_id'] ?? '';

$breed   = $breedId ? findBreedById($breedId) : null;
$images  = $breed   ? getBreedImages($breedId, 10) : [];

if (!$breed) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($breed['name']) ?> – Cat Carousel</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous" />

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Cat Carousel</a>
    </div>
</nav>


<div class="container mt-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="carousel-wrapper">
                <?php if ($images): ?>
                    <div id="breedCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php foreach ($images as $idx => $_): ?>
                                <button type="button"
                                        data-bs-target="#breedCarousel"
                                        data-bs-slide-to="<?= $idx ?>"
                                        class="<?= $idx === 0 ? 'active' : '' ?>"
                                        aria-current="<?= $idx === 0 ? 'true' : 'false' ?>"
                                        aria-label="Slide <?= $idx + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>

                        <div class="carousel-inner">
                            <?php foreach ($images as $idx => $img): ?>
                                <div class="carousel-item <?= $idx === 0 ? 'active' : '' ?>">
                                    <img src="<?= htmlspecialchars($img['url']) ?>"
                                         class="d-block w-100"
                                         alt="Cat image <?= $idx + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#breedCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#breedCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Unable to load images for this breed.
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6">
            <h2><?= htmlspecialchars($breed['name']) ?></h2>
            <p><strong>Origin:</strong> <?= htmlspecialchars($breed['origin'] ?? 'Unknown') ?></p>
            <p><?= htmlspecialchars($breed['description'] ?? '') ?></p>


            <?php
            $traits = [
                'Intelligence'   => $breed['intelligence']    ?? 0,
                'Energy Level'   => $breed['energy_level']    ?? 0,
                'Affection Level'=> $breed['affection_level'] ?? 0,
                'Child Friendly' => $breed['child_friendly']  ?? 0,
            ];
            ?>
            <h4 class="mt-4">Traits</h4>
            <ul class="list-unstyled">
                <?php foreach ($traits as $label => $score): ?>
                    <li class="mb-2">
                        <span class="me-2"><?= $label ?>:</span>
                        <?= renderStars((int)$score) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Temperament:</strong> <?= htmlspecialchars($breed['temperament'] ?? '') ?></p>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
