<?php 
    session_start();
    include_once 'functions.php';
    if (!isset($_SESSION['user']) && !isset($_COOKIE['auth'])) {
        header('location: login.php');
        exit;
    }

    $user = null;

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else if (isset($_COOKIE['auth'])) {
        $user = unserialize($_COOKIE['auth']);
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        setcookie('auth', '', time() - 3600);
        header('location: login.php');
        exit;
    }

    if (isset($_SESSION["message"])) {
        echo "<script>alert('".$_SESSION['message']."');</script>";
        unset($_SESSION["message"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Welcome, <?= htmlspecialchars($user["username"]) ?></h1>
            <a href="home.php?logout=1" class="btn btn-danger">Logout</a>
        </div>
        <div class="d-flex gap-3">
            <a href="home.php?blog=mine" class="btn btn-primary">My Blogg</a>
            <a href="home.php?blog=create" class="btn btn-primary">Create Blogg</a>
            <a href="home.php?blog=more" class="btn btn-primary">More Blogg</a>
        </div>

        <!-- Up Blog -->
        <?php
            if (isset($_GET['up'])) {
                $blogIndex = $_GET['up'];
                $username = $user['username'];
                $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];

                if (isset($bloggs[$blogIndex])) {
                    if (!in_array($username, $bloggs[$blogIndex]['up'])) {
                        $bloggs[$blogIndex]['up'][] = $username;
                        setcookie("bloggs", serialize($bloggs), time() + 3600);

                        $_SESSION['message'] = "You have upvoted this blog.";
                    } else {
                        $key;
                        foreach ($bloggs[$blogIndex]['up'] as $k => $v) {
                            if ($v === $username) {
                                $key = $k;
                                break;
                            }
                        }
                        unset($bloggs[$blogIndex]['up'][$key]);
                        $bloggs[$blogIndex]['up'] = array_values($bloggs[$blogIndex]['up']);
                        setcookie("bloggs", serialize($bloggs), time() + 3600);
                        
                        $_SESSION['message'] = "You have removed your upvote.";
                    }
                }

                header('location: home.php?blog=more');
                exit;
            }
        ?>

        <!-- Comment Blog -->
        <?php
            if (isset($_GET['comment'])) {
                $blogIndex = $_GET['comment'];
                $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
                $blogTitle = isset($bloggs[$blogIndex]) ? $bloggs[$blogIndex]['title'] : 'Unknown';

                echo "<h2 class='mt-3'>Comment on \"$blogTitle\"</h2>";
                if (isset($bloggs[$blogIndex])) { 
            ?>
                <form action="blog_operator.php?blog=<?= $blogIndex ?>" method="POST" class="mt-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea id="comment" name="comment" class="form-control" rows="4"></textarea>
                    <input type="submit" class="btn btn-primary mt-2" value="Submit" name="btnComment">
                </form>
            <?php
                }

            }
        ?>

        <!-- View Blog -->
        <?php if (isset($_GET['view'])): ?>
            <h1 class="mt-3">View Blog</h1>
            <?php
                $blogg = null;
                $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
                $blogIndex = $_GET['view'];
                
                if (isset($bloggs[$blogIndex])) {
                    $blogg = $bloggs[$blogIndex];
                }
            ?>
            <?php if (isset($blogg)): ?>
                <div class="mt-3">
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
                </div>
            <?php else: ?>
                <div class="alert alert-danger mt-3">Blog not found.</div>
            <?php endif; ?>

        <?php endif; ?>

        <!-- Edit Blog -->
        <?php if (isset($_GET['edit'])): ?>
            <?php
                $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
                $blog = null;

                $blogIndex = $_GET['edit'];
                if (isset($bloggs[$blogIndex])) {
                    $blog = $bloggs[$blogIndex];
                }
            ?>
            <h1 class="mt-3">Edit Blogg</h1>
                <form action="blog_operator.php?edit=<?= $blogIndex ?>" method="POST" class="mt-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="<?= htmlspecialchars($blog['title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($blog['content']) ?></textarea>
                    </div>
                    <button type="submit" name="btnEditBlog" class="btn btn-primary">Edit</button>
                </form>
        <?php endif; ?>

        <!-- Blog Dashboard -->
        <?php if (isset($_GET['blog'])): ?>
            <?php if ($_GET['blog'] === 'mine'): ?>
                <?php
                    $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];

                    $userBlogs = [];
                    if (!empty($bloggs)) {
                        foreach ($bloggs as $index => $blog) {
                            if ($blog['author'] === $user['username']) {
                                $userBlogs[$index] = $blog;
                            }
                        }
                    }
                ?>
                <h1 class="mt-3">My Blogg</h1>
                <table class="table table-striped-columns" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Up</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($userBlogs)): ?>
                            <?php $i = 0;?>
                            <?php foreach ($userBlogs as $index => $blog): ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= htmlspecialchars($blog['title']) ?></td>
                                    <td><?= htmlspecialchars($blog['content']) ?></td>
                                    <td><?= count($blog['up']) ?></td>
                                    <td><?= count($blog['comments']) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="home.php?view=<?= $index ?>" class="btn btn-sm btn-info">View</a>
                                            <a href="home.php?edit=<?= $index ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No blogs found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            <?php elseif ($_GET['blog'] === 'create'): ?>
                <h1 class="mt-3">Create Blogg</h1>
                <form action="blog_operator.php?username=<?= htmlspecialchars($user['username']) ?>" method="POST" class="mt-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="btnCreateBlog" class="btn btn-primary">Create Blog</button>
                </form>
            <?php elseif ($_GET['blog'] === 'more'): ?>
                <h1 class="mt-3">More Blogg</h1>
                <?php
                    $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
                    $otherUserBloggs = [];
                    if (!empty($bloggs)) {
                        foreach ($bloggs as $index => $blog) {
                            if ($blog['author'] !== $user['username']) {
                                $otherUserBloggs[$index] = $blog;
                            }
                        }
                    }
                ?>
                <table class="table table-striped-columns" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Up</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($otherUserBloggs)): ?>
                            <?php $i = 0;?>
                            <?php foreach ($otherUserBloggs as $index => $blog): ?>
                                <?php $i++; ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= htmlspecialchars($blog['title']) ?></td>
                                    <td><?= htmlspecialchars($blog['content']) ?></td>
                                    <td><?= htmlspecialchars($blog['author']) ?></td>
                                    <td><?= count($blog['up']) ?></td>
                                    <td><?= count($blog['comments']) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="home.php?view=<?= $index ?>" class="btn btn-sm btn-info">Detail</a>
                                            <a href="home.php?up=<?= $index ?>" class="btn btn-sm btn-primary">Up</a>
                                            <a href="home.php?comment=<?= $index ?>" class="btn btn-sm btn-success">Comment</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No blogs found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
            <?php endif; ?>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>