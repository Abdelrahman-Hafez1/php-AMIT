<?php session_start() ?>


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
?>

<?php require "includes/config.php"?>
<?php require "includes/header.php"?>
<?php require "includes/navbar.php"?>

<?php
    // action
    $action='';
    if(isset($_GET['action'])){
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
        $stmt_1=$con->prepare("
                                SELECT products.* , categories.* FROM products
                                INNER JOIN categories ON categories.category_id = products.product_category
                            ");
        $stmt_1->execute();
        $count=$stmt_1->rowCount();
        $stmt=$con->prepare("
                                SELECT products.* , categories.* FROM products
                                INNER JOIN categories ON categories.category_id = products.product_category
                                LIMIT $offset,$limit
                            ");
        $stmt->execute();
        $products=$stmt->fetchAll();
        $totalPages= intval(ceil($count/$limit));

        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';
    ?>

            <div class="delete">
                <div class="overlay">
                    <div class="delete-message">
                        <i class="fas fa-exclamation text-warning"></i>
                        <p>Are You Sure You Want To Delete this Product</p>
                        <div class="btns">
                            <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                            <a href="#" class="btn btn-success undo-deletion">Undo</a>
                        </div>
                    </div>
                </div>
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

    <!-- search input -->
    <div class="d-flex justify-content-around align-items-center">
        <!-- add new Product -->
        <a href="?action=create" class="btn btn-info text-white">Add Product</a>
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

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Sale</th>
            <th scope="col">Image</th>
            <th scope="col">username</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product):?>
            <tr>
            <td><?= $product['name']?></td>
            <td><?= $product['price']?></td>
            <td><?= $product['category_name']?></td>
            <td><?= $product['sale']?></td>
            <td><img src="assests/imgs/<?= $product['image']?>" alt="produce" style="width: 150px;"></td>
            <td><?= $product['username']?></td>
            <td><?= $product['date']?></td>
            <td>
                <a href="?action=edit&selection=<?= $product['id']?>" class="btn btn-primary">Edit</a>
                <button  class="btn btn-danger delete-btn" onclick="Popup (<?=$product['id']?>)">Delete</button>
            </td>
            </tr>
            <?php endforeach?>
            
            
        </tbody>
    </table>

    <div class="pagination">
        <?php for($i=1;$i<=$totalPages;$i++):?>
            
            <?php if($i==$page):?>
                <a href="products.php?page=<?= $i ?>" class="btn pagination_link active"><?= $i ?></a>
            <?php else:?>
                <a href="products.php?page=<?= $i ?>" class="btn pagination_link"><?= $i ?></a>
            <?php endif?>
        <?php endfor?>
    </div>

<?php elseif($action=='create'):?>

    <!-- category data -->
    <?php
        $stmt=$con->prepare('SELECT * FROM categories');
        $stmt->execute();
        $cats=$stmt->fetchAll();
    ?>
    <!-- adding product -->
    <div class="container mt-5">
        <h1 class="text-center mb-3">Add Product</h1>

        <form method="POST" action="?action=store" enctype="multipart/form-data">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Product Name">
                <label for="floatingInput">Product Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPassword" name="price" placeholder="Price">
                <label for="floatingPassword">Price</label>
            </div>
            <select class="form-select" aria-label="Default select example" name="cat" required>
                <option disabled selected > select Category</option>
                <?php foreach($cats as $cat):?>
                <option value="<?=$cat['category_id']?>"><?=$cat['category_name']?></option>
                <?php endforeach?>
            </select>
            
            <div class="mb-3">
                <img id="output" style="width: 300px;margin-bottom:10px;"/>

                <input class="form-control" type="file" name="image" id="formFile" onchange="loadFile(event)">

                <!-- image preview -->
                <script>
                var loadFile = function(event) {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                    }
                };
                </script>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>


<?php elseif($action=='store'):?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            $username=$_SESSION['USER_NAME'];
            $cat_id=$_POST['cat'];
            
            // image
            $image=$_FILES['image'];
            $image_name=$image['name'];
            $image_type=$image['type'];
            $image_tmp_name=$image['tmp_name'];
            $image_size=$image['size'];
            $allowedExtentions=array('image/jpg','image/jpeg','image/png');
            $Errors=array();
            if(in_array($image_type,$allowedExtentions)){
                $rand_name=rand(0,10000).$image_name;
                $destination='assests/imgs/'.$rand_name;
                move_uploaded_file($image_tmp_name,$destination);
            }else{
                $Errors[]='<div class="alert alert-danger" role="alert">This Type Of File Is Not Supported</div>';
            }
            if(strlen($pro_name)<3){
                $Errors[]='<div class="alert alert-danger" role="alert">Product Name Must be More Than 3 Characters</div>';
            }

            if(empty($Errors)){
                $stmt=$con->prepare('INSERT INTO products (name,price,product_category,image,username) VALUES(?,?,?,?,?)');
                $stmt->execute(array($pro_name,$pro_price,$cat_id,$rand_name,$username));
                header('location:products.php');
            }else{
                foreach($Errors as $error){
                    echo $error;
                }
            }
            

            
        }   
    ?>


<?php elseif($action=='edit'):?>

    <?php
        
        $productId=isset($_GET['selection'])&&is_numeric($_GET['selection'])? intval($_GET['selection']):0;
        $stmt=$con->prepare('SELECT products.*,categories.* FROM
        products INNER JOIN categories ON categories.category_id=products.product_category WHERE id=?');
        $stmt->execute(array($productId));
        $product=$stmt->fetch();
        $count=$stmt->rowCount();
        
        $stmt=$con->prepare('SELECT * FROM categories');
        $stmt->execute();
        $cats=$stmt->fetchAll();
    ?>

    <?php if($count>0): ?>

        <div class="container mt-5">
            <h1 class="text-center mb-3">Edit Product</h1>

            <form method="POST" action="?action=update" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                <input type="hidden" name="old_image" value="<?= $product['image']?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="name" value="<?= $product['name']?>" >
                    <label for="floatingInput">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPassword" name="price" value="<?= $product['price']?>">
                    <label for="floatingPassword">Price</label>
                </div>

                <select class="form-select" aria-label="Default select example" name="cat" required>
                <option disabled > select Category</option>
                    <?php foreach($cats as $cat):?>
                        <?php if($cat['category_name']==$product['category_name']):?>
                            <option value="<?=$cat['category_id']?>" selected><?=$cat['category_name']?></option>
                        <?php else: ?>
                            <option value="<?=$cat['category_id']?>"><?=$cat['category_name']?></option>
                        <?php endif?>
                    <?php endforeach?>
                </select>

                <div class="mb-3">
                    <img id="output" style="width: 300px;margin-bottom:10px;"/>

                    <input class="form-control" type="file" name="image" value="assests/imgs/<?= $product['image']?>" id="formFile" onchange="loadFile(event)">

                    <!-- image preview -->
                    <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                        }
                    };
                    </script>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>


    <?php else: ?>
        <?php header('location:products.php')?>
    <?php endif ?>


<?php elseif($action=='update'):?>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $productId=$_POST['id'];
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            $cat_id=$_POST['cat'];

            $image=$_FILES['image'];
            if(!empty($image['name'])){
                $image_name=$image['name'];
                $image_type=$image['type'];
                $image_tmp_name=$image['tmp_name'];
                $image_size=$image['size'];
                $allowedExtentions=array('image/jpg','image/jpeg','image/png');
                $Errors=array();
                if(in_array($image_type,$allowedExtentions)){
                    $rand_name=rand(0,10000).$image_name;
                    $destination='assests/imgs/'.$rand_name;
                    move_uploaded_file($image_tmp_name,$destination);
                }
            }else{
                $rand_name=$_POST['old_image'];
            }
           
            if(strlen($pro_name)<3){
                $Errors[]='<div class="alert alert-danger" role="alert">Product Name Must be More Than 3 Characters</div>';
            }

            if(empty($Errors)){
                $stmt=$con->prepare('UPDATE products SET name=? , price=? ,product_category=?, image=? WHERE id=?');
                $stmt->execute(array($pro_name,$pro_price,$cat_id,$rand_name,$productId));
                header('location:products.php');
            }else{
                foreach($Errors as $error){
                    echo $error;
                }
            }
            

            
        }       
    ?>

<?php elseif($action=='delete'):?>

    <?php 
        $productId=isset($_GET['selection'])&&is_numeric($_GET['selection'])? $_GET['selection'] : 0;
        $stmt=$con->prepare('DELETE FROM products WHERE id=?');
        $stmt->execute(array($productId));
        header('location:products.php')    
    ?>

<?php elseif($action=='search'): ?>
    
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $search_text=$_POST['product_search'];

            // get searched data
            $stmt=$con->prepare("
                                SELECT products.* , categories.* FROM products
                                INNER JOIN categories ON categories.category_id = products.product_category
                                WHERE name LIKE '%$search_text%'
                                OR id LIKE '%$search_text%'
                                OR category_name LIKE '%$search_text%'
                            ");
            $stmt->execute();
            $items=$stmt->fetchAll();
            $rowCount=$stmt->rowCount();

            // echo '<pre>';
            // print_r($items);
            // echo '</pre>';
            if($rowCount>0){
                
            }else{
                
            }
        }
    ?>

    <!-- show filtered data  -->


    <?php if($rowCount>0):?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Sale</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($items as $product):?>
                <tr>
                <td><?= $product['name']?></td>
                <td><?= $product['price']?></td>
                <td><?= $product['category_name']?></td>
                <td><?= $product['sale']?></td>
                <td><img src="assests/imgs/<?= $product['image']?>" alt="produce" style="width: 150px;"></td>
                <td>
                    <a href="?action=edit&selection=<?= $product['id']?>" class="btn btn-primary">Edit</a>
                    <button  class="btn btn-danger delete-btn" onclick="Popup (<?=$product['id']?>)">Delete</button>
                </td>
                </tr>
                <?php endforeach?>
                
                <div class="delete">
                    <div class="overlay">
                        <div class="delete-message">
                            <i class="fas fa-exclamation text-warning"></i>
                            <p>Are You Sure You Want To Delete this Product</p>
                            <div class="btns">
                                <a href="" class="btn btn-danger confirm-deletion">Delete</a>
                                <a href="#" class="btn btn-success undo-deletion">Undo</a>
                            </div>
                        </div>
                    </div>
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
            </tbody>
        </table>
    <?php else :?>
        <?php echo '<div class="alert alert-danger">Data Not Found</div>';?>
    <?php endif?>


<?php endif?>



<?php require "includes/footer.php"?>