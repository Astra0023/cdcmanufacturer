<?php
session_start();
include 'connection.php';
$status = "";

function insertuser($name, $gender,$bdate){
	$conn = $GLOBALS['conn'];
	 $date = str_replace('-"', '/', $bdate);  
    $newDate = date("Y/m/d", strtotime($date));  
	$date_c = date("Y-m-d h:i:a");

$stmt = $conn->prepare("INSERT INTO user_tbl(name, gender, birthdate,date_created) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssss", $d1, $d2, $d3,$d4);

// set parameters and execute
$d1 = $name;
$d2 = $gender;
$d3 = $newDate;
$d4 = $date_c;

if ($stmt->execute()) {
return '<div class="alert alert-success" role="alert" id="success-alert">
User Added.
</div>';
}
}

function Showuserlist(){
$conn = $GLOBALS['conn'];

  $sql = "SELECT * FROM user_tbl";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
echo '   <tr>
        <td>'.$row['userid'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['gender'].'</td>
        <td>'.$row['birthdate'].'</td>
        <td>'.$row['date_created'].'</td>
      <td>
      <div class="btn-group">
<button type="submit" class="btn  btn-danger dltbtn"><i class="fa fa-times" aria-hidden="true"></i></button>

<button type="submit" class="btn btn-success editbtn"><i class="fa fa-pen" aria-hidden="true"></i></button>
 </div>
        </td>
             

      </tr>';
;

}

} else {
return '<div class="alert alert-danger" role="alert" id="success-alert">
 No Record Found
</div>';
}
}


function deleteuser($userid){
$conn = $GLOBALS['conn'];
$date_c = date("Y-m-d h:i:a");
// prepare and bind
$stmt = $conn->prepare("DELETE FROM user_tbl WHERE userid = ?");
$stmt->bind_param("s", $d1);

// set parameters and execute
$d1 = $userid;

  $sql = "SELECT * FROM user_tbl WHERE userid ='$userid'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
$stmt1 = $conn->prepare("INSERT INTO olduser_tbl(userid, name, gender, birthdate, date_created,date_deleted) VALUES (?,?,?,?,?,?)");
$stmt1->bind_param("ssssss", $d2, $d3,$d4, $d5, $d6, $d7);

// set parameters and execute
$d2 = $userid;
$d3 = $row['name'];
$d4 = $row['gender'];
$d5 = $row['birthdate'];
$d6 = $row['date_created'];
$d7 = $date_c;

if ($stmt1->execute()){
 if($stmt->execute()) {
return '<div class="alert alert-danger" role="alert" id="success-alert">
 User Details Deleted. 
</div>';
}
}
}
}
}

function updateUser($userid,$name,$gender, $bdate){
$conn = $GLOBALS['conn'];
  //check username if same
  $sql = "SELECT * FROM user_tbl WHERE userid ='$userid'";
  $result = mysqli_query($conn, $sql);
      $stmt = $conn->prepare("UPDATE user_tbl SET name = ?, gender = ?, birthdate = ? WHERE userid = ? ");
$stmt->bind_param("ssss", $d1,$d2,$d3,$d4);

$d1 = $name;
$d2 = $gender;
$d3 = $bdate;
$d4 = $userid;

if ($stmt->execute()){
  return '<div class="alert alert-success" role="alert" id="success-alert">
User ID: ['.$userid.'] updated.
</div>';
}
}

?>

