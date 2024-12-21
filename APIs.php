<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Function to fetch all blogs
if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET['id'])) {
    $result = $conn->query("SELECT * FROM blogs");
    $blogs = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($blogs);
}

// Function to fetch a blog by ID
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM blogs WHERE id = $id");
    $blog = $result->fetch_assoc();
    echo json_encode($blog ?: ['message' => 'Blog not found']);
}

// Function to create a new blog
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $category = $conn->real_escape_string($data['category']);
    $conn->query("INSERT INTO blogs (title, description, category) VALUES ('$title', '$description', '$category')");
    echo json_encode(['message' => 'Blog created']);
}

// Function to update an existing blog
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = (int)$data['id'];
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $category = $conn->real_escape_string($data['category']);
    $conn->query("UPDATE blogs SET title = '$title', description = '$description', category = '$category' WHERE id = $id");
    echo json_encode(['message' => 'Blog updated']);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
$conn->close();
?>
