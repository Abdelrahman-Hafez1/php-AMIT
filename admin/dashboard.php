<?php
    session_start();

    if(isset($_GET['lang'])){
        $_SESSION['LANG']=$_GET['lang'];
    }
    if($_SESSION['LANG']=='en'){
        include 'lang/en.php';
    }elseif($_SESSION['LANG']=='ar'){
        include 'lang/ar.php';
    }else{
        include 'lang/en.php';
    }

    include "includes/config.php";
?>
<?php include "includes/header.php" ?>


<?php include "includes/navbar.php"?>

    <h1 class="text-center mt-5"><?= $lang['dashboard']?></h1>
    <div class="container mt-5">
        <div class="rates">
            <div class="row">
                <div class="col-md-4">
                    <a href="member.php" class="content">
                        <i class="fas fa-users"></i>
                        <?php
                            $stmt=$con->prepare('SELECT COUNT(id) FROM users WHERE role=0');
                            $stmt->execute();
                            $count=$stmt->fetchColumn();
                        ?>
                        <p>members</p>
                        <p><?=$count?></p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="posts.php" class="content">
                        <i class="fas fa-users"></i>
                        <?php
                            $stmt=$con->prepare('SELECT COUNT(id) FROM posts');
                            $stmt->execute();
                            $count=$stmt->fetchColumn();
                        ?>
                        <p>posts</p>
                        <p><?=$count?></p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="member.php" class="content">
                        <i class="fas fa-users"></i>
                        <?php
                            $stmt=$con->prepare('SELECT COUNT(id) FROM users WHERE role=0');
                            $stmt->execute();
                            $count=$stmt->fetchColumn();
                        ?>
                        <p>members</p>
                        <p><?=$count?></p>
                    </a>
                </div>
                
            </div>
        </div>
    </div>


<?php include "includes/footer.php"?>