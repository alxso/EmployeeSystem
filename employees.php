<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="functions.js"></script>

<head>
    <title>Employee Table</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Content-Type" content="text/html" ; charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">


</head>

<!--NAVIGATION BAR-->
<nav>
    <ul>
        <li class="menu"><a href="index.php">Add</a></li>
        <li class="menu"><a href="employees.php">Employees</a></li>
    </ul>
</nav>



<!--PAGE CONTENT-->

<body>

    <form action="employees.php" method="POST">
        <br><label for="filter">Filter: *</label><br>
        <input type="text" id="filter" name="filter" placeholder="Name, Email, Date">
        <input type="submit" id="filterbutton" name="filterbutton" value="Filter"></input><br><br>
        <input type="text" id="fname" name="fname" placeholder="First Name *">
        <input type="text" id="mname" name="mname" placeholder="Middle Name"><br>
        <input type="text" id="lname" name="lname" placeholder="Last Name *">
        <input type="email" id="email" name="email" placeholder="Email: issoys@ttu.ee *"><br>
        <input type="phone" id="phone" name="phone" placeholder="Number: 372-530-9999" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
        <input type="date" id="hiredate" name="hiredate">*<br>
        <label for="active2">Active:</label><br>
        <input type="checkbox" id="active2" name="active2" value="YES">
        <br>* Mandatory to fill.</br>
    </form><br>
    <input type="submit" onclick="getIDtoEdit();" name="editbutton" value="Edit"></input>
    <input type="submit" onclick="getIDtoRemove();" name="removebutton" value="Remove"></input><br>

    <?php
    error_reporting(0);
    $link = mysqli_connect("localhost", "root", "", "employee_db", 3305);
    if (isset($_POST["filterbutton"])) {

        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $filter = mysqli_real_escape_string($link, $_REQUEST['filter']);

        $sqlfilter = "SELECT * FROM persons WHERE fname LIKE '%$filter%' OR mname LIKE '%$filter%' OR lname LIKE '%$filter%' OR email LIKE '%$filter%' OR phone LIKE '%$filter%' OR hiredate LIKE '%$filter%' ORDER BY id DESC;";


        echo '<table id="table" border="0" cellspacing="2" cellpadding="2"> 
        <tr > 
            <th> <font face="Arial">EmployeeID</font> </th> 
            <th> <font face="Arial">First Name</font> </th> 
            <th> <font face="Arial">Middle Name</font> </th> 
            <th> <font face="Arial">Last Name</font> </th> 
            <th> <font face="Arial">Email</font> </th> 
            <th> <font face="Arial">Phone</font> </th>
            <th> <font face="Arial">Date Hired</font> </th> 
            <th> <font face="Arial">Active</font> </th>
        </tr>';

        if ($result = $link->query($sqlfilter)) {
            while ($row = $result->fetch_assoc()) {
                $field0 = $row["id"];
                $field1 = $row["fname"];
                $field2 = $row["mname"];
                $field3 = $row["lname"];
                $field4 = $row["email"];
                $field5 = $row["phone"];
                $field6 = $row["hiredate"];
                $field7 = $row["active"];

                echo "<tr> 
                  <td>$field0</td> 
                  <td>$field1</td> 
                  <td>$field2</td> 
                  <td>$field3</td> 
                  <td>$field4</td> 
                  <td>$field5</td>
                  <td>$field6</td>  
                  <td>$field7</td>  
              </tr>";
            }
            $result->free();
        }
    } else {

        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sqldefault = "SELECT * FROM persons ORDER BY id DESC;";


        echo '<table id="table" border="0" cellspacing="2" cellpadding="2"> 
        <tr > 
            <th> <font face="Arial">EmployeeID</font> </th> 
            <th> <font face="Arial">First Name</font> </th> 
            <th> <font face="Arial">Middle Name</font> </th> 
            <th> <font face="Arial">Last Name</font> </th> 
            <th> <font face="Arial">Email</font> </th> 
            <th> <font face="Arial">Phone</font> </th>
            <th> <font face="Arial">Date Hired</font> </th>
            <th> <font face="Arial">Active</font> </th> 
        </tr>';

        if ($result = $link->query($sqldefault)) {
            while ($row = $result->fetch_assoc()) {
                $field0 = $row["id"];
                $field1 = $row["fname"];
                $field2 = $row["mname"];
                $field3 = $row["lname"];
                $field4 = $row["email"];
                $field5 = $row["phone"];
                $field6 = $row["hiredate"];
                $field7 = $row["active"];

                echo "<tr> 
                  <td>$field0</td> 
                  <td>$field1</td> 
                  <td>$field2</td> 
                  <td>$field3</td> 
                  <td>$field4</td> 
                  <td>$field5</td>
                  <td>$field6</td>
                  <td>$field7</td>
              </tr>";
            }
            $result->free();
        }
    }


    function table_remove($fetchid)
    {
        global $link;
        $sqlremove = mysqli_query($link, "DELETE FROM persons WHERE ID=$fetchid;");
        if (mysqli_query($link, $sqlremove)) {
            echo "Record removed successfully.";
        } else {
            echo "ERROR: Could not able to execute $sqlremove. " . mysqli_error($link);
        }
    }


    function table_edit($fetchid, $fname, $mname, $lname, $email, $phone, $hiredate, $active2)
    {
        global $link;

        if ($active2 == "") {
            $active2 = "NO";
        }

        $sqledit = mysqli_query($link, "UPDATE persons SET fname='$fname', mname='$mname', lname='$lname', email='$email', phone='$phone', hiredate='$hiredate', active='$active2' WHERE id=$fetchid;");

        if (mysqli_query($link, $sqledit)) {
            echo "Record edited successfully.";
        } else {
            echo "ERROR: Could not able to execute $sqledit. " . mysqli_error($link);
        }
    }


    if (isset($_POST['callFunc1'])) {
        echo table_remove($_POST['fetchid']);
    }

    if (isset($_POST['callFunc2'])) {
        echo table_edit($_POST['fetchid'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['hiredate'], $_POST['active2']);
    }
    ?>



</body>



</html>