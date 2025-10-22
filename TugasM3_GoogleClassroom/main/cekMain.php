<?php 

    require_once '../connect.php'; 
    include_once '../functions.php'; 

    if (!isset($_SESSION['user'])){
        header("Location: ../form/login.php");
        exit;
    }
    if ($_SESSION["user"]["role"] == "Teacher"){
        if (isset($_POST['btnCreateCourse'])){
            $courseName = $_POST['course_name'];
            $teacherId = $_SESSION["user"]["id"];

            if (empty($courseName)){
                $_SESSION["error"] = "Judul course tidak boleh kosong!";
                header("Location: teacher.php?page=create");
                exit;
            } else {
                $query = $conn->prepare('INSERT INTO courses (course_name, teacher_id) VALUES (:name, :teacher_id)');
                $query->execute(
                    [
                        ':name' => $courseName,
                        ':teacher_id' => $teacherId
                    ]);
                $_SESSION["success"] = "Course berhasil dibuat!";
                header("Location: teacher.php?page=home");
                exit;
            }
        } else if (isset($_POST['btnEditCourse'])) {
            $courseName = $_POST['course_name'];
            $courseId = $_POST['course_id'];

            if (empty($courseName)){
                $_SESSION["error"] = "Judul course tidak boleh kosong!";
                header("Location: teacher.php?edit_id=" . $courseId);
                exit;
            } else {
                $query = $conn->prepare('UPDATE courses SET course_name = :name WHERE id = :course_id');
                $query->execute(
                    [
                        ':name' => $courseName,
                        ':course_id' => $courseId
                    ]);
                $_SESSION["success"] = "Course berhasil diedit!";
                header("Location: teacher.php?page=home");
                exit;
            }
        } else if (isset($_POST['btnCreateLesson'])){
            $lessonName = $_POST['lesson_name'];
            $lessonContent = $_POST['lesson_content'];
            $courseId = $_POST['course_id'];
            $courseName = $_POST['course_name'];

            if (empty($lessonName) || empty($lessonContent)){
                $_SESSION["error"] = "Nama dan Konten lesson tidak boleh kosong!";
                header("Location: teacher.php?coursename=" . $courseName . "&courseid=" . $courseId);
                exit;
            } else {
                $query = $conn->prepare('INSERT INTO lessons (lesson_name, content, id_course) VALUES (:name, :content, :course_id)');
                $query->execute(
                    [
                        ':name' => $lessonName,
                        ':content' => $lessonContent,
                        ':course_id' => $courseId
                    ]);

                $lessonInsertQuery = $conn->prepare('
                    SELECT id
                    FROM lessons 
                    WHERE id_course = :course_id AND lesson_name = :lesson_name
                ');
                $lessonInsertQuery->execute([':course_id' => $courseId, ':lesson_name' => $lessonName]);
                $newLesson = $lessonInsertQuery->fetch(PDO::FETCH_ASSOC);
                if ($newLesson) {
                    $studentQuery = $conn->prepare('
                        SELECT student_id
                        FROM enrollments 
                        WHERE course_id = :course_id
                    ');
                    $studentQuery->execute([':course_id' => $courseId]);
                    $enrolledStudents = $studentQuery->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($enrolledStudents)) {
                        $studentLessonInsertQuery = $conn->prepare('
                            INSERT INTO student_lessons (student_id, lesson_id, status)
                            VALUES (:student_id, :lesson_id, "Not Started")
                        ');
                        foreach ($enrolledStudents as $s) {
                            $studentLessonInsertQuery->execute([':student_id' => $s['student_id'], ':lesson_id' => $newLesson['id']]);
                        }
                    }
                }
                $_SESSION["success"] = "Lesson berhasil dibuat!";
                header("Location: teacher.php?view_id=" . $courseId);
                exit;
            }
        } else if (isset($_POST['btnEditLesson'])){
            $lessonName = $_POST['lesson_name'];
            $lessonContent = $_POST['lesson_content'];
            $courseId = $_POST['course_id'];

            if (empty($lessonName) || empty($lessonContent)){
                $_SESSION["error"] = "Nama dan Konten lesson tidak boleh kosong!";
                header("Location: teacher.php?courseid=" . $courseId . "&lessonid=" . $_POST['lesson_id']);
                exit;
            } else {
                $query = $conn->prepare('UPDATE lessons SET lesson_name = :name, content = :content WHERE id = :lesson_id');
                $query->execute(
                    [
                        ':name' => $lessonName,
                        ':content' => $lessonContent,
                        ':lesson_id' => $_POST['lesson_id']
                    ]);
                $_SESSION["success"] = "Lesson berhasil diedit!";
                header("Location: teacher.php?view_id=" . $courseId);
                exit;
            }
        } else {
            header("Location: teacher.php?page=home");
            exit;
        }
    } else if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "Student"){
        if (isset($_POST['lesson_id'])) {
            $id = $_POST['lesson_id'];
            $courseId = $_POST['course_id'];
            if (isset($_POST['btnLessonStart'])) {
                $query = $conn->prepare('UPDATE student_lessons SET status = "In Progress" WHERE lesson_id = :lesson_id AND student_id = :student_id');
                $query->execute([':lesson_id' => $id, ':student_id' => $_SESSION["user"]["id"]]);
                
                header("Location: student.php?course_id=" . $courseId);
                exit;
            } else if (isset($_POST['btnLessonSubmit'])) {
                $query = $conn->prepare('UPDATE student_lessons SET status = "Completed" WHERE lesson_id = :lesson_id AND student_id = :student_id');
                $query->execute([':lesson_id' => $id, ':student_id' => $_SESSION["user"]["id"]]);
                header("Location: student.php?course_id=" . $courseId);
                exit;
            } else {
                header("Location: student.php?course_id=" . $courseId);
                exit;
            }
        }
    }
?>