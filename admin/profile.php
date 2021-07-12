<?php
session_start();
require 'includes/config.php';
require 'includes/header.php';
include 'includes/navbar.php';
?>
<?php
$action = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

$userId = $_SESSION['ID'];
$stmt = $con->prepare('SELECT * FROM users WHERE id=?');
$stmt->execute(array($userId));
$user = $stmt->fetch();

?>
<?php if ($action == 'index') : ?>

    <div class="container">
        <h1 class="text-center">Profile</h1>
        <form>
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control " id="username" name="username" aria-describedby="emailHelp" value="<?= $user['username'] ?>" readonly>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?= $user['email'] ?>" readonly>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" aria-describedby="emailHelp" value="<?= $user['fullname'] ?>" readonly>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <a href="?action=edit" class="btn btn-info">Edit</a>
        </form>
    </div>

<?php elseif ($action == 'edit') : ?>
    <div class="container">
        <h1 class="text-center">Profile</h1>
        <form method="POST" action="?action=update">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control " id="username" name="username" aria-describedby="emailHelp" value="<?= $user['username'] ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?= $user['email'] ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="hidden" class="form-control" id="exampleInputPassword1" name="oldpassword" value="<?= $user['password'] ?>">
                <input type="password" class="form-control" id="exampleInputPassword1" name="newpassword">
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" aria-describedby="emailHelp" value="<?= $user['fullname'] ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php elseif ($action == 'update') : ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $fullName = $_POST['full_name'];
        $password = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
        $formErrors = array();
        // if(empty($_POST['newpassword'])){
        //     $password=$_POST['oldpassword'];
        // }else {
        //     $password=sha1($_POST['newpassword']);
        // }
        if (strlen($username) < 4) {
            $formErrors[] = 'User Name Must Be At Least 4 Characters';
        }
        if (empty($email)) {
            $formErrors[] = 'email Must Be filled';
        }
        if (empty($fullName)) {
            $formErrors[] = 'Full Name Must Be filled';
        }

        if (empty($formErrors)) {
            $stmt = $con->prepare('UPDATE users SET username=?,password=?,email=?,fullname=? WHERE id=?');
            $stmt->execute(array($username, $password, $email, $fullName, $userId));
            // echo $_SESSION['USER_NAME']=$username;
            // echo $_SESSION['EMAIL']=$email;
            // echo $_SESSION['FULL_NAME']=$fullName;
            header('location:profile.php');
        } else {
            foreach ($formErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }
    }
    ?>

<?php else : ?>

    <p>NOT FOUND 404 ERROR</p>
<?php endif ?>


<?php require 'includes/footer.php' ?>