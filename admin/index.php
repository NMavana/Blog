<?php
include_once ("../includes/connection.php");
session_start ();

if (isset ($_SESSION[ "author_role" ]))
    {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="../style/bootstrap.min.css">
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="logout.php">Sign out</a>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <span data-feather="home"></span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file"></span>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="shopping-cart"></span>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="bar-chart-2"></span>
                                    Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="layers"></span>
                                    Integrations
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                        <h6>Howdy <?php echo $_SESSION[ "author_name" ]; ?> | Your role is
                            <?php echo $_SESSION[ "author_role" ]; ?>
                        </h6>
                    </div>

                    <div id="admin-index-form">
                        <?php if (isset ($_GET[ "message" ]))
                        {
                        $msg = $_GET[ "message" ];
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>' . $msg . '</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                        } ?>
                        <h1>Your Profile</h1>
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputText" class="form-label">Name</label>
                                <input type="text" name="author_name" class="form-control" id="exampleInputText"
                                    placeholder="Enter Name" value="<?php echo $_SESSION[ "author_name" ]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="author_email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Email"
                                    value="<?php echo $_SESSION[ "author_email" ]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="author_password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter Password">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Your Bio</label>
                                <textarea id="story" name="author_bio" rows="5" cols="33"
                                    class="form-control"><?php echo $_SESSION[ "author_bio" ]; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>
                        <?php
                        if (isset ($_POST[ "update" ]))
                            {
                            $author_name     = mysqli_real_escape_string ( $conn, $_POST[ "author_name" ] );
                            $author_email    = mysqli_real_escape_string ( $conn, $_POST[ "author_email" ] );
                            $author_password = mysqli_real_escape_string ( $conn, $_POST[ "author_password" ] );
                            $author_bio      = mysqli_real_escape_string ( $conn, $_POST[ "author_bio" ] );
                            }

                        //Checking if field are empty
                        if (empty ($author_name) OR empty ($author_email) OR empty ($author_bio))
                            {
                            header("Location: index.php?message=Empty+Fields");
                            exit();
                            } else
                            {
                            // CHecking if email is valid
                            if ( ! filter_var ( $author_email, FILTER_VALIDATE_EMAIL ))
                                {
                                echo "Please enter a Valid email";
                                } else
                                {
                                // Check if password entered is new
                                if (empty ($author_password))
                                    {
                                    // user don't want to change his password
                                    $author_id = $_SESSION[ 'author_id' ];
                                    $sql       = "UPDATE `author` SET `author_name`= '$author_name', `author_email`='$author_email', `author_bio`='$author_bio' WHERE `author_id`='$author_id'";
                                    if (mysqli_query ( $conn, $sql ))
                                        {
                                        $_SESSION[ "author_name" ]  = $author_name;
                                        $_SESSION[ "author_email" ] = $author_email;
                                        $_SESSION[ "author_bio" ]   = $author_bio;
                                        header ( "Location: index.php?message=Record+Updated" );
                                        exit();
                                        } else
                                        {
                                        echo "error";
                                        }
                                    } else
                                    {
                                    //user wants to change his password
                                    }
                                }
                            }
                        ?>
                    </div>
                </main>
            </div>
        </div>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/scrollspy.js"></script>
    </body>

    </html>
    <?php
    } else
    {
    header ( "Location: login.php?message=Please+Login" );
    exit ();
    }
?>