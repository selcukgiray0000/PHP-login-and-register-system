<?php
require_once "files/config.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Selçuk Giray</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>

  <div class="form-inline">
<?php
if(isset($_SESSION["email"]))
{
  ?>
<a class="nav-link" href="logout.php">Logout</a>
  <?php
}
else
{
  ?>
  <a class="nav-link" href="account.php">Login & Register</a>
  <?php
}
?>

    
  </div>
</nav>