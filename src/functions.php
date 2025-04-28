<?php
session_start();
include __DIR__.'/../config/config.php';

function catApiRequest(string $endpoint, array $params = []) : array
{
    $params['api_key'] = CAT_API_KEY;
    $url               = 'https://api.thecatapi.com/v1/'.$endpoint.'?'.http_build_query($params);

    $json = @file_get_contents($url); 
    if ($json === false) {
        return [];
    }

    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}


function getBreeds() : array
{
    if (!isset($_SESSION['breeds'])) {
        $_SESSION['breeds'] = catApiRequest('breeds');  
    }
    return $_SESSION['breeds'];
}

function findBreedById(string $breedId) : ?array
{
    foreach (getBreeds() as $b) {
        if ($b['id'] === $breedId) {
            return $b;
        }
    }
    return null;
}


function getBreedImages(string $breedId, int $limit = 10) : array
{
    return catApiRequest(
        'images/search',
        [
            'breed_ids' => $breedId,
            'limit'     => $limit,
        ]
    );
}


function renderStars(int $rating) : string
{
    $rating = max(0, min(5, $rating));   
    $html   = '<span class="rating">';
    for ($i = 1; $i <= 5; $i++) {
        $html .= sprintf(
            '<i class="fa-%s fa-star"></i>',
            $i <= $rating ? 'solid' : 'regular'
        );
    }
    return $html.'</span>';
}
?>