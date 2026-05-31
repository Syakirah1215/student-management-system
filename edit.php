<?php

$conn = new mysqli("localhost", "root", "", "student_management_demo");

$id = $_GET['id'];

$result = $conn->query(
"SELECT * FROM students WHERE id=$id"
);

$row = $result->fetch_assoc();

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $conn->query(
    "UPDATE students
    SET name='$name',
        email='$email',
        course='$course'
    WHERE id=$id"
    );

    header("Location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<div class="card shadow p-4">

<h2 class="mb-4">
✏ Edit Student
</h2>

<form method="POST">

<input
type="text"
name="name"
class="form-control mb-3"
value="<?php echo $row['name']; ?>"
required>

<input
type="email"
name="email"
class="form-control mb-3"
value="<?php echo $row['email']; ?>"
required>

<input
type="text"
name="course"
class="form-control mb-3"
value="<?php echo $row['course']; ?>"
required>

<button
type="submit"
name="update"
class="btn btn-success">

Update Student

</button>

<a href="index.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</body>
</html>