<?php
include 'dbcon.php';

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare(
            "INSERT INTO users (name, email) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {
            header("Location: index.php?msg=added");
            exit;
        }
        $stmt->close();
    } else {
        $error = "Please enter a valid name and email.";
    }
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

$messages = [
    'added' => 'User added successfully!',
    'updated' => 'User updated successfully!',
    'deleted' => 'User deleted successfully!'
];
?>