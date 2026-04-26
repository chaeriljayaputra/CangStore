<?php

// Set header to allow access from any origin
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

// Sample data for products (in a real application, this data should come from a database)
$products = [];

// Function to get products
function getProducts() {
    global $products;
    echo json_encode($products);
}

// Function to get a product by ID
function getProduct($id) {
    global $products;
    if (isset($products[$id])) {
        echo json_encode($products[$id]);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Product not found.']);
    }
}

// Function to create a new product
function createProduct($data) {
    global $products;
    $products[] = $data;
    echo json_encode(['message' => 'Product created successfully.']);
}

// Function to update a product
function updateProduct($id, $data) {
    global $products;
    if (isset($products[$id])) {
        $products[$id] = $data;
        echo json_encode(['message' => 'Product updated successfully.']);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Product not found.']);
    }
}

// Function to delete a product
function deleteProduct($id) {
    global $products;
    if (isset($products[$id])) {
        unset($products[$id]);
        echo json_encode(['message' => 'Product deleted successfully.']);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Product not found.']);
    }
}

// Handle the request
$method = $_SERVER['REQUEST_METHOD'];
$url = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$productId = isset($url[1]) ? (int)$url[1] : null;

switch ($method) {
    case 'GET':
        if ($productId !== null) {
            getProduct($productId);
        } else {
            getProducts();
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        createProduct($data);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        updateProduct($productId, $data);
        break;
    case 'DELETE':
        deleteProduct($productId);
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed.']);
        break;
}