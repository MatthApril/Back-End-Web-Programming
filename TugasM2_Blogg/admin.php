<?php 
    session_start(); 
    include_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body class="d-flex flex-column align-items-center" style="height: 100vh;">
    <?php 
        if (!isset($_SESSION['admin'])) {
            header('location: login.php');
            exit;
        }
        if (isset($_GET['logout'])) {
            logoutAdmin();
            exit;
        }
    ?>
    <div class="" style="padding: 50px;width: 1000px;">
        <h1>Welcome, admin</h1>
    
        <a class="btn btn-danger mt-3" href="admin.php?logout=1">Logout</a>

        <div class="d-flex gap-3 my-3">
            <a href="admin.php?view=all_bloggs" class="btn btn-primary">All Bloggs</a>
            <a href="admin.php?view=all_users" class="btn btn-primary">All User</a>
        </div>

        <?php if (isset($_GET["user_id_tochange"])) { ?>
            <?php 
                $user_id = $_GET['user_id_tochange'];
                if (isset($_COOKIE['users'])) {
                    $users = unserialize($_COOKIE['users']);
                    if (isset($users[$user_id])) {
                        $user = $users[$user_id];
                    } else {
                        echo "<p>User not found.</p>";
                        exit;
                    }
                } else {
                    echo "<p>No users found.</p>";
                    exit;
                }
            ?>

            <h1>Detail User</h1>

            <form action="change_password.php?user_id=<?= $user_id ?>" method="post">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <div class="mb-3">
                    <label for="new_password" class="form-label mt-3">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <label for="confirm_password" class="form-label mt-3">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <input type="submit" class="btn btn-primary mt-3" value="Change Password" name="btnChangePassword">
            </form>

            <?php if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            } ?>
        <?php } ?>
        
        <?php if (isset($_GET["user_id"])) { ?>
            <?php 
                $user_id = $_GET['user_id'];
                if (isset($_COOKIE['users'])) {
                    $users = unserialize($_COOKIE['users']);
                    if (isset($users[$user_id])) {
                        $user = $users[$user_id];
                    } else {
                        echo "<p>User not found.</p>";
                        exit;
                    }
                } else {
                    echo "<p>No users found.</p>";
                    exit;
                }
            ?>

            <h1>Detail User</h1>

            <table cellpadding="5" class="mb-3">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                </tr>
            </table>

            <a class="btn btn-warning" href="admin.php?user_id_tochange=<?= $user_id ?>">Change Password</a>
            <a class="btn btn-secondary" href="admin.php?view=all_users">Back</a>
            
        <?php } ?>

        <?php if (isset($_GET["id"])) { ?>
                <?php 
                    if (isset($_COOKIE['bloggs'])) {
                        $bloggs = unserialize($_COOKIE['bloggs']);
                        $id = $_GET['id'];
                        if (isset($bloggs[$id])) {
                            $blogg = $bloggs[$id];
                        } else {
                            echo "<p>Blog not found.</p>";
                            exit;
                        }
                    } else {
                        echo "<p>No blog posts found.</p>";
                        exit;
                    }
                ?>

                <h1>Blogg Detail</h1>

                <h2 class="my-3"><?= $blogg['title'] ?></h2>

                <span>By <?= $blogg['author'] ?></span>

                <p class="mt-3"><?= $blogg['content'] ?></p>

                <hr>
                <span>Up by <?= count($blogg['up'])?> people</span>
                <?php if (!empty($blogg['up'])) { ?>
                    <ul>
                        <?php foreach ($blogg['up'] as $key => $val) { ?>
                            <li><?= $val ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <hr>
                <?php if (empty($blogg['comments'])) : ?>
                    <p>No comments yet.</p>
                <?php else: ?>
                    <h3>Comments: <?= count($blogg['comments']) ?></h3>
                    <?php foreach ($blogg['comments'] as $key => $val) { ?>
                        <div class="mb-3">
                            <strong><?= htmlspecialchars($val['username']) ?>: </strong><?= htmlspecialchars($val['comment']) ?>
                        </div>
                    <?php } ?>
                <?php endif; ?>
            <?php } ?>

        <?php if (isset($_GET["view"])) { ?>
            <!-- Blog Posts -->
            <?php if ($_GET["view"] === "all_bloggs"){ ?>
                <h1>All Bloggs</h1>
                <table class="table table-striped-columns" style="margin-top: 20px;">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Up</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_COOKIE['bloggs'])): ?>
                        <?php if (empty(unserialize($_COOKIE['bloggs']))) : ?>
                            <tr>
                                <td colspan="6" class="text-center">No blog posts found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach (unserialize($_COOKIE['bloggs']) as $index => $blogg): ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1; ?></th>
                                <td><?= $blogg['title']; ?></td>
                                <td><?= $blogg['author']; ?></td>
                            <td><?= count($blogg['up']); ?></td>
                            <td><?= count($blogg['comments']); ?></td>
                            <td>
                                <a class="btn btn-info" href="admin.php?id=<?php echo $index; ?>">Detail</a>
                                <a class="btn btn-danger" href="deleteBlogg.php?id=<?php echo $index; ?>">Ban</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No blog posts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
                <!-- User Posts -->
            <?php } else if ($_GET["view"] === "all_users") { ?>
                <h1>All Users</h1>
                <table class="table table-striped-columns" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if (isset($_COOKIE['users'])): 
                        $users = unserialize($_COOKIE['users']);
                        if (empty($users)) {
                            echo "<tr><td colspan='4' class='text-center'>No users found.</td></tr>";
                        } else {
                            foreach ($users as $index => $user): ?>
                                <tr>
                                    <th scope='row'><?= $index + 1 ?></th>
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td>
                                        <?php 
                                            $passLength = strlen($user['password']);
                                            for ($i = 0; $i < $passLength; $i++) {
                                                echo "*";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="admin.php?user_id=<?= $index ?>">View</a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        }
                    else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php } ?>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>