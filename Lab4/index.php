<?php
session_start();
require 'jwt_helper.php';

// Проверка дали JWT токенот постои и е валиден
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: login.php");
    exit;
}
$db =new SQLite3(__DIR__ . '/db.sqlite');

$query= "SELECT * FROM expenses";
$result = $db->query($query);

if(!$result){
    die("error: " .$db->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Products List</h1>
    <a href="add_expense_form.php">
        Add Expense
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Payment Type</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($expense = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($expense['id']); ?></td>
                <td><?php echo htmlspecialchars($expense['name']); ?></td>
                <td><?php echo htmlspecialchars($expense['date']); ?></td>
                <td><?php echo htmlspecialchars($expense['amount']); ?></td>
                <td><?php echo htmlspecialchars($expense['payment_type']); ?></td>
                <td>
                    <form action="delete_expense.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_form.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No products found.</td>
        </tr>
        <?php  while ($expense = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr><td>{$expense['id']}</td><td>{$expense['name']}</td>...</tr>";
        }
    endif; ?>
    </tbody>
</table>
</body>
</html>
