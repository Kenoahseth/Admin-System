<?php
include 'components/connector.php';

$staff = null;

if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
    $assigned_id = intval($_GET['employee_id']);

    // Fetch employee details
    $sql = "SELECT * FROM staffs_table WHERE assigned_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $assigned_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $staff = $result->fetch_assoc();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $shift_start = $_POST['shift_start'];
    $shift_end = $_POST['shift_end'];
    $bdate = $_POST['bdate'];
    $civ_stat = $_POST['civ_stat'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $religion = $_POST['religion'];
    $educational_attainment = $_POST['educational_attainment'];
    $cnum = $_POST['cnum'];
    $assigned_id = $_POST['assigned_id'];
    $position = $_POST['position'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $status = 'Inactive';  // Set status to Inactive by default

    // Handle file upload
    $filePath = $staff['profile_picture']; // Existing profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profilePicture = $_FILES['profile_picture'];
        $uploadDir = 'uploads/profile_pictures/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filePath = $uploadDir . basename($profilePicture['name']);
        move_uploaded_file($profilePicture['tmp_name'], $filePath);
    }

    $sql = "UPDATE staffs_table SET 
            firstname = ?, 
            lastname = ?, 
            sex = ?, 
            age = ?, 
            shift_start = ?, 
            shift_end = ?, 
            bdate = ?, 
            civ_stat = ?, 
            nationality = ?, 
            address = ?, 
            religion = ?, 
            educational_attainment = ?, 
            cnum = ?, 
            position = ?, 
            height = ?, 
            weight = ?, 
            status = ?, 
            profile_picture = ? 
            WHERE assigned_id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssissssssssissdssi", $firstname, $lastname, $sex, $age, $shift_start, $shift_end, $bdate, $civ_stat, $nationality, $address, $religion, $educational_attainment, $cnum, $position, $height, $weight, $status, $filePath, $assigned_id);
        if ($stmt->execute()) {
            echo "<script>alert('Employee details updated successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles.css" />
</head>
<body>
    <?php include 'components/sidebar.php'; ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>EDIT STAFFS AND EMPLOYEES</span></p>
            </div>
            <form class="emp-id" method="GET" action="">
                <input class="emp-input" type="number" name="employee_id" placeholder="Enter Employee ID">
                <button type="submit"></button>
            </form>
            <div class="right">
             
            </div>
        </div>

        <section class="add-employees-section">
            <div class="add-employees-container">
                <?php if ($staff) : ?>
                    <form action="edit-employees.php?employee_id=<?= htmlspecialchars($assigned_id); ?>" method="POST" enctype="multipart/form-data">
                    <div class="add-employee-picture">
                        <input type="file" name="profile_picture" accept="image/*" id="profile_picture" style="display: none;">
                        <label for="profile_picture">
                            <img src="<?= $staff['profile_picture'] ?? '../images/profile.png' ?>" alt="Profile Picture" id="profile_picture_preview" style="cursor: pointer;">
                            <p>Edit Picture</p>
                        </label>
                    </div>
                    <div class="employee-details">
                        <div class="grid-div">
                            <label for="firstname">First Name:</label>
                            <input type="text" name="firstname" value="<?= htmlspecialchars($staff['firstname']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="lastname">Last Name:</label>
                            <input type="text" name="lastname" value="<?= htmlspecialchars($staff['lastname']); ?>" required />
                        </div>
                        <div class="grid-div shift-flex">
                            <div>
                                <label for="sex">Sex:</label><br />
                                <select name="sex" required>
                                    <option value="" disabled>Choose one:</option>
                                    <option value="male" <?= $staff['sex'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="female" <?= $staff['sex'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="age">Age:</label>
                                <input type="number" name="age" value="<?= htmlspecialchars($staff['age']); ?>" required />
                            </div>
                        </div>
                        <div class="grid-div shift-flex">
                            <div>
                                <label for="shift">Shift:</label>
                                <select name="shift" required>
                                    <option value="" disabled>Choose</option>
                                    <option value="day" <?= $staff['shift'] == 'day' ? 'selected' : ''; ?>>Day</option>
                                    <option value="night" <?= $staff['shift'] == 'night' ? 'selected' : ''; ?>>Night</option>
                                </select>
                            </div>
                            <div>
                                <label for="shift_start">From:</label>
                                <input type="time" name="shift_start" value="<?= htmlspecialchars($staff['shift_start']); ?>" required />
                                <label for="shift_end">To:</label>
                                <input type="time" name="shift_end" value="<?= htmlspecialchars($staff['shift_end']); ?>" required />
                            </div>
                        </div>
                        <div class="grid-div">
                            <label for="bdate">Date of birth:</label><br />
                            <input type="date" name="bdate" value="<?= htmlspecialchars($staff['bdate']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="civ_stat">Civil Status:</label><br />
                            <select name="civ_stat" required>
                                <option value="single" <?= $staff['civ_stat'] == 'single' ? 'selected' : ''; ?>>Single</option>
                                <option value="married" <?= $staff['civ_stat'] == 'married' ? 'selected' : ''; ?>>Married</option>
                                <option value="divorced" <?= $staff['civ_stat'] == 'divorced' ? 'selected' : ''; ?>>Divorced</option>
                                <option value="separated" <?= $staff['civ_stat'] == 'separated' ? 'selected' : ''; ?>>Separated</option>
                                <option value="widowed" <?= $staff['civ_stat'] == 'widowed' ? 'selected' : ''; ?>>Widowed</option>
                            </select>
                        </div>
                        <div class="grid-div">
                            <label for="nationality">Nationality:</label>
                            <input type="text" name="nationality" value="<?= htmlspecialchars($staff['nationality']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="address">Address:</label>
                            <input type="text" name="address" value="<?= htmlspecialchars($staff['address']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="religion">Religion:</label>
                            <input type="text" name="religion" value="<?= htmlspecialchars($staff['religion']); ?>" />
                        </div>
                        <div class="grid-div">
                            <label for="educational_attainment">Educational Attainment:</label>
                            <input type="text" name="educational_attainment" value="<?= htmlspecialchars($staff['educational_attainment']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="cnum">Contact Number</label>
                            <input type="number" name="cnum" value="<?= htmlspecialchars($staff['cnum']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="assigned_id">Employee ID</label>
                            <input type="number" name="assigned_id" value="<?= htmlspecialchars($staff['assigned_id']); ?>" required readonly />
                        </div>
                        <div class="grid-div">
                            <label for="position">Position</label>
                            <input type="text" name="position" value="<?= htmlspecialchars($staff['position']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="height">Height (in cm)</label>
                            <input type="text"  name="height" value="<?= htmlspecialchars($staff['height']); ?>" required />
                        </div>
                        <div class="grid-div">
                            <label for="weight">Weight (in kg)</label>
                            <input type="text"  name="weight" value="<?= htmlspecialchars($staff['weight']); ?>" required />
                        </div>
                      
                        <button type="submit" class="submit-btn">Update</button>
                    </div>
                </form>
                <?php else: ?>
                <p>No employee found with the provided ID.</p>
                <?php endif; ?>
            </div>
        </section>

        <script>
            document.getElementById('profile_picture').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('profile_picture_preview').src = e.target.result;
                };
                
                reader.readAsDataURL(file);
            });

            document.querySelector('.add-employee-picture label').addEventListener('click', function() {
                document.getElementById('profile_picture').click();
            });
        </script>
    </main>
</body>
</html>
