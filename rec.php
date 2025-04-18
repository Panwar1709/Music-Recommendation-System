<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

// Initialize variables
$query = "";
$params = [];
$whereClauses = [];

// Handle mood or search query
if (isset($_GET['mood'])) {
    $mood = $conn->real_escape_string($_GET['mood']);
    $whereClauses[] = "mood = '$mood'";
} 

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $whereClauses[] = "(title LIKE '%$search%' OR artist LIKE '%$search%')";
}

// Build the query
if (!empty($whereClauses)) {
    $query = "SELECT * FROM songs WHERE " . implode(' AND ', $whereClauses);
} else {
    echo json_encode(['error' => 'No search criteria provided']);
    $conn->close();
    exit();
}

$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Query error: ' . $conn->error]);
    $conn->close();
    exit();
}

$songs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = [
            'title' => htmlspecialchars($row['title']),
            'artist' => htmlspecialchars($row['artist']),
            'filepath' => htmlspecialchars($row['filepath']),
            'mood' => isset($row['mood']) ? htmlspecialchars($row['mood']) : null
        ];
    }
    echo json_encode(['songs' => $songs]);
} else {
    echo json_encode(['error' => 'No songs found']);
}

$conn->close();
?>