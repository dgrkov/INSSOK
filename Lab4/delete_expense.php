<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $db = new SQLite3(__DIR__ . "/db.sqlite");

    $stmt = $db->prepare("DELETE FROM expenses WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $db->close();
    header("Location: index.php");
    exit();
} else {
    echo "Loser!";
}