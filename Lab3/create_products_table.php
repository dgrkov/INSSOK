<?php
$db = new SQLite3(__DIR__ . '/database/products_db.sqlite');

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT UNIQUE NOT NULL,
    price REAL NOT NULL
);
SQL;

$result = $db->query($createTableQuery);

if ($db->exec($createTableQuery)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}

$db->close();
?>
