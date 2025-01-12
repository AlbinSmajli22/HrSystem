<?php
session_start();
// Database connection
$conn = new mysqli('localhost', 'root', '', 'hrsystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_id, name, surname FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Table</title>
    <style>
        /* Style for the 3-dots menu */
        .more-menu {
            position: relative;
            display: inline-block;
        }
        .more {
            cursor: pointer;
            font-size: 18px;
        }
        .comments {
            display: none;
            position: absolute;
            top: 20px;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
            border-radius: 4px;
        }
        .comments a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        .comments a:last-child {
            border-bottom: none;
        }
        .comments a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['surname']}</td>
                            <td>
                                <div class='more-menu'>
                                    <span class='more'>⋮</span>
                                    <div class='comments'>
                                        <a href='edit_product.php?id={$row['user_id']}'>Edit</a>
                                        <a href='delete_product.php?id={$row['user_id']}'>Delete</a>
                                    </div>
                                </div>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        // JavaScript to toggle the 3-dots menu
        document.querySelectorAll('.more').forEach(more => {
            more.addEventListener('click', function () {
                const comments = this.nextElementSibling;
                const allComments = document.querySelectorAll('.comments');
                allComments.forEach(c => c !== comments && (c.style.display = 'none'));
                comments.style.display = comments.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Close menu if clicked outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.more-menu')) {
                document.querySelectorAll('.comments').forEach(comments => comments.style.display = 'none');
            }
        });
    </script>
</body>
</html>
