<?php
$labDepartment = isset($_GET['department']) ? htmlspecialchars($_GET['department']) : "Unknown Department";

// Connect to the database
require 'partials/_dbconnect.php';
$sql_dept = "SELECT * FROM `departments` WHERE `FullName` = '$labDepartment'";
$departmentData = mysqli_fetch_assoc(mysqli_query($conn, $sql_dept));

$sql_labs = "SELECT * FROM `labs` WHERE `department_id` = '" . $department['department_id'] . "'";
$result_labs = mysqli_query($conn, $sql_labs);
$labs = mysqli_fetch_all($result_labs, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - <?php echo $labDepartment; ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Page Styling (can move to external styles.css) */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background-color: #001f54;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        button {
            background-color: navy;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php require 'partials/_navBar.php' ?>

    <div class="container mt-5">
        <div class="text-center">
            <h1>Labs of <?php echo $labDepartment; ?></h1>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <?php foreach ($labs as $lab) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title
                            "><?php echo $lab['name']; ?></h5>
                            <p class="card-text"><?php echo $lab['description']; ?></p>
                            <a href="lab.php?lab_id=<?php echo $lab['lab_id']; ?>" class="btn btn-primary">View Lab</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <?php require 'partials/_footer.php' ?>

</body>

</html>