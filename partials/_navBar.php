<?php
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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Departments
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        for ($x = 0; $x <= 3; $x++) {
                            $dept = $departments[$x];
                        ?>
                            <li><a class="dropdown-item" href="facilities.php?department=<?php echo urlencode($dept); ?>"><?php echo $dept; ?></a></li>
                        <?php
                        }
                        ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php
                        for ($x = 4; $x <= 9; $x++) {
                            $dept = $departments[$x];
                        ?>
                            <li><a class="dropdown-item" href="facilities.php?department=<?php echo urlencode($dept); ?>"><?php echo $dept; ?></a></li>
                        <?php
                        }
                        ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <?php
                        for ($x = 10; $x <= 13; $x++) {
                            $dept = $departments[$x];
                        ?>
                            <li><a class="dropdown-item" href="facilities.php?department=<?php echo urlencode($dept); ?>"><?php echo $dept; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>