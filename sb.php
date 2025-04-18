<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "music_app";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle upload form submission
if (isset($_POST['submit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $artist = $conn->real_escape_string($_POST['artist']);
    $mood = $conn->real_escape_string($_POST['mood']);

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["audiofile"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Validate file type
    $audioFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['mp3', 'wav', 'ogg','mpeg'];
    
    if (!in_array($audioFileType, $allowedTypes)) {
        $uploadError = "Only MP3, WAV & OGG files are allowed.";
    } elseif (move_uploaded_file($_FILES["audiofile"]["tmp_name"], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO songs (title, artist, mood, filepath) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $artist, $mood, $targetFilePath);
        if ($stmt->execute()) {
            $uploadSuccess = true;
        } else {
            $uploadError = "Database error: " . $stmt->error;
        }
    } else {
        $uploadError = "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Upload App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: blur(10px);
        }
        .content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 to-purple-800 min-h-screen text-white p-6">
    <!-- Background Video -->
    <video autoplay muted loop class="background-video">
        <source src="V1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="max-w-md mx-auto">
        <header class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4">🎵 Music Upload</h1>
            <p class="text-xl text-indigo-200">Share your favorite songs with the world!</p>
        </header>

        <!-- Upload Form -->
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-upload"></i> Upload a Song
            </h2>
            
            <?php if (isset($uploadSuccess)): ?>
                <div class="mb-4 p-4 bg-green-500/20 rounded-lg border border-green-500 flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-400"></i>
                    <span>Song uploaded successfully!</span>
                </div>
            <?php elseif (isset($uploadError)): ?>
                <div class="mb-4 p-4 bg-red-500/20 rounded-lg border border-red-500 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                    <span><?php echo htmlspecialchars($uploadError); ?></span>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" required 
                        class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div>
                    <label class="block mb-1 font-medium">Artist</label>
                    <input type="text" name="artist" required 
                        class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div>
                    <label class="block mb-1 font-medium">Mood</label>
                    <select name="mood" class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Happy">😊 Happy</option>
                        <option value="Sad">😢 Sad</option>
                        <option value="Chill">🧘 Chill</option>
                        <option value="Party">🎉 Party</option>
                    </select>
                </div>
                
                <div>
                    <label class="block mb-1 font-medium">Audio File</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-white/30 hover:border-purple-400 hover:bg-white/5 rounded-lg cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <i class="fas fa-music text-2xl mb-2"></i>
                                <p class="text-sm">Click to upload MP3 file</p>
                            </div>
                            <input type="file" name="audiofile" accept="audio/*" required class="hidden">
                        </label>
                    </div>
                </div>
                
                <button type="submit" name="submit" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Song
                </button>
            </form>
        </div>
    </div>
</body>
</html>