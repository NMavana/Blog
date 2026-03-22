<?php
// 175 Created tables for post and categories
session_start ();
include_once ("../includes/connection.php");

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
                <?php if (isset ($_GET[ "message" ]))
                {
                $msg = $_GET[ "message" ];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>' . $msg . '</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } ?>

                <?php include_once __DIR__ . "/nav.inc.php"; ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Post</h1>
                        <h6>Howdy <?php echo $_SESSION[ "author_name" ]; ?> | Your role is
                            <?php echo $_SESSION[ "author_role" ]; ?>
                        </h6>
                    </div>

                    <div id="admin-index-form">
                        <h1>ALL POST:</h1>
                        <a href="newpost.php"><button class="btn btn-info">Add New</button></a>


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