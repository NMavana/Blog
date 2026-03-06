<?php
include_once "includes/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dynamic Site</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <!--NAV BAR START HERE-->
    <?php include_once "includes/nav.php"; ?>
    <!--NAV BAR END HERE-->

    <!--JUMBOTRON-->
    <?php add_jumbotron (); ?>
    <!--END JUMBOTRON-->

    <!--CARD-->
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Post title</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Author name</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card’s content.</p>
                <a href="#" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scrollspy.js"></script>
</body>
</html>