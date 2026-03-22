<?php

session_start ();
include_once ("../includes/connection.php");

if (isset ($_POST[ "submit" ]))
    {

    $post_title    = mysqli_real_escape_string ( $conn, $_POST[ "post_title" ] );
    $post_category = mysqli_real_escape_string ( $conn, $_POST[ "post_category" ] );
    $post_content  = mysqli_real_escape_string ( $conn, $_POST[ "post_content" ] );
    $post_keyword  = mysqli_real_escape_string ( $conn, $_POST[ "post_keyword" ] );
    }

if (isset ($_SESSION[ "author_role" ]))
    {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Post</title>
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
                        <h1 class="h2">Add New Post</h1>
                        <h6>Howdy <?php echo $_SESSION[ "author_name" ]; ?> | Your role is
                            <?php echo $_SESSION[ "author_role" ]; ?>
                        </h6>
                    </div>

                    <div id="admin-index-form">
                        <form enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="post_title"
                                    placeholder="Title of the Post">
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Post Category</label>
                                <select class="form-select" name="post_category" aria-label="Default select example">
                                    <option selected>Select the post Category</option>
                                    <?php
                                    $sql    = "select * from category";
                                    $result = mysqli_query ( $conn, $sql );
                                    while ($row = mysqli_fetch_assoc ( $result ))
                                        {
                                        ?>
                                        <option value="<?php echo $row[ 'category_id' ] ?>">
                                            <?php echo $row[ 'category_name' ] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Post Content</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="post_content" placeholder="Leave a comment here"
                                        id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Post Content</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Post Image</label>
                                <input name="file" class="form-control" type="file" id="formFile">
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Post Keywords</label>
                                <input type="text" class="form-control" id="title" name="post_keyword"
                                    placeholder="Enter Keywords">
                            </div>

                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>

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