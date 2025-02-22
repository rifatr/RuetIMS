<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: users/login.php");
    exit;
}

require '_dbConnector.php';

// Sanitize and get the username from the session
$loggedinUsername = $_SESSION['username'];
$hasAccess = false;

// Prepare a statement to fetch access data
$stmt = $conn->prepare("SELECT CanUpdateData FROM `users` WHERE `username` = ?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind the session username to the query
$stmt->bind_param("s", $loggedinUsername);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the row
    $row = $result->fetch_assoc();

    $hasAccess = $row['CanUpdateData'];
}

// List of departments
$departments = [
    "Electrical and Electronic Engineering",
    "Computer Science and Engineering",
    "Electrical and Computer Engineering",
    "Electronics and Telecommunication Engineering",
    "Mechanical Engineering",
    "Industrial and Production Engineering",
    "Mechatronics Engineering",
    "Materials Science and Engineering",
    "Chemical Engineering",
    "Glass and Ceramic Engineering",
    "Civil Engineering",
    "Building Engineering and Construction Management",
    "Urban and Regional Planning",
    "Architecture"
];
$departmentsShortName = [
    "EEE", "CSE", "ECE", "ETE",
    "ME", "IPE", "MTE", "MSE", "ChE", "GCE",
    "CE", "BECM", "URP", "ARCH"
];
?>


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">RUET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://localhost/ruetIMS/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Departments
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $faculty_range = [[0, 3], [4, 9], [10, 13]];
                        foreach ($faculty_range as $range) {
                            for ($i = $range[0]; $i <= $range[1]; $i++) {
                                $dept = $departments[$i];
                                echo '<li><a class="dropdown-item" href="http://localhost/ruetIMS/facilities.php?department=' . urlencode($dept) . '">' . $dept . '</a></li>';
                            }
                            if ($range[1] != 13)
                                echo '<li><hr class="dropdown-divider"></li>';
                        }
                        ?>
                    </ul>
                </li>

                <?php
                if ($hasAccess) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Update Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="http://localhost/ruetIMS/update/updateEquipment.php?type=update">Update Equipment</a></li>
                            <li><a class="dropdown-item" href="http://localhost/ruetIMS/update/updateEquipment.php?type=remove">Delete Equipment</a></li>
                            <li><a class="dropdown-item" href="http://localhost/ruetIMS/update/updateEquipment.php?type=add">Add Equipment</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
            <!-- Profile Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($loggedinUsername); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="users/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>