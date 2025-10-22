<?php 
    session_start();
    
    if (!isset($_SESSION['user']) && !isset($_COOKIE['auth'])) {
        header('location: login.php');
        exit;
    }

    if (isset($_POST['btnCreateBlog'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
        $bloggs[] = [
            'title' => $title,
            'content' => $content,
            'author' => $_GET['username'],
            'up' => [],
            'comments' => []
        ];
        setcookie("bloggs", serialize($bloggs), time() + 3600);

        header('location: home.php?blog=mine');
        exit;
    } else if (isset($_POST['btnEditBlog'])) {
        $blogIndex = $_GET['edit'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];

        if (isset($bloggs[$blogIndex])) {
            $bloggs[$blogIndex]['title'] = $title;
            $bloggs[$blogIndex]['content'] = $content;
        }
        setcookie("bloggs", serialize($bloggs), time() + 3600);

        header('location: home.php?blog=mine');
        exit;
    } else if (isset($_POST['btnComment'])) {
        $blogIndex = $_GET['blog'];
        $comment = $_POST['comment'];

        $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];

        if (isset($bloggs[$blogIndex])) {
            $username = isset($_SESSION['user']) ? $_SESSION['user']['username'] : unserialize($_COOKIE['auth'])['username'];
            $bloggs[$blogIndex]['comments'][] = [
                'username' => $username,
                'comment' => $comment
            ];
        }
        setcookie("bloggs", serialize($bloggs), time() + 3600);
        $_SESSION['message'] = "Comment added successfully.";

        header('location: home.php?blog=more');
        exit;
    } else {
        header('location: home.php');
        exit;
    }

?>