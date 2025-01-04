<?php
$operationType = $_GET['type'];
$roomNoFromUrl = isset($_GET['room_no']) ? htmlspecialchars($_GET['room_no']) : null;
$operationStatus = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../partials/_dbConnector.php";

    $equipment_id = $_POST['equipment_id'] ?? null;
    $equipment_name = $_POST['equipment_name'] ?? null;
    $room_no = $roomNoFromUrl ?? $_POST['room_no'] ?? null;
    $department = $_POST['department'] ?? null;
    $condition = ($_POST['condition'] ?? '') === 'Good' ? 1 : 0;

    if ($operationType === 'update') {
        $sql = "UPDATE `equipments` SET `Condition` = '$condition' WHERE `ID` = '$equipment_id'";
    } else if ($operationType === 'remove') {
        $sql = "DELETE FROM `equipments` WHERE `ID` = '$equipment_id'";
    } else if ($operationType === 'add') {
        $sql = "INSERT INTO `equipments` (`Name`, `RoomNo`, `Department`, `Condition`) VALUES ('$equipment_name', '$room_no', '$department', '$condition')";
    } else {
        $sql = "SELECT * FROM `equipments`";
    }

    $result = mysqli_query($conn, $sql);
    if ($result)
        $addedSuccessfully = true;
}

if ($operationType === 'update')
    $title = "Update Equipment Condition";
else if ($operationType === 'remove')
    $title = "Remove Equipment";
else if ($operationType === 'add')
    $title = "Add Equipment Information";
else {
    $title = "Invalid operation type";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $title ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        main {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .updateEquipment-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .updateEquipment-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(38, 132, 255, 0.8);
        }

        .btn-primary {
            background: #2575fc;
            border: none;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-primary:hover {
            background: #1c5bcc;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 50px 20px;
            background-color: #e0e0e0;
        }

        .hero h1 {
            font-size: 28px;
            color: #002147;
        }
    </style>
</head>

<body>
    <?php require '../partials/_navBar.php' ?>

    <section class="hero">
        <h1><?php echo $title ?></h1>
    </section>

    <main>
        <div class="updateEquipment-container">
            <h2><?php $title ?></h2>
            <form id="updateEquipment-form" action="updateEquipment.php?type=<?php echo $operationType ?>" method="post">
                <?php if ($operationType === 'update' || $operationType === 'remove') { ?>
                    <div class="mb-3">
                        <label for="equipment-id" class="form-label">Equipment ID</label>
                        <input type="text" id="equipment-id" class="form-control" name="equipment_id" placeholder="Equipment ID" required>
                    </div>
                <?php } ?>

                <?php if ($operationType === 'add') { ?>
                    <div class="mb-3">
                        <label for="equipment-name" class="form-label">Equipment Name</label>
                        <input type="text" id="equipment-name" class="form-control" name="equipment_name" placeholder="Equipment Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="room-no" class="form-label">Room No</label>
                        <input type="text" id="room-no" class="form-control" name="room_no" placeholder="Enter room number (eg. CSE101, EEE202)" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <?php foreach ($departmentsShortName as $department) { ?>
                                <option value="<?php echo $department ?>"><?php echo $department ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <?php if ($operationType === 'update' || $operationType === 'add') { ?>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select class="form-select" id="condition" name="condition" required>
                            <option value="Good">Good</option>
                            <option value="Bad">Bad</option>
                        </select>
                    </div>
                <?php } ?>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
            <?php if ($operationStatus === true) { ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $operationType ?> successful!
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php require '../partials/_footer.php' ?>
</body>

</html>