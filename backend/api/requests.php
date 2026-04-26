<?php

// API for handling portfolio detail requests

header('Content-Type: application/json');

// Database connection (Assuming you have a database connection here)
// Replace with your actual database connection code

function getPortfolioDetails($portfolioId) {
    // Example database query (replace with your actual query)
    // Fetch portfolio details from your database
    // 
    $portfolioDetails = [
        'id' => $portfolioId,
        'name' => 'Sample Portfolio',
        'description' => 'This is a sample portfolio description',
        'created_at' => '2022-01-01 00:00:00',
    ];

    return $portfolioDetails;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['portfolio_id'])) {
        $portfolioId = $_GET['portfolio_id'];
        $response = getPortfolioDetails($portfolioId);
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Portfolio ID is required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>