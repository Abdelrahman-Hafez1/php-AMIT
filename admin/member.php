

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


<?php

/*
    CRUD pages

    ===================
    *Create
        **template to fill
        **store data to database

    *Read(fetch)
        -Read All Users
        -read one only

    *Update
        -template show edit (form)
        -update data to database

    *Delete
        -code to delete

*/      

$action='';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action='index';
}
// get pagenation
$page='';
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
?>

<?php if($action=='index'):?>

<!-- select all members -->
    <?php

        $check=isset($_GET['check'])?'role!=0':'role=0';
        $limit=04;
        $offset=($page-1)*$limit;
        $stmt=$con->prepare('SELECT * FROM users ');
        $stmt->execute();
        $count=$stmt->rowCount();
        $totalPages= intval(ceil($count/$limit));

        $stmt=$con->prepare("SELECT * FROM users LIMIT $offset,$limit");
        $stmt->execute();
        $users=$stmt->fetchAll();
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';
        
    ?>

    <div class="delete">
        <div class="overlay ">
            <div class="delete-message">
                <i class="fas fa-exclamation text-warning"></i>
                <p>Are You Sure You Want To Delete this user</p>
                <div class="btns">
                    <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                    <a href="#" class="btn btn-success undo-deletion">Undo</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-around align-items-center">
        <!-- add new  User -->
        <a href="?action=create" class="btn btn-info text-white">Add User</a>
        <!-- search input -->
        <form method="POST" action="?action=search"  class="mb-3 mt-5  d-flex">
            <div class="form-group search-container">
                <input type="search" class="from-search" name="product_search" placeholder="Search For Category">
                <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </form>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">image</th>
                <th scope="col">Date</th>
                <th scope="col">Control</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=0;
         foreach($users as $user):
        ?>
            <tr>
                <th scope="row"><?= ++$i?></th>
                <td><?= $user['username'] ?></td>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><img src="assests/imgs/<?=$user['image']?>" style="width:100px" alt="avatar"></td>
                <td><?= $user['date'] ?></td>
                <td>
                    <a href="?action=show&&selection=<?= $user['id']?>" class="btn btn-info">Show</a>
                    <?php if($_SESSION['ROLE']==1):?>
                    <a href="?action=edit&selection=<?= $user['id']?>" class="btn btn-warning">Edit</a>
                    
                    <button class="btn btn-danger delete-btn" onclick="Popup (<?=$user['id']?>)">Delete</button>
                    <?php endif?>
                </td>
            </tr>
        <?php endforeach ?>
        <?php
            // $userId=isset($_GET['selection'])?$_GET['selection']:0;
            ?>        

        </tbody>
    </table>
    <div class="pagination">
        <?php for($i=1;$i<=$totalPages;$i++):?>
            
            <?php if($i==$page):?>
                <a href="member.php?page=<?= $i ?>" class="btn pagination_link active"><?= $i ?></a>
            <?php else:?>
                <a href="member.php?page=<?= $i ?>" class="btn pagination_link"><?= $i ?></a>
            <?php endif?>
        <?php endfor?>
    </div>

    <script>
        const delete_warning=document.querySelector('.delete');
        const delete_overlay=document.querySelector('.delete .overlay');
        const delete_message=document.querySelector('.delete .overlay .delete-message');
        const delete_confirmation=document.querySelector('.delete .btns .confirm-deletion');
        const undo_deletion=document.querySelector('.delete .btns .undo-deletion');
        
        function Popup (id){
            delete_warning.classList.add('active');
            delete_overlay.classList.add('active');
            delete_message.classList.add('active');
            delete_confirmation.setAttribute('href',`?action=delete&selection=${id}`);
        }
        undo_deletion.addEventListener('click',function(e){
            e.preventDefault();
            delete_warning.classList.remove('active');
        });
        delete_confirmation.addEventListener('click',function(e){
            
            delete_warning.classList.remove('active');
        });
    </script>

<?php elseif($action=='create'):?>
    <!-- Add User -->
    <div class="add-user mt-5">
        <div class="container">
        <form method="POST" action="?action=store" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Image</label>
                <input type="file" class="form-control" id="full_name" name="avatar" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        </div>
    </div>


<?php elseif($action=='store'):?>
    <?php 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // all data about uploaded file
            $avatar=$_FILES['avatar'];
            
            // echo'<pre>';
            // print_r($avatar);
            // echo'</pre>';
            $avatar_name=$avatar['name'];
            $avatar_type=$avatar['type'];
            $avatar_tmp_name=$avatar['tmp_name'];
            $avatar_error=$avatar['error'];
            $avatar_size=$avatar['size'];
            $avatarAllowedExtensions=array('image/jpg','image/jpeg','image/png');
            if(in_array($avatar_type,$avatarAllowedExtensions)){
                $rand_name=rand(1,10000).$avatar_name;
                $destination="assests/imgs/";
                move_uploaded_file($avatar_tmp_name,$destination.$rand_name);
            }
            

            $username= $_POST['username'];
            $email= $_POST['email'];
            $password= sha1($_POST['password']);
            $full_name= $_POST['full_name'];

            // start form validation
            $formErrors=array();
            if(empty($username) || strlen($username) < 4){
                $formErrors[]='User Name Must Be At Least 4 Characters';
            }
            if(empty($email)){
                $formErrors[]='Email Must Be Inserted';
            }
            if(empty($full_name)){
                $formErrors[]='Full Name Must Be Inserted';
            }
            if(empty($password)){
                $formErrors[]='password Name Must Be Inserted';
            }
            
            // form free of error
            if(empty($formErrors)){
                $stmt=$con->prepare('INSERT INTO users (username,password,email,fullname,image,role) VALUES( ? , ? , ? , ? ,?, 0)');
                $stmt->execute(array($username,$password,$email,$full_name,$rand_name));
                header('location:member.php?action=index');
            }else{
                // display error messages
                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
        }    
    ?>
<?php elseif($action=='edit'):?>
    <?php 
        // $userId=$_GET['selection'];
        $userId=isset($_GET['selection'])&&is_numeric($_GET['selection'])?intval($_GET['selection']):0;
        $stmt=$con->prepare('SELECT * FROM users WHERE id=?');
        $stmt->execute(array($userId));
        $user=$stmt->fetch();
        $userCount=$stmt->rowCount();
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';

    ?>
    <?php if($userCount > 0): ?>
    
    <div class="container">
        <h1 class="text-center">Edit User</h1>
        <form method="POST" action="?action=update" enctype="multipart/form-data">
            <input type="hidden" name="ID" value="<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']?>" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= $user['email']?>" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="newpassword">
                <input type="hidden" class="form-control" id="exampleInputPassword1" name="oldpassword" value="<?= $user['password']?>">
            </div>
            

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $user['fullname']?>" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Image</label>
                <input type="file" class="form-control" id="full_name" name="avatar" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <?php else: ?>
        <?php header('location:member.php')?>
    <?php endif ?>

<?php elseif($action=='update'):?>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $avatar=$_FILES['avatar'];
            $avatar_name=$avatar['name'];
            $avatar_type=$avatar['type'];
            $avatar_tmp_name=$avatar['tmp_name'];
            $avatar_size=$avatar['size'];
            $avatarAllowedExtensions=array('image/jpg','image/jpeg','image/png');
            if(in_array($avatar_type,$avatarAllowedExtensions)){

                $rand_name=rand(1,10000).$avatar_name;
                $destination='assests/imgs/'.$rand_name;
                move_uploaded_file($avatar_tmp_name,$destination);
            }

            $userId=$_POST['ID'];
            $username= $_POST['username'];
            $email= $_POST['email'];
            $fullName= $_POST['full_name'];
            $password=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);     
            // if(empty($_POST['newpassword'])){
            //     echo $_POST['oldpassword'];
            // }else{
            //     echo sha1($_POST['newpassword']);
            // }
            $stmt=$con->prepare('UPDATE users SET username = ? , password =? , email = ? , fullname = ? , image = ?  WHERE id = ?');
            $stmt->execute(array($username,$password,$email,$fullName,$rand_name,$userId));
            header('location:member.php');
        }    
    ?>
