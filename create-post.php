 <?php
    include 'conect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $body = $_POST['post'];
        if ($title != ''  && $body != '') {
            $sql = "INSERT INTO posts (title, body, author)VALUES ('$title',  '$body','$author')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $sql1 = "SELECT last_Name FROM users";
            $statement = $connection->prepare($sql1);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            // header("Location:index.php");
        } else {
            echo ('Sva polja su obavezna');
        }
    }
    include 'header.php';
    ?>
 <!doctype html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="../../../../favicon.ico">

     <title>Vivify Blog</title>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

     <link href="styles/blog.css" rel="stylesheet">
     <link href="styles/styles.css" rel="stylesheet">
 </head>

 <body>

     </div>

     <main role="main" class="container">
         <div class="row">
             <div class="col-sm-8 blog-main">
                 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                 <form method='POST' id="createPost" action=' '>

                     <input name="title" id='title' placeholder="Enter title"> </input>
                     <br><br>
                     <!-- <select name='user'>
                         <?php
                            foreach ($users as $user) {


                                echo "<option value=\"user1\">" . $row['last_Name'] . "</option>";
                            }
                            ?>
                     </select> -->

                     <br><br>
                     <input name="post" id='post' placeholder="Enter post"> </input>
                     <br><br>
                     <button class="btn" id="submitbutton" value="sumbit">Submit </button>
                 </form>
                 <script>
                     const submitit = document.getElementById('submitbutton');
                     submitit.addEventListener("click", function(e) {
                         const title = document.getElementById('title');
                         //  const author = document.getElementById('author');
                         const post = document.getElementById('post');
                         if (title.value == '' && post.value == '') {
                             e.preventDefault();
                             alert("Molimo vas popunite sva polja");
                         }
                     });
                 </script>

             </div>
             }
             <?php
                include 'sidebar.php';
                ?>
             <nav class="blog-pagination">
                 <a class="btn btn-outline-primary" href="#">Older</a>
                 <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
             </nav>

         </div>
     </main>
     <?php
        include 'footer.php';
        ?>
 </body>

 </html>