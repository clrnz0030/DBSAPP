<?php
 
session_start();
if (!isset($_SESSION['admin_ID'])){
header('location: login.php');
exit();
 
 
}
    require_once('classes/database.php');
    $con = new database();
 
    $data = $con->opencon();
 
 
 $sweetAlertConfig = "";
 
    if (isset($_POST['add_student'])){
     
 
      $firstname = $_POST['first_name'];
      $lastname = $_POST['last_name'];
       $email = $_POST['email'];
       $admin_id = $_SESSION['admin_ID'];
 
      $userID = $con->addStudent($firstname, $lastname, $email, $admin_id);
     
      if ($userID) {
        $sweetAlertConfig = "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Registration Successful',
          text: 'You have successfully registered as an admin.',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location.href = 'login.php';
        });
        </script>
        ";
      } else {
        $sweetAlertConfig = "
         <script>
        Swal.fire({
          icon: 'error',
          title: 'Registration Failed',
          text: 'An error occurred during registration. Please try again.',
          confirmButtonText: 'OK'
        });
        </script>"
       
        ;
      }
    }
 
     if (isset($_POST['add_course'])){
     
 
      $course_name = $_POST['course_name'];
     
       $admin_id = $_SESSION['admin_ID'];
 
      $userID = $con->addCourse($course_name, $admin_id);
     
      if ($userID) {
        $sweetAlertConfig = "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Registration Successful',
          text: 'You have successfully registered as an admin.',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location.href = 'login.php';
        });
        </script>
        ";
      } else {
        $sweetAlertConfig = "
         <script>
        Swal.fire({
          icon: 'error',
          title: 'Registration Failed',
          text: 'An error occurred during registration. Please try again.',
          confirmButtonText: 'OK'
        });
        </script>"
       
        ;
      }
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student & Course CRUD (PHP PDO)</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./package/dist/sweetalert2.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-center">Student Records</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New Student</button>
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Course</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Jei Q. Pastrana</td>
          <td>jei@example.com</td>
          <td>DIT</td>
          <td>
            <button class="btn btn-sm btn-warning">Edit</button>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
 
    <h2 class="mb-4 mt-5">Courses</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Course Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>BS Information Technology</td>
          <td>
            <button class="btn btn-sm btn-warning">Edit</button>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
 
    <h2 class="mb-4 mt-5">Enrollments</h2>
    <button class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#enrollStudentModal">Enroll Student</button>
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-dark">
        <tr>
          <th>Enrollment ID</th>
          <th>Student Name</th>
          <th>Course</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Juan Dela Cruz</td>
          <td>BS Information Technology</td>
          <td>
            <button class="btn btn-sm btn-warning">Edit</button>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
 
  <!-- Add Student Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="first_name" class="form-control mb-2" placeholder="First Name" required>
          <input type="text" name="last_name" class="form-control mb-2" placeholder="Last Name" required>
          <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
         
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_student">Add</button>
        </div>
         <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./package/dist/sweetalert2.js"></script>
  <?php echo $sweetAlertConfig; ?>
      </form>
    </div>
  </div>
 
  <!-- Add Course Modal -->
  <div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title">Add Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="course_name" class="form-control mb-2" placeholder="Course Name" required>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_course">Add Course</button>
        </div>
      </form>
    </div>
  </div>
 
  <!-- Enroll Student Modal -->
  <div class="modal fade" id="enrollStudentModal" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="enroll_student.php">
        <div class="modal-header">
          <h5 class="modal-title">Enroll Student to Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="student_id" class="form-control mb-2" placeholder="Student ID" required>
          <input type="text" disabled name="student_name" class="form-control mb-2" placeholder="Student Name" required>
         
          <select name="course_id" class="form-control" required>
            <option value="">Select Course</option>
            <option value="1">Computer Science</option>
            <option value="2">Information Technology</option>
            <option value="3">Software Engineering</option>
            <option value="4">Data Science</option>
          </select>
         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Enroll</button>
        </div>
      </form>
    </div>
  </div>
 
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
 
 
</body>
</html>
 
 
<?php
 
class database {
 
    function opencon() {
        return new PDO(
            'mysql:host=localhost;dbname=dbs_app',
            username: 'root',
            password: ''
        );
    }
 
    function signupUser($firstname, $lastname, $username, $email, $password) {
        $con = $this->opencon();
 
        try {
            $con->beginTransaction();
 
            $stmt = $con->prepare("INSERT INTO Admin (admin_FN, admin_LN, admin_username, admin_email, admin_password) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $username, $email, $password]);
 
            $userId = $con->lastInsertId();
            $con->commit();
 
            return $userId;
        } catch (PDOException $e) {
            $con->rollBack();
            return false;
        }
    }
     function isUsernameExists ($username) {
        $con = $this->opencon();
        $stmt = $con->prepare("SELECT COUNT(*) FROM Admin WHERE admin_username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();
        return $count > 0;
        }
 
        function isEmailExists ($email) {
        $con = $this->opencon();
        $stmt = $con->prepare("SELECT COUNT(*) FROM Admin WHERE admin_email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
        }
 
    function loginUser($username, $password) {
    $con = $this->opencon();
    $stmt = $con->prepare("SELECT * FROM Admin WHERE admin_username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['admin_password'])) {
    return $user;
    }
 
    return false;
 }
 
    function addStudent($firstname, $lastname, $email, $admin_id) {
        $con = $this->opencon();
 
        try {
            $con->beginTransaction();
 
            $stmt = $con->prepare("INSERT INTO students (student_FN, student_LN,  student_email, admin_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $email, $admin_id]);
 
            $userId = $con->lastInsertId();
            $con->commit();
 
            return $userId;
        } catch (PDOException $e) {
            $con->rollBack();
            return false;
        }
    }
 
 function addCourse($course_name, $admin_id) {
        $con = $this->opencon();
 
        try {
            $con->beginTransaction();
 
            $stmt = $con->prepare("INSERT INTO courses (course_name,  admin_id) VALUES (?, ?)");
            $stmt->execute([$course_name, $admin_id]);
 
            $userId = $con->lastInsertId();
            $con->commit();
 
            return $userId;
        } catch (PDOException $e) {
            $con->rollBack();
            return false;
        }
    }
 
 
 
 
}
 