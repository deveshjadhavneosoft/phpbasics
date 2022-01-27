<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand text-white font-weight-bold" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link active text-white font-weight-bold" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-link text-white font-weight-bold" href="?con=changepass">Change Password</a>
      <a class="nav-link text-white font-weight-bold" href="#">Welcome:<?php echo $sid; ?> </a>
      <a class="nav-link text-white font-weight-bold" href="logout.php">Logout </a>
    </div>
  </div>
</nav>