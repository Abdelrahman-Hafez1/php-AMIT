
<?php
    session_start();
    include "includes/config.php";
?>
<?php include "includes/header.php" ?>

<?php include "includes/navbar.php"?>


<?php

    $post_action='';
    if(isset($_GET['post_action'])){
        $post_action=$_GET['post_action'];
    }else{
        $post_action='index';
    }

    
    // get pagenation
    $page='';
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
?>



<?php if($post_action=='index'): ?>

    <?php
        $limit=04;
        $offset=($page-1)*$limit;
        $stmt=$con->prepare('SELECT * FROM posts');
        $stmt->execute();
        $count=$stmt->rowCount();
        $totalPages= intval(ceil($count/$limit));

        $stmt=$con->prepare("SELECT * FROM posts LIMIT $offset,$limit");
        $stmt->execute();
        $posts=$stmt->fetchAll();
        // echo '<pre>';
        // print_r($posts);
        // echo '</pre>';
    ?>

    <div class="delete">
        <div class="overlay">
            <div class="delete-message">
                <i class="fas fa-exclamation text-warning"></i>
                <p>Are You Sure You Want To Delete this Category</p>
                <div class="btns">
                    <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                    <a href="#" class="btn btn-success undo-deletion">Undo</a>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-around align-items-center">
        <!-- add new category -->
        <a href="?post_action=create" class="btn btn-info text-white">Add Post</a>
        <!-- search input -->
        <form method="POST" action="?post_action=search"  class="mb-3 mt-5  d-flex">
            <div class="form-group search-container">
                <input type="search" class="from-search" name="product_search" placeholder="Search For Category">
                <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">Date</th>
                <th scope="col">Control</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
                <tr>

                    <td><?=$post['id']?></td>
                    <td><?=$post['title']?></td>
                    <td><?=$post['description']?></td>
                    <td><?=$post['date']?></td>
                    <td>
                        <a href="?post_action=edit&selection=<?=$post['id']?>" class="btn btn-warning" >Edit</a>
                        <a href="?post_action=show&selection=<?=$post['id']?>" class="btn btn-info">Show</a>
                        <button class="btn btn-danger delete-btn" onclick="Popup(<?= $post['id']?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php for($i=1;$i<=$totalPages;$i++):?>
            
            <?php if($i==$page):?>
                <a href="posts.php?page=<?= $i ?>" class="btn pagination_link active"><?= $i ?></a>
            <?php else:?>
                <a href="posts.php?page=<?= $i ?>" class="btn pagination_link"><?= $i ?></a>
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
            delete_confirmation.setAttribute('href',`?post_action=delete&selection=${id}`);
        }
        undo_deletion.addEventListener('click',function(e){
            e.preventDefault();
            delete_warning.classList.remove('active');
        });
        delete_confirmation.addEventListener('click',function(e){
            
            delete_warning.classList.remove('active');
        });
    </script>

<?php elseif($post_action=='create'): ?>
<!-- create post section -->
    <div class="add_post mt-5">
        <div class="container">
            <form method="POST" action="?post_action=store">

                <div class="mb-3">
                    <label for="title" class="form-label" >Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" autocomplete="off" >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Post Content</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
<?php elseif($post_action=='store'): ?>
<!-- storing data  -->
    <?php 
    // get data from post method in variables
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $postTitle=$_POST['title'];
            $postDescription=$_POST['description'];
            $username=$_SESSION['FULL_NAME'];
            // prepare my database
            $stmt=$con->prepare('INSERT INTO posts (title,description,username) VALUES(?,?,?)');
            // put values in database
            $stmt->execute(array($postTitle,$postDescription,$username));
            // then go to create again
            header('location:posts.php?post_action=index');
        }
    ?>

<?php elseif($post_action=='edit'): ?>
    
    <?php
        // $postId=$_GET['selection'];
        $postId=isset($_GET['selection'])&& is_numeric($_GET['selection'])?intval($_GET['selection']):0;
        $stmt=$con->prepare('SELECT * FROM posts WHERE id=?');
        $stmt->execute(array($postId));
        $post=$stmt->fetch();
        $postCount=$stmt->rowCount();
        
    ?>
    <!-- editing -->
    <?php if($postCount>0): ?>
    
    <div class="add_post mt-5">
        <div class="container">
            <form method="POST" action="?post_action=update">
                <input type="hidden" name="ID" value="<?= $postId?>">
                <div class="mb-3">
                    <label for="title" class="form-label" >Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" autocomplete="off" value="<?=$post['title']?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Post Content</label>
                    <textarea class="form-control" id="description" name="description"><?=$post['description']?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>

    <?php else: ?>
        <?php header('location:posts.php') ?>
    <?php endif ?>

<?php elseif($post_action=='update'): ?>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $postId=$_POST['ID'];
            $postTitle=$_POST['title'];
            $postDescription=$_POST['description'];
            $formErrors=array();
            if(strlen($postTitle)<4){
                $formErrors[]='Title Must Be At Least 4 Characters';
            }
            if(strlen($postDescription)<4){
                $formErrors[]='Description Must Be At Least 4 Characters';
            }

            if(empty($formErrors)){
                $stmt=$con->prepare('UPDATE posts SET title=? , description=? WHERE id=?');
                $stmt->execute(array($postTitle,$postDescription,$postId));
                header('location:posts.php');
            }else{
                foreach ($formErrors as $error){
                    echo '<div class="alert alert-danger">'. $error .'</div>';
                }
            }
        }
    ?>
<?php elseif($post_action=='show'):?>
    <?php
        $postId=isset($_GET['selection'])&&is_numeric($_GET['selection'])? $_GET['selection']: 0;
        $stmt=$con->prepare('SELECT * FROM posts WHERE id=?');
        $stmt->execute(array($postId));
        $post=$stmt->fetch();
        $postCount=$stmt->rowCount();

    ?>

    
    <?php if($postCount>0):?>
        <div class="add_post mt-5">
            <div class="container">
                <form method="" action="">

                    <div class="mb-3">
                        <label for="title" class="form-label" >Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?=$post['title']?>" readonly autocomplete="off" >
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Post Content</label>
                        <textarea class="form-control" id="description" readonly name="description"><?=$post['description']?></textarea>
                    </div>
                    
                    <a href="posts.php" class="btn btn-dark">Back</a>

                </form>
            </div>
        </div>

    <?php else:?>
        <?php header('location:posts.php')?>
    <?php endif?>

<?php elseif($post_action=='delete'): ?>
    <?php
        $id=isset($_GET['selection'])&&is_numeric($_GET['selection'])?$_GET['selection']:0;
        $stmt=$con->prepare('DELETE FROM posts WHERE id=?');
        $stmt->execute(array($id));
        header('location:posts.php');
    ?>



<?php elseif($post_action=='search'): ?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $search_txt=$_POST['product_search'];
            $stmt=$con->prepare("SELECT * FROM posts WHERE id LIKE '%$search_txt%' OR title LIKE '%$search_txt%' OR description LIKE '%$search_txt%'");
            $stmt->execute();
            $cats=$stmt->fetchAll();
            $count=$stmt->rowCount();

        }   
        if($count>0):
            
    ?>
        <div class="delete">
            <div class="overlay">
                <div class="delete-message">
                    <i class="fas fa-exclamation text-warning"></i>
                    <p>Are You Sure You Want To Delete this Category</p>
                    <div class="btns">
                        <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                        <a href="#" class="btn btn-success undo-deletion">Undo</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-around align-items-center">
            <!-- add new category -->
            <a href="?post_action=create" class="btn btn-info text-white">Add Category</a>
            <!-- search input -->
            <form method="POST" action="?post_action=search"  class="mb-3 mt-5  d-flex">
                <div class="form-group search-container">
                    <input type="search" class="from-search" name="product_search" placeholder="Search For Category">
                    <button type="submit" class="btn btn-outline-dark">Submit</button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($posts as $post): ?>
                    <tr>

                        <td><?=$post['id']?></td>
                        <td><?=$post['title']?></td>
                        <td><?=$post['description']?></td>
                        <td><?=$post['date']?></td>
                        <td>
                            <a href="?post_action=edit&selection=<?=$post['id']?>" class="btn btn-warning" >Edit</a>
                            <a href="?post_action=show&selection=<?=$post['id']?>" class="btn btn-info">Show</a>
                            <button class="btn btn-danger delete-btn" onclick="Popup(<?= $post['id']?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
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
                delete_confirmation.setAttribute('href',`?post_action=delete&selection=${id}`);
            }
            undo_deletion.addEventListener('click',function(e){
                e.preventDefault();
                delete_warning.classList.remove('active');
            });
            delete_confirmation.addEventListener('click',function(e){
                
                delete_warning.classList.remove('active');
            });
        </script>

    <?php else:?>
        <?php echo 'ooooh';?>
    <?php endif?>



<?php else: ?>
<p>404 NOT FOUND</p>
<?php endif?>


<?php include "includes/footer.php"?>