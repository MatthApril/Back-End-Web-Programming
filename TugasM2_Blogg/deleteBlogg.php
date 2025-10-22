<?php 
    if (isset($_COOKIE['bloggs'])) {
        $bloggs = unserialize($_COOKIE['bloggs']);
        $id = $_GET['id'];
        $newBloggs = [];
        for ($i = 0; $i < count($bloggs); $i++) {
            if ($i != $id) {
                $newBloggs[] = $bloggs[$i];
            }
        }
        setcookie("bloggs", serialize($newBloggs), time() + 3600);
        header("Location: admin.php?view=all_bloggs");
        exit;
    }
?>