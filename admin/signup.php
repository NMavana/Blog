<?php
include_once "../includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php if (isset ($_GET[ "message" ]))
    {
    $msg = $_GET[ "message" ];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>' . $msg . '</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    } ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body p-5">
                <h2 class="card-title text-center mb-4">Sign Up</h2>

                <form method="post">
                    <div class="mb-3">
                        <label for="author_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="input" name="author_name" placeholder="Enter name"
                            required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="author_email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="inputEmail" name="author_email"
                            placeholder="Enter your email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="author_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="author_password"
                            placeholder="Enter your password" required>
                    </div>


                    <button type="submit" name="signup" class="btn btn-primary w-100 mb-3">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
    <?php

    if (isset ($_POST[ "signup" ]))
        {
        $author_name     = mysqli_real_escape_string ( $con, $_POST[ "author_name" ] );
        $author_email    = mysqli_real_escape_string ( $con, $_POST[ "author_email" ] );
        $author_password = mysqli_real_escape_string ( $con, $_POST[ "author_password" ] );

        //Checking for empty field
        if (empty ($author_name) OR empty ($author_email) OR empty ($author_password))
            {
            header ( "Location: signup.php?message=Empty+Fields" );
            }

        //Checking email validity
        if ( ! filter_var ( $author_email, FILTER_VALIDATE_EMAIL ))
            {
            header ( "Location: signup.php?message=Please+enter+valid+email" );
            }
        } ?>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>