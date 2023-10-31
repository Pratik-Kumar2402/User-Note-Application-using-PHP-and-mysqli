<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}

?>

<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user.css">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <!-- datatables css -->
   <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>

   <div class="user-container">
      <div class="content">
         <h3>welcome, <span><?php echo $_SESSION['user_name'] ?></span></h3>
         <h4>You have logged in as user</h4>
         <a href="logout.php" class="btn">logout</a>
      </div>

   </div>

   <?php
   // for deleting record
   if (isset($_GET['delete'])) {
      $sr_no = $_GET['delete'];
      $sql = "DELETE FROM `notes` WHERE `sr_no` = $sr_no;";
      $result = mysqli_query($conn, $sql);

      if ($result) {
         echo "<div class='alert alert-success' role='alert'>
        <strong>Success!</strong> Note successfully deleted.
      </div>
      </div>";
      } else {
         echo "Error occurred: " . mysqli_error($conn);
      }
   }

   // for updating and inserting record
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (isset($_POST['sr_noEdit'])) {
         // updating the record
         $title = $_POST['titleEdit'];
         $desc = $_POST['descEdit'];
         $sr_no = $_POST['sr_noEdit'];

         $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$desc' WHERE `sr_no` = $sr_no;";
         $result = mysqli_query($conn, $sql);

         if ($result) {
            echo "<div class='alert alert-success' role='alert'>
            <strong>Success!</strong> Note successfully updated.
          </div>
          </div>";
         } else {
            echo "Error occurred: " . mysqli_error($conn);
         }
      } else {
         // inserting the record
         $name = $_SESSION['user_name'];
         $title = $_POST['title'];
         $desc = $_POST['desc'];

         $sql = "INSERT INTO `notes`(`name`,`title`, `description`) VALUES ('$name','$title','$desc')";
         $result = mysqli_query($conn, $sql);

         if ($result) {
            $insert = true;
            echo "<div class='alert alert-success' role='alert'>
            <strong>Success!</strong> Note successfully entered.
          </div>
          </div>";
         } else {
            echo "Error occurred: " . mysqli_error($conn);
         }
      }
   }
   ?>

   <!-- insertion form -->
   <div class="container my-4">
      <h2>Add a Note</h2>
      <form action="/user_page.php" method="POST">
         <div class="form-group">
            <label for="title">Note Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
         </div>
         <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
         </div>
         <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
   </div>

   <div class="container">
      <table class="table" id="myTable">
         <thead class="thead-dark">
            <tr>
               <th scope="col">Sr No</th>
               <th scope="col">Title</th>
               <th scope="col">Description</th>
               <th scope="col">Time Stamp</th>
               <th scope="col">Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $name = $_SESSION['user_name'];
            $sql = "SELECT * FROM `notes` WHERE `name` = '$name'";
            // DELETE FROM `notes` WHERE `sr_no` = $sr_no;
            $result = mysqli_query($conn, $sql);
            $sr_no = 0;
            while ($row = mysqli_fetch_assoc($result)) {
               $sr_no += 1;
               echo "
                    <tr>
                    <th scope='row'>" . $sr_no . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['time'] . "</td>
                    <td>" . '<button class="edit btn btn-primary" id=' . $row["sr_no"] . '>Edit</button> <button class="delete btn btn-primary" id=d' . $row["sr_no"] . '>Delete</button>' . "</td>
                    </tr>
                    ";
            }
            ?>
         </tbody>
      </table>
   </div>

   <!-- Edit Modal Script -->
   <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
         element.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            desc = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, desc);
            titleEdit.value = title;
            descEdit.value = desc;
            sr_noEdit.value = e.target.id;

            $('#EditModal').modal('toggle');
         })
      })
   </script>

   <!-- Delete Script -->
   <script>
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
         element.addEventListener("click", (e) => {
            sr_no = e.target.id.substr(1, );

            if (confirm("Are you sure you want to delete the note!")) {
               console.log('yes');
               window.location = `user_page.php?delete=${sr_no}`;
            } else {
               console.log('no');
            }
         })
      })
   </script>F

   <!-- jQuery first, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <!-- jquery -->
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

   <!-- datatables js -->
   <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

   <!-- datatables -->
   <script>
      let table = new DataTable('#myTable');
   </script>

</body>

</html>
<?php include 'footer.php' ?>