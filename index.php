<?php

$conn = new mysqli("localhost", "root", "", "student_management_demo");

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $conn->query("DELETE FROM students WHERE id=$id");

    header("Location: index.php");
    exit();
}

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students(name,email,course)
            VALUES('$name','$email','$course')";

    $conn->query($sql);

    header("Location: index.php");
    exit();
}

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = $_GET['search'];

    $result = $conn->query(
    "SELECT * FROM students
     WHERE name LIKE '%$search%'"
    );
}
else
{
    $result = $conn->query(
    "SELECT * FROM students"
    );
}

$total = $conn->query("SELECT * FROM students");
$count = $total->num_rows;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .header-box{
            background:linear-gradient(135deg,#4e73df,#224abe);
            color:white;
            padding:30px;
            border-radius:15px;
            margin-bottom:20px;
            text-align:center;
        }

        .card-box{
            border:none;
            border-radius:15px;
            box-shadow:0 3px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body style="background: linear-gradient(to right, #74ebd5, #ACB6E5);">

<div class="container mt-5">

    <div class="bg-primary text-white p-4 rounded shadow mb-4 text-center">

    <h1>🎓 Student Management System</h1>

    <p>
    Manage Student Records Using PHP, MySQL and AWS
    </p>

    </div>
	<div class="row mb-4">

    <div class="col-md-4">

        <div class="card bg-success text-white shadow">

            <div class="card-body text-center">

                <h5>Total Students</h5>

                <h1><?php echo $count; ?></h1>

            </div>

        </div>

    </div>
 
    </div>

    <div class="card card-box bg-primary text-white mb-4">
        <div class="card-body text-center">
            <h3>Total Students</h3>
            <h1><?php echo $count; ?></h1>
        </div>
    </div>

    <div class="card card-box p-4 mb-4">
        <h3>➕ Add New Student</h3>

        <form method="POST">

            <input type="text"
            name="name"
            class="form-control mb-3"
            placeholder="Student Name"
            required>

            <input type="email"
            name="email"
            class="form-control mb-3"
            placeholder="Student Email"
            required>

            <input type="text"
            name="course"
            class="form-control mb-3"
            placeholder="Course"
            required>

            <button type="submit"
            name="add"
            class="btn btn-success">
            Add Student
            </button>

        </form>
    </div>

    <div class="card card-box p-4">

        <h3>📋 Student List</h3>
		
        <form method="GET" class="mb-3">

        <input
        type="text"
        name="search"
        class="form-control"
        placeholder="🔍 Search Student Name..."
        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        </form>
        <table class="table table-striped table-hover table-bordered shadow bg-white">

            <thead class="table-dark">

            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Created At</th>
            <th>Action</th>
            </tr>

            </thead>

            <?php while($row = $result->fetch_assoc()) { ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
				<td>

                <a href="edit.php?id=<?php echo $row['id']; ?>"
                class="btn btn-warning btn-sm">         
                ✏ Edit
                </a>
                <a href="?delete=<?php echo $row['id']; ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Delete this student?')">
                🗑 Delete
                </a>
				
                </td>
				
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>