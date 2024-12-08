<?php
// Sanitize and validate input
$roomNo = isset($_GET['room_no']) ? htmlspecialchars($_GET['room_no']) : null;

// Connect to the database
require 'partials/_dbConnector.php';

if ($roomNo) {
    try {
        // Prepare and execute the query to fetch equipment data by RoomNo
        $sql_equipments = "SELECT * FROM `equipments` WHERE `RoomNo` = ?";
        $stmt = $conn->prepare($sql_equipments);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        // Bind the room number parameter
        $stmt->bind_param("s", $roomNo); // 's' for string
        $stmt->execute();
        $result = $stmt->get_result();
        $equipments = $result->fetch_all(MYSQLI_ASSOC);

        if (empty($equipments)) {
            echo "No equipment found for Room No: " . htmlspecialchars($roomNo);
        } else {
            // Display the equipment data
            echo "<h2>Equipment Details for Room No: " . htmlspecialchars($roomNo) . "</h2>";
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Name</th><th>Room No</th><th>Condition</th></tr>";
            foreach ($equipments as $equipment) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($equipment['Id']) . "</td>";
                echo "<td>" . htmlspecialchars($equipment['Name']) . "</td>";
                echo "<td>" . htmlspecialchars($equipment['RoomNo']) . "</td>";
                echo "<td>" . ($equipment['Condition'] == 1 ? "Good" : "Bad") . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "Please provide a valid Room No in the query string. $roomNo is not a valid Room No.";
}
?>