<?php elseif($action=='show'):?>

    <?php 
        $userId=isset($_GET['selection'])&&is_numeric($_GET['selection'])?intval($_GET['selection']):0;
        $stmt=$con->prepare('SELECT * FROM users WHERE id=?');
        $stmt->execute(array($userId));
        $user=$stmt->fetch();
        $userCount=$stmt->rowCount();
        
    ?>
    <?php if($userCount>0):?>
        <?php if($user['id']==$_SESSION['ID']):?>

            <div class="container">
                <h1 class="text-center"><?=$_SESSION['USER_NAME']?> Profile</h1>
                <form method="" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $_SESSION['USER_NAME']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= $_SESSION['EMAIL']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $_SESSION['FULL_NAME']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    
                    <a href="member.php" class="btn btn-dark">Back</a>
                </form>
            </div>


        <?php else:?>
            <div class="container">
                <h1 class="text-center">Show User</h1>
                <form method="" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= $user['email']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $user['fullname']?>" readonly aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    
                    <a href="member.php" class="btn btn-dark">Back</a>
                </form>
            </div>

        <?php endif?>

    <?php else:?>
        <?php header('location:member.php')?>
    <?php endif?>
<?php elseif($action=='profile'):?>

    


<?php elseif($action=='delete'):?>
    
    <?php
        $userId=isset($_GET['selection'])&&is_numeric($_GET['selection'])?$_GET['selection']:0;
        $stmt=$con->prepare('DELETE FROM users WHERE id=?');
        $stmt->execute(array($userId));
        header('location:member.php');
    ?>

<?php elseif($action=='search'):?>

    <?php
        if(isset($_SERVER['REQUEST_METHOD'])=='POST'){
            $searchTxt=$_POST['product_search'];
            $check=isset($_GET['check'])?'role!=0':'role=0';
            $stmt=$con->prepare("SELECT * FROM users WHERE id LIKE '%$searchTxt%' OR username LIKE '%$searchTxt%' OR fullname LIKE '%$searchTxt%'");
            $stmt->execute();
            $users=$stmt->fetchAll();
    ?>
    <div class="delete">
        <div class="overlay ">
            <div class="delete-message">
                <i class="fas fa-exclamation text-warning"></i>
                <p>Are You Sure You Want To Delete this user</p>
                <div class="btns">
                    <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                    <a href="#" class="btn btn-success undo-deletion">Undo</a>
                </div>
            </div>
        </div>
    </div>

        <!-- search input -->
    <form method="POST" action="?action=search"  class="mb-3 mt-5">
        <div class="form-group search-container ">
            <input type="search" class="from-search" name="product_search" placeholder="Search For Category">
        </div>
        <button type="submit" class="btn btn-outline-dark">Submit</button>
    </form>

     <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">image</th>
                <th scope="col">Date</th>
                <th scope="col">Control</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=0;
         foreach($users as $user):
        ?>
            <tr>
                <th scope="row"><?= ++$i?></th>
                <td><?= $user['username'] ?></td>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><img src="assests/imgs/<?=$user['image']?>" style="width:100px" alt="avatar"></td>
                <td><?= $user['date'] ?></td>
                <td>
                    <a href="?action=show&&selection=<?= $user['id']?>" class="btn btn-info">Show</a>
                    <?php if($_SESSION['ROLE']==1):?>
                    <a href="?action=edit&selection=<?= $user['id']?>" class="btn btn-warning">Edit</a>
                    
                    <button class="btn btn-danger delete-btn" onclick="Popup (<?=$user['id']?>)">Delete</button>
                    <?php endif?>
                </td>
            </tr>
        <?php endforeach ?>
        <?php
            // $userId=isset($_GET['selection'])?$_GET['selection']:0;
            ?>        

        </tbody>
    </table>
    <script>
        const delete_warning=document.querySelector('.delete');
        const delete_overlay=document.querySelector('.delete .overlay');
        const delete_message=document.querySelector('.delete .overlay .delete-message');
        const delete_confirmation=document.querySelector('.delete .btns .confirm-deletion');
        const undo_deletion=document.querySelector('.delete .btns .undo-deletion');
        
        function Popup (id){
            delete_warning.classList.add('active');
            delete_overlay.classList.add('active');
            delete_message.classList.add('active');
            delete_confirmation.setAttribute('href',`?action=delete&selection=${id}`);
        }
        undo_deletion.addEventListener('click',function(e){
            e.preventDefault();
            delete_warning.classList.remove('active');
        });
        delete_confirmation.addEventListener('click',function(e){
            
            delete_warning.classList.remove('active');
        });
    </script>

    <?php
        }else{
            echo '<h1 class="text-info text-center">You Can\'t Reach This Page Directly</h1>';
        }
    ?>


<?php else:?>
    <p>404 Not Found</p>;
<?php endif?>



<?php include "includes/footer.php"?>