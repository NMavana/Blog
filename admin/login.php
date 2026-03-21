<?php
session_start ();
include_once "../includes/connection.php";

if (isset ($_POST[ "signup" ]))
    {
    $author_email    = mysqli_real_escape_string ( $conn, $_POST[ "author_email" ] );
    $author_password = mysqli_real_escape_string ( $conn, $_POST[ "author_password" ] );

    //Checking for empty field
    if (empty ($author_email) OR empty ($author_password))
        {
        header ( "Location: login.php?message=Empty+Fields" );
        exit ();
        }

    //Checking email validity
    if ( ! filter_var ( $author_email, FILTER_VALIDATE_EMAIL ))
        {
        header ( "Location: login.php?message=Please+enter+valid+email" );
        exit ();
        } else
        {
        $sql    = "SELECT * FROM `author` WHERE `author_email`='$author_email'";
        $result = mysqli_query ( $conn, $sql );
        // If email doesn't  exists
        if (mysqli_num_rows ( $result ) <= 0)
            {
            header ( "Location: login.php?message=Login+error" );
            exit ();
            } else
            {
            while ($row = mysqli_fetch_assoc ( $result ))
                {
                //Checking if password matches
                if ( ! password_verify ( $author_password, $row[ "author_password" ] ))
                    {
                    header ( "Location: login.php?message=Incorrect+Password" );
                    exit ();
                    } else if (password_verify ( $author_password, $row[ "author_password" ] ))
                    {
                    $_SESSION[ "author_id" ]    = $row[ "author_id" ];
                    $_SESSION[ "author_name" ]  = $row[ "author_name" ];
                    $_SESSION[ "author_email" ] = $row[ "author_email" ];
                    $_SESSION[ "author_bio" ]   = $row[ "author_bio" ];
                    $_SESSION[ "author_role" ]  = $row[ "author_role" ];
                    header ( "Location: index.php" );
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <h2 class="card-title text-center mb-4">Log in</h2>

                <form method="post">
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

                    <div class="text-center">
                        <p class="text-muted">Don't have an account? <a href="signup.php">Sign up here</a></p>
                        <p class="text-muted"><a href="#">Forgot password?</a></p>
                    </div>

                    <button type="submit" name="signup" class="btn btn-primary w-100 mb-3">Sign In</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>