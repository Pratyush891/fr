<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TravelLog</title>
  <link rel="icon" type="image/png" href="../Images/alps_favicon.png">
  <meta name="description" content="Connect with people over travelling">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../CSS/profile.css">
  <link rel="stylesheet" type="text/css" href="../CSS/post.css">
</head>

<body>
  <!-- nav -->
  <?php
  require_once "functions.php";
  include "header.php";
  // dbConnect();
  ?>

  <?php
  check_auth();
  dbConnect();

  $sql = "SELECT user_id, name, username, status, profile_img_url, location FROM users WHERE username = ?";
  $statement = $conn->prepare($sql);
  $statement->bind_param('s', $_GET['username']);
  $statement->execute();
  $statement->store_result();
  $statement->bind_result($id, $name, $username, $status, $profile_image_url, $location);
  $statement->fetch();
  ?>>

  <!-- main -->
  <main class="container">
    <div class="row">
      <div class="col-md-3">
        <!-- edit profile -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>Edit profile</h4>
            <form method="post" action="edit-profile.php">
              <div class="form-group">
                <input class="form-control" type="text" name="status" placeholder="Status" value="">
              </div>

              <div class="form-group">
                <input class="form-control" type="text" name="location" placeholder="Location" value="">
              </div>

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_profile" value="Save">
              </div>
            </form>
          </div>
        </div>
        <!-- ./edit profile -->
      </div>
      <div class="col-md-6">
        <!-- user profile -->
        <div class="media">
          <div class="media-left">
            <img src="../Images/Background/pexels-dominika-roseclay-1252500.jpg" class="media-object" style="width: 128px; height: 128px;">
          </div>
          <div class="media-body">
            <h2 class="media-heading"><?php echo $name ?></h2>
            <h4><?php echo "@$username" ?></h4>
            <p>Status: <?php echo $status ?><br>Location: <?php echo $location ?></p>
          </div>
        </div>
        <!-- user profile -->

        <hr>

        <!-- timeline -->
        <!-- feed -->
        <div class="scrollable">
          <!-- post -->
          <?php
          $user_posts_sql = "SELECT * FROM posts WHERE user_id = {$id} ORDER BY created_at DESC";
          require "post.php";
          displayPosts($user_posts_sql, $conn);
          ?>
        </div>
        <!-- ./feed -->
      </div>
      <!-- ./timeline -->
      <div class="col-md-3">
        <!-- friends -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>Friends</h4>
            <!-- <ul>
              <li>
                <a class="user" href="#">peterpan</a>
                <a class="text-danger" href="#">[unfriend]</a>
              </li>
            </ul> -->
            <div class="friend-box">
              <div class="friend-profile" style="background-image: url(&quot;https://images.pexels.com/photos/3328072/pexels-photo-3328072.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500&quot;);"></div>
              <div class="name-box">
                Awa L
              </div>
              <div class="user-name-box">
                @awaaa sent you a friend request.
              </div>
              <div class="request-btn-row" data-username="purplekoala395">
                <!-- <button class="friend-request accept-request" data-username="purplekoala395">Accept</button> -->
                <button class="friend-request decline-request" data-username="purplekoala395">Unfriend</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ./friends -->
      </div>
    </div>
  </main>
  <!-- ./main -->

  <!-- footer -->
  <?php
  include "footer.php";
  ?>
  <!-- ./footer -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>