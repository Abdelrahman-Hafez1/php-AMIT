<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">PHP48</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">DashBoard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member.php">Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="posts.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <?php if($_SESSION['ROLE']==1):?>
          <li class="nav-item">
            <a class="nav-link" href="categories.php">Categories</a>
          </li>
        <?php endif?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $_SESSION['FULL_NAME']?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="member.php?action=show&selection=<?=$_SESSION['ID']?>">Profile</a>
            <a class="dropdown-item" href="member.php?check=admins">ِAdmin & Moderators</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../index.php">ِVisit Site</a>
            <div class="dropdown-divider"></div>
            <?php if($_SESSION['LANG']=='en'):?>
              <a class="dropdown-item" href="?lang=ar">ِاللغه العربيه</a>
            <?php else:?>
              <a class="dropdown-item" href="?lang=en">English</a>
            <?php endif?>
            <a class="dropdown-item" href="logout.php">logout</a>
          </div>
        </li>
        
      </ul>
    </div>
  
    
  </div>
</nav>