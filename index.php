<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <br><br>    
    <form action="index.php" method="post">
        <input type="text" name="fname" placeholder="FirstName" value="">
        <input type="text" name="lname" placeholder="LastName" value="">
        <input type="number" name="mobile" placeholder="Mobile" value="">
        <input type="text" name="adress" placeholder="Adress" value="">
        
        <div>
            <br><br>
            <input type="submit" name="insert" value="Add">
        </div>

    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql2019";

try {
    $conn = new PDO("mysql:host=$servername;dbName=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";
}
catch(PDOException $e){
    echo "connection failed:" . $e->getMessage();
}
$query = "SELECT * FROM mysql2019.students";
$data = $conn->query($query);
echo '<table width="70%" border="1" cellpadding="5" cellspacing="5">
        <tr>
            <th>ID</th>
            <th>first name</th>
            <th>last name</th>
            <th>mobile</th>
            <th>adress</th>
        </tr>
     ';

foreach($data as $row){
    echo '
        <tr>
            <td>'.$row["id"].'</td>
            <td>'.$row["firstName"].'</td>
            <td>'.$row["lastName"].'</td>
            <td>'.$row["mobile"].'</td>
            <td>'.$row["adress"].'</td>

        </tr>
     ';
}
echo '</table>';
if(isset($_POST['insert'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $adress = $_POST['adress'];
    $query = "INSERT INTO `students`(`firstName`, `lastName`, `mobile`, `adress`) VALUES (:firstName,:lastName,:mobile,:adress)";
    $Result = $conn->prepare($query);
    $Exec = $Result->execute(array(
        ":firstName"=>$data,
        ":lastname"=>$lname,
        ":mobile"=>$mobile,
        ":adress"=>$adress
));
if($Exec){
    echo 'data inserted';
}else{
    echo 'data not inserted';
}
// $Result->bindparam(`:firstName`, $fname);
// $Result->bindparam(`:lastName`, $lname);
// $Result->bindparam(`:mobile`, $mobile);
// $Result->bindparam(`:adress`, $adress);
// $Result->execute();


}

?>
