<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Totaltickets Test</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if (is_null($user)) {?>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>

      </li>
       <li class="nav-item">

        <a class="nav-link" href="login.php">Login</a>

      </li>
     <?php } else {?>
     	</li>
      	 <li class="nav-item">

        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        	<a class="dropdown-item" href="post.php">Post</a>
          <a class="dropdown-item" href="post.php?method=create">Create Post</a>

      </li>
      	 <li class="nav-item">

        <a class="nav-link" href="logout.php">Logout</a>
      </li>

  <?php }?>

    </ul>

  </div>
</nav>
