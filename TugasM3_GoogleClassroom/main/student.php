<?php 
    require_once '../connect.php'; 
    include_once '../functions.php'; 

    if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "Student"){
        header("Location: ../form/login.php");
        exit;
    }

    $student = $_SESSION["user"];

    // Fetch all courses enrolled by the student
    $query = $conn->prepare('
        SELECT c.id, c.course_name, c.teacher_id, t.name
        FROM courses c
        JOIN users t ON t.id = c.teacher_id
        WHERE c.id IN (
            SELECT course_id FROM enrollments
            WHERE student_id = :student_id
	    )
        ');
    $query->execute([':student_id' => $student['id']]);
    $myCourses = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $conn->prepare('
        SELECT c.id, c.course_name, c.teacher_id, t.name
        FROM courses c
        JOIN users t ON t.id = c.teacher_id
        ');
    $query->execute();
    $allCourses = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h1>Welcome, <?= htmlspecialchars($student['name']) ?></h1>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="d-flex gap-3 mb-3">
            <a class="btn btn-primary" href="student.php?page=home">Home</a>
            <a class="btn btn-secondary" href="student.php?page=more">More Course</a>
        </div>
        <hr>

        <?php if (isset($_POST['join_course_id'])): ?>
            <?php
                $myCourseId = $_POST['join_course_id'];

                $enrollQuery = $conn->prepare('
                    INSERT INTO enrollments (student_id, course_id)
                    VALUES (:student_id, :course_id)
                ');

                $enrollQuery->execute([':student_id' => $student['id'], ':course_id' => $myCourseId]);


                $lessonQuery = $conn->prepare('
                    SELECT id, lesson_name
                    FROM lessons 
                    WHERE id_course = :course_id
                ');
                $lessonQuery->execute([':course_id' => $myCourseId]);
                $courseLessons = $lessonQuery->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($courseLessons)) {
                    $lessonInsertQuery = $conn->prepare('
                        INSERT INTO student_lessons (student_id, lesson_id, status)
                        VALUES (:student_id, :lesson_id, "Not Started")
                    ');
                    foreach ($courseLessons as $l) {
                        $lessonInsertQuery->execute([':student_id' => $student['id'], ':lesson_id' => $l['id']]);
                    }
                }
                
                header("Location: student.php?page=more");
                exit;
            ?>
        <?php endif; ?>

        <?php if (isset($_GET['course_id'])): ?>
            <?php
                $myCourseId = $_GET['course_id'];

                $currentCourse = null;
                foreach ($myCourses as $course) {
                    if ($course['id'] == $myCourseId) {
                        $currentCourse = $course;
                        break;
                    }
                }
                $query = $conn->prepare('
                    select l.id,  sl.lesson_id, l.lesson_name, l.content, sl.status
                    from lessons l
                    join student_lessons sl on sl.lesson_id = l.id
                    where l.id_course = :id_course and sl.student_id = :student_id
                ');
                $query->execute([':id_course' => $myCourseId, ':student_id' => $student['id']]);
                $lessons = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h2 class="text-center my-3">Lessons for Course: <?= htmlspecialchars($currentCourse['course_name']) ?></h2>
            <table class="table table-light table-striped-columns">
                <tr>
                    <th scope="col">Lesson Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                <?php if (empty($lessons)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No lessons have been added.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($lessons as $l): ?>
                        <tr>
                            <td><?= htmlspecialchars($l['lesson_name']) ?></td>
                            <td><?= htmlspecialchars($l['content']) ?></td>
                            <td class='<?= $l['status'] == "Completed" ? "bg-success" : ($l['status'] == "In Progress" ? "bg-warning" : "bg-secondary") ?> text-light'>
                                <?= $l['status'] ?>
                            </td>
                            <td>
                                <form action="cekMain.php" method="post">
                                    <?php if ($l['status'] == "Completed"): ?>
                                        -
                                    <?php elseif ($l['status'] == "In Progress"): ?>
                                        <button class="btn btn-success" type="submit" name="btnLessonSubmit">Submit</button>
                                    <?php elseif ($l['status'] == "Not Started"):?>
                                        <button class="btn btn-primary" type="submit" name="btnLessonStart">Start</button>
                                    <?php endif; ?>
                                    <input type="hidden" name="lesson_id" value="<?= $l['id'] ?>">
                                    <input type="hidden" name="course_id" value="<?= $myCourseId ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        <?php endif; ?>

        <?php if (isset($_GET['page']) && $_GET['page'] == 'home'): ?>
            <h2>Student Home Page</h2>
    
            <h4 class="mt-4 mb-3">Your Courses</h4>
            
            <table class="table table-light table-striped-columns">
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Action</th>
                </tr>
                <?php if (empty($myCourses)): ?>
                    <tr>
                        <td colspan="3" class="text-center">You are not enrolled in any courses.</td>
                    </tr>
                <?php else: foreach ($myCourses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['course_name']) ?></td>
                        <td><?= htmlspecialchars($course['name']) ?></td>
                        <td>
                            <a href="student.php?course_id=<?= $course['id'] ?>" class="btn btn-info">View Lessons</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </table>
        <?php elseif (isset($_GET['page']) && $_GET['page'] == 'more'): ?>
            <?php 
                $query = $conn->prepare('
                    select *
                    from enrollments
                    where student_id = :student_id
                ');
                $query->execute(['student_id' => $_SESSION['user']['id']]);
                $enrollments = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h1>Available Courses</h1>
            <table class="table table-light table-striped-columns">
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Action</th>
                </tr>
                <?php foreach ($allCourses as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['course_name']) ?></td>
                        <td><?= htmlspecialchars($c['name']) ?></td>
                        <td>
                            <?php if (in_array($c['id'], array_column($enrollments, 'course_id'))): ?>
                                Joined
                            <?php else: ?>
                                <form action="student.php" method="post">
                                    <button type="submit" class="btn btn-success">Join</button>
                                    <input type="hidden" name="join_course_id" value="<?= $c['id'] ?>">
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>