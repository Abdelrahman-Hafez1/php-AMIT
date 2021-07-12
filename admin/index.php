<?php session_start();?>

<?php 
    $_SESSION['LANG']=isset($_GET['lang'])?$_GET['lang']:'en';

    if($_SESSION['LANG']=='en'){
        include 'lang/en.php';
    }elseif($_SESSION['LANG']=='ar'){
        include 'lang/ar.php';
    }else{
        include 'lang/en.php';
    }
    if(isset( $_SESSION['USER_NAME'] ) && $_SESSION['ROLE'] > 0 ){
        header('location:dashboard.php');
    }
    
?>

<?php require "includes/config.php" ?>

<?php include "includes/header.php"?>

<?php
    // echo $_SERVER['REQUEST_METHOD'];
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $adminUserName= $_POST['AdminUsername'];
        $adminPassword= $_POST['AdminPassword'];
        $hashPass= sha1($adminPassword);
        
        // $stmt=$con->prepare('SELECT * FROM users WHERE username=? AND password=? AND role=1');
        // $stmt->execute(array($adminUserName,$adminPassword));
        // $row=$stmt->fetch()

        $stmt = $con->prepare('SELECT * FROM users WHERE username=? AND password=? AND role!=0');
        $stmt ->execute(array($adminUserName , $hashPass));
        $row =$stmt->fetch();
        // echo '<pre>';
        // print_r($row).'hii';
        // echo '</pre>';

        // in database or not  # 1 Or 0 
        $count = $stmt ->rowCount();
        if($count ==1){
            // echo "done";
            $_SESSION['ID']=$row['id'];
            $_SESSION['USER_NAME']=$adminUserName;
            $_SESSION['EMAIL']=$row['email'];
            $_SESSION['ROLE']=$row['role'];
            $_SESSION['FULL_NAME']=$row['fullname'];
            header('location:dashboard.php');
        }else{
            echo'<div class="alert alert-danger" role="alert">
                    Your Email Or Password is not Correct
                </div>';
        }
    }
?>


    <div class="container">
        <h1 class="text-center"><?=$lang['admin_login']?></h1>

        <section class="lang-choice mb-4 mx-5 text-end">
            <a href="?lang=ar">اللغه العربيه</a>
            <a href="?lang=en">English</a>
        </section>
        <div class="row justify-content-center">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" style="width: 80%;">
    
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="AdminUsername" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput"><?=$lang['username']?></label>
                </div>
    
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="AdminPassword" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword"><?=$lang['password']?></label>
                </div>
    
                <button type="submit" class="btn btn-primary"><?=$lang['login']?></button>
    
            </form>

        </div>
        
    </div>
    
<?php include "includes/footer.php"?>
