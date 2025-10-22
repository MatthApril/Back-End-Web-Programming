<?php 
    require_once '../connect.php'; 
    include_once '../functions.php'; 

    if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "Teacher"){
        header("Location: ../form/login.php");
        exit;
    }

    $teacher = $_SESSION["user"];

    $query = $conn->prepare('SELECT * FROM courses WHERE teacher_id = :teacher_id');
    $query->execute([':teacher_id' => $teacher['id']]);
    $courses = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center py-3">
        <h1>Welcome, <?= $teacher['name'] ?></h1>
    
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    
        </div>
        <div class="d-flex gap-3 mb-3">
            <a class="btn btn-primary" href="teacher.php?page=home">Home</a>
            <a class="btn btn-secondary" href="teacher.php?page=create">Create Course</a>
        </div>
        <hr>

        <!-- Edit Lesson -->

        <?php if (isset($_GET['courseid']) && isset($_GET['lessonid'])): ?>
            <?php 
                $course = null;
                foreach ($courses as $key => $value) {
                    if ($value['id'] == $_GET['courseid']) {
                        $course = $value;
                        break;
                    }
                }

                $query = $conn->prepare('SELECT * FROM lessons WHERE id = :lesson_id');
                $query->execute([':lesson_id' => $_GET['lessonid']]);
                $lesson = $query->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2 class="my-4 text-center">Edit Lesson for Course: <?= htmlspecialchars($course['course_name']) ?></h2>
    
            <a href="teacher.php?view_id=<?= htmlspecialchars($_GET['courseid']) ?>" class="btn btn-warning mb-3">Back to Lessons</a>
    
            <form action="cekMain.php" method="post" class="mb-3">
                <div class="mb-3">
                    <label for="lesson_name" class="form-label">Lesson Name:</label>
                    <input type="text" class="form-control" id="lesson_name" name="lesson_name" value="<?= htmlspecialchars($lesson['lesson_name']) ?>">
                </div>
                <div class="mb-3">
                    <label for="lesson_content" class="form-label">Lesson Content:</label>
                    <textarea class="form-control" id="lesson_content" name="lesson_content" rows="4"><?= htmlspecialchars($lesson['content']) ?></textarea>
                    </div>
                <input type="hidden" name="course_id" value="<?= htmlspecialchars($_GET['courseid']) ?>">
                <input type="hidden" name="lesson_id" value="<?= htmlspecialchars($_GET['lessonid']) ?>">
                <input type="submit" class="btn btn-success" value="Edit Lesson" name="btnEditLesson">
            </form>
    
            <?php errorMessage(); ?>
        <?php endif; ?>
        <!-- End of Edit Lesson -->
    
        <!-- Create Lesson -->
        <?php if (isset($_GET['coursename']) && isset($_GET['courseid'])): ?>
            <h2 class="my-4 text-center">Create Lesson for Course: <?= htmlspecialchars($_GET['coursename']) ?></h2>

            <a href="teacher.php?view_id=<?= htmlspecialchars($_GET['courseid']) ?>" class="btn btn-warning mb-3">Back to Lessons</a>
    
            <form action="cekMain.php" method="post" class="mb-3">
                <div class="mb-3">
                    <label for="lesson_name" class="form-label">Lesson Name:</label>
                    <input type="text" class="form-control" id="lesson_name" name="lesson_name">
                </div>
                <div class="mb-3">
                    <label for="lesson_content" class="form-label">Lesson Content:</label>
                    <textarea class="form-control" id="lesson_content" name="lesson_content" rows="4"></textarea>
                </div>
                <input type="hidden" name="course_id" value="<?= htmlspecialchars($_GET['courseid']) ?>">
                <input type="hidden" name="course_name" value="<?= htmlspecialchars($_GET['coursename']) ?>">
                <input type="submit" class="btn btn-success" value="Create Lesson" name="btnCreateLesson">
            </form>
    
            <?php errorMessage(); ?>
        <?php endif; ?>
        <!-- End of Create Lesson -->

        <!-- View Lessons -->
        <?php if (isset($_GET['view_id'])): ?>
            <?php
                $course = null;
                foreach ($courses as $c) {
                    if ($c['id'] == $_GET['view_id']) {
                        $course = $c;
                        break;
                    }
                }
            ?>
            <h2 class="my-4 text-center">Lesson for Course: <?= htmlspecialchars($course['course_name']) ?></h2>

            <a href="teacher.php?coursename=<?= htmlspecialchars($course['course_name']) ?>&courseid=<?= htmlspecialchars($course['id']) ?>" class="btn btn-success">Create New Lesson</a>

            <table class="table table-light table-striped-columns mt-3">
                <thead>
                    <tr>
                        <th scope="col">Lesson Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $courseId = $_GET['view_id'];
                    $query = $conn->prepare('SELECT * FROM lessons WHERE id_course = :course_id');
                    $query->execute([':course_id' => $courseId]);
                    $lessons = $query->fetchAll(PDO::FETCH_ASSOC);

                    if (count($lessons) > 0): ?>
                        <?php foreach ($lessons as $index => $lesson): ?>
                            <tr>
                                <td><?= htmlspecialchars($lesson['lesson_name']) ?></td>
                                <td><?= htmlspecialchars($lesson['content']) ?></td>
                                <td>
                                    <a href="teacher.php?courseid=<?= htmlspecialchars($courseId) ?>&lessonid=<?= $lesson['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No lessons found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        <?php endif; ?>
        <!-- End of View Lessons -->

        <!-- Edit Course -->
        <?php if (isset($_GET['edit_id'])): ?>
            <h2 class="my-4 text-center">Edit Course</h2>
            <?php 
                $course = null;
                foreach ($courses as $key => $value) {
                    if ($value['id'] == $_GET['edit_id']) {
                        $course = $value;
                        break;
                    }
                }
            ?>
            <form class="mb-3" action="cekMain.php" method="post">
                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name:</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>">
                </div>
                <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['id']) ?>">
                <input type="submit" class="btn btn-success" value="Edit Course" name="btnEditCourse">
            </form>
            <?php errorMessage(); ?>
        <?php endif; ?>
        <!-- End of Edit Course -->

        <?php if (isset($_GET["page"])): ?>
            <!-- Create Course -->
            <?php if ($_GET['page'] === 'create'): ?>
                <h2 class="my-4 text-center">Create Course</h2>
                <form class="mb-3" action="cekMain.php" method="post">
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name:</label>
                        <input type="text" class="form-control" id="course_name" name="course_name">
                    </div>
                    <input type="submit" class="btn btn-success" value="Create Course" name="btnCreateCourse">
                </form>
                <?php errorMessage(); ?>
            <!-- End of Create Course -->

            <!-- Home Page -->
            <?php else: ?>
            <h2 class="my-4 text-center">Teacher Home Page</h2>

            <h3>Your Courses</h3>

            <table class="table table-light table-striped-columns">
            <thead>
                <tr>
                <th scope="col">Course Title</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $teacherId = $teacher['id'];

                if (count($courses) > 0): ?>
                    <?php foreach ($courses as $index => $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['course_name']) ?></td>
                            <td>
                                <a href="teacher.php?view_id=<?= $course['id'] ?>" class="btn btn-info btn-sm">View Lessons</a>
                                <a href="teacher.php?edit_id=<?= $course['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!-- End of Home Page -->
        <?php endif; ?>
    </div>

    <?php 
        if (isset($_SESSION['success'])){
            alert($_SESSION['success']);
            unset($_SESSION['success']);
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>