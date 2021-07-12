<?php session_start() ?>
<?php require "includes/config.php"?>
<?php require "includes/header.php"?>
<?php require "includes/navbar.php"?>

<?php 

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


     // Get action 
    $action='';
    if(isset($_GET['action'])) {
        $action=$_GET['action'];
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

    <?php
        $limit=04;
        $offset=($page-1)*$limit;
        $stmt=$con->prepare("SELECT * FROM categories");
        $stmt->execute();
        $count=$stmt->rowCount();
        $totalPages= intval(ceil($count/$limit));
        $stmt=$con->prepare("SELECT * FROM categories LIMIT $offset,$limit");
        $stmt->execute();
        $categories=$stmt->fetchAll();

        // echo '<pre>';
        // print_r($categories);
        // echo '</pre>';
    ?>

    <!-- All Data -->

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
        <a href="?action=create" class="btn btn-info text-white">Add Post</a>
        <!-- search input -->
        <form method="POST" action="?action=search"  class="mb-3 mt-5  d-flex">
            <div class="form-group search-container">
                <input type="search" class="from-search" name="product_search" placeholder="Search For Category">
                <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </form>
    </div>

    <!-- <div class="filtered-data bg-white border-1">
        <a href="?action=search" class="border-bottom">filtered 1 </a>
        <a href="?action=search" class="border-bottom">filtered 1 </a>
        <a href="?action=search" class="border-bottom">filtered 1 </a>
        
    </div> -->

    <table class="table text-center">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $cat):?>
            <tr>
            <td><?= $cat['category_id']?></td>
            <td><?= $cat['category_name']?></td>
            <td>
                <a href="?action=edit&selection=<?= $cat['category_id']?>" class="btn btn-primary">Edit</a>
                <button class="btn btn-danger delete-btn" onclick="Popup(<?= $cat['category_id']?>)">Delete</button>
            </td>
            </tr>
            <?php endforeach?>
            
            
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

    <div class="pagination">
        <?php for($i=1;$i<=$totalPages;$i++):?>
            
            <?php if($i==$page):?>
                <a href="categories.php?page=<?= $i ?>" class="btn pagination_link active"><?= $i ?></a>
            <?php else:?>
                <a href="categories.php?page=<?= $i ?>" class="btn pagination_link"><?= $i ?></a>
            <?php endif?>
        <?php endfor?>
    </div>

<?php elseif($action=='create'):?>

    <div class="container">
        <h1 class="mt-5 mb-5 text-center ">Add Category</h1>

        <form method="POST" action="?action=store">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Category Name">
                <label for="floatingInput">Category Name</label>
            </div>
            
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>


<?php elseif($action=='store'): ?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cat_name=$_POST['name'];
            $errors=[];
            if(strlen($cat_name)<3){
                $errors[]='<div class="alert alert-danger">Category Name Must Be More Than 3 Characters</div>';
            }
            if(empty($errors)){
                $stmt=$con->prepare('INSERT INTO categories (category_name) VALUES(?)');
                $stmt->execute(array($cat_name));
                header('location:categories.php');
    
            }else{
                foreach($errors as $error){
                    echo $error;
                }
            }
        }
        
    ?>

<?php elseif($action=='edit'): ?>
    
    <?php
        $cat_id=isset($_GET['selection'])&& is_numeric($_GET['selection'])? $_GET['selection']: 0 ;
        $stmt=$con->prepare('SELECT * FROM categories WHERE category_id=?');
        $stmt->execute(array($cat_id));
        $cat=$stmt->fetch();
        $count=$stmt->rowCount();
    ?>
    <?php if($count>0):?>
        <div class="container">
            <h1 class="mt-5 mb-5 text-center ">Edit Category</h1>

            <form method="POST" action="?action=update">
                <input type="hidden" name="id" value="<?= $cat['category_id']?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="name" value="<?=$cat['category_name']?>">
                    <label for="floatingInput">Category Name</label>
                </div>
                
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>

    <?php
     else:
        header('location:categories.php');    
    endif
    ?>
    



<?php elseif($action=='update'): ?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cat_id=$_POST['id'];
            $cat_name=$_POST['name'];
            $errors=[];
            if(strlen($cat_name)<3){
                $errors[]='<div class="alert alert-danger">Category Name Must Be More Than 3 Characters</div>';
            }
            if(empty($errors)){
                $stmt=$con->prepare('UPDATE categories SET category_name=? WHERE category_id=?');
                $stmt->execute(array($cat_name,$cat_id));
                header('location:categories.php');
            }else{
                foreach($errors as $error){
                    echo $error;
                }
            }
        }    
    ?>

<?php elseif($action=='delete'): ?>
    <?php
        $id=isset($_GET['selection'])&&is_numeric($_GET['selection'])?$_GET['selection']:0;
        $stmt=$con->prepare('DELETE FROM categories WHERE category_id=?');
        $stmt->execute(array($id));
        header('location:categories.php');
    ?>


<?php elseif($action=='search'): ?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $search_txt=$_POST['product_search'];
            $stmt=$con->prepare("SELECT * FROM categories WHERE category_id LIKE '%$search_txt%' OR category_name LIKE '%$search_txt%'");
            $stmt->execute();
            $cats=$stmt->fetchAll();
            $count=$stmt->rowCount();

        }   
        if($count>0):
    ?>

    <table class="table text-center">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($cats as $cat):?>
            <tr>
            <td><?= $cat['category_id']?></td>
            <td><?= $cat['category_name']?></td>
            <td>
                <a href="?action=edit&selection=<?= $cat['category_id']?>" class="btn btn-primary">Edit</a>
                <button class="btn btn-danger delete-btn" onclick="Popup(<?= $cat['category_id']?>)">Delete</button>
            </td>
            </tr>
            <?php endforeach?>
            
            
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
        </tbody>
    </table>
    <?php else:?>
        <?php header('location:categories.php');?>
    <?php endif?>

<?php endif ?>

<?php include "includes/footer.php" ?>