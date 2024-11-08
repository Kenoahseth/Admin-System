<?php include "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $shift = $_POST['shift'];
    $shift_start = $_POST['shift_start'];
    $shift_end = $_POST['shift_end'];
    $bdate = $_POST['bdate'];
    $civ_stat = $_POST['civ-stat'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $religion = $_POST['religion'];
    $educational_attainment = $_POST['educational_attainment'];
    $cnum = $_POST['cnum'];


    $sql = "INSERT INTO staffs_table (firstname, lastname, sex, age, shift_start, shift_end, bdate, civ_stat, nationality, address, religion, educational_attainment, cnum)
            VALUES ('$firstname', '$lastname', '$sex', '$age', '$shift_start', '$shift_end', '$bdate', '$civ_stat', '$nationality', '$address', '$religion', '$educational_attainment', '$cnum' )";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employees List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles.css" />
</head>
<body>
    <?php include "components/sidebar.php"; ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>STAFFS AND EMPLOYEES</span></p>
            </div>
            <div class="right">
                <a href="#">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <section class="add-employees-section">
            <div class="add-employees-container">
                <form action="add-employees.php" method="POST">
                    <div class="add-employee-picture">
                        <button type="button">
                            <img src="../images/profile.png" alt="" />
                            <p>Add Picture</p>
                        </button>
                    </div>
                    <div class="employee-details">
                        <div class="grid-div">
                            <label for="firstname">First Name:</label>
                            <input type="text" name="firstname" placeholder="Enter their first name" required />
                        </div>
                        <div class="grid-div">
                            <label for="lastname">Last Name:</label>
                            <input type="text" name="lastname" placeholder="Enter their last name" required />
                        </div>
                        <div class="grid-div shift-flex">
                            <div>
                            <label for="sex">Sex:</label><br />
                            <select name="sex" required>
                                <option value="" disabled selected>Choose one:</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>
                            <div>
                                <label for="age">Age:</label>
                                <input type="number" name="age" required />
                            </div>
                        </div>
                        <div class="grid-div shift-flex">
                            <div>
                                <label for="shift">Shift:</label>
                                <select name="shift" required>
                                    <option value="" selected disabled>Choose</option>
                                    <option value="day">Day</option>
                                    <option value="night">Night</option>
                                </select>
                            </div>
                            <div>
                                <label for="shift_start">From:</label>
                                <input type="time" name="shift_start" required />
                                <label for="shift_end">To:</label>
                                <input type="time" name="shift_end" required />
                            </div>
                        </div>
                        <div class="grid-div">
                            <label for="bdate">Date of birth:</label><br />
                            <input type="date" name="bdate" required />
                        </div>
                        <div class="grid-div">
                            <label for="civ-stat">Civil Status:</label><br />
                            <select name="civ-stat" required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="grid-div">
                            <label for="nationality">Nationality:</label>
                            <input type="text" name="nationality" placeholder="Enter their nationality" required />
                        </div>
                        <div class="grid-div">
                            <label for="address">Address:</label>
                            <input type="text" name="address" placeholder="Enter their address" required />
                        </div>
                        <div class="grid-div">
                            <label for="religion">Religion:</label>
                            <input type="text" name="religion" placeholder="Enter their religion" />
                        </div>
                        <div class="grid-div">
                            <label for="educational_attainment">Educational Attainment:</label>
                            <input type="text" name="educational_attainment" placeholder="Enter their educational attainment" required />
                        </div>
                        <div class="grid-div">
                            <label for="cnum">Contact Number</label>
                            <input type="number" name="cnum" placeholder="Enter their contact number" required />
                        </div>
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>