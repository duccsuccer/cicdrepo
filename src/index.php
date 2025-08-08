<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>CNAS Assignment - Team Members List</title>
</head>
<body>
    <h2>Team Members in Class - T01 Team – 4</h2>
    <a href="create.php">Add New Team Member</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        // Seed team members (only insert if not already present)
        $teamMembers = [
            ['name' => 'Ruby Lee Yi Xuan',     'email' => 'S10258808@connect.np.edu.sg'],
            ['name' => 'Marie Ong Min En',     'email' => 'S10258840@connect.np.edu.sg'],
            ['name' => 'Cheng Wan Rong Victoria', 'email' => 'S10258250@connect.np.edu.sg'],
            ['name' => 'Edward Ho Wei Chuan',  'email' => 'S10257116@connect.np.edu.sg'],
        ];

        foreach ($teamMembers as $member) {
            $name = $member['name'];
            $email = $member['email'];

            $check = $conn->prepare("SELECT id FROM users WHERE name=? AND email=?");
            $check->bind_param("ss", $name, $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows == 0) {
                $insert = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                $insert->bind_param("ss", $name, $email);
                $insert->execute();
                $insert->close();
            }

            $check->close();
        }

        // Display all users
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>
                        <a href='update.php?id={$row['id']}'>Edit</a> |
                        <a href='delete.php?id={$row['id']}'>Delete</a>
                    </td>
                  </tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

