<!DOCTYPE html>
<html5 lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

      <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  </head>
  <body>
<?php include 'process.php'; ?>
<br>
<BR>
<?php 
if (isset($_POST['addbtn'])) {
$status = insertuser($_POST['name'], $_POST['gender'],$_POST['bdate']);
}

if (isset($_POST['updateNurse'])) {
 $status = updateUser($_POST['uuid'],$_POST['uname'], $_POST['ugender'],$_POST['ubdate']);
}


if (isset($_POST['dltBtn'])) {
$status = deleteuser($_POST['dstaffid']);
}

?>



<div class="container col-8 mx-auto">
<div class="card">
  <div class="card-header"><h2>Add User<span class="float-right">
    <button type="button" class="btn btn-md btn-info"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add User</button></span></h2>
<?php echo $status; ?>
  </div>
  <div class="card-body">



<div class="table-responsive">
<div class="container">


  <table id="example" class="table table-hover">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Gender</th>
           <th>DOB</th>
           <th>Date Created</th>
                  <th>Action</th>
      </tr>
    </thead>
    <tbody>
   <?php Showuserlist(); ?>
    </tbody>
  </table>
</div>
 </div>

  
</div>
</div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 


   <div class="row">
      <div class="col">
         <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" minlength="6" required/>
    </div>
      </div>
    </div>
      <div class="row">
        <div class="col">
    <div class="form-group">
  <label for="gender">Gender:</label>
  <select class="form-control" id="gender" name="gender" required>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
</div>
      </div>
    </div>
    <div class="row">
  <div class="col">
      <div class="form-group">
      <label for="bdate">Date Of Birth:</label>
      <input type="date" class="form-control bdate" name="bdate" id="bdate" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter date of birth">
    </div>
  </div>
</div>
    <button type="submit" class="btn btn-info btn-block" name="addbtn">Register</button>
  </form>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update User Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
      <div class="form-group">
      <label for="uuid">User ID</label>
      <input type="text" class="form-control uuid" id="uuid" name="uuid" readonly>
    </div>
   <div class="row">
      <div class="col">
         <div class="form-group">
      <label for="uname">Name</label>
      <input type="text" class="form-control uname" id="uname" placeholder="Enter New Name" minlength="6" name="uname" required>
    </div>
      </div>
    </div>
    <div class="row">
          <div class="col">
    <div class="form-group">
  <label for="ugender">Gender:</label>
  <select class="form-control ugender" id="ugender" name="ugender" required>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
</div>
      </div>
    </div>
        <div class="row">
  <div class="col">
      <div class="form-group">
      <label for="date_of_birth">Date Of Birth:</label>
      <input type="date" class="form-control bdate" name="ubdate" id="ubdate" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter date of birth">
    </div>
  </div>
</div>
    <button type="submit" class="btn btn-success btn-block" name="updateNurse">Update</button>
  </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<div class="modal" id="deleteModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete User Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

         <div class="form-group">
      <label for="dstaffid">Username</label>
      <input type="text" class="form-control dstaffid" id="dstaffid" placeholder="Enter Username" name="dstaffid" readonly>
    </div>
      </div>

      <!-- Modal footer -->
   <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-block" name="dltBtn">Delete</button>
      </div>
  </form>
    </div>
  </div>
</div>
<script>
  $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#bdate').attr('max', maxDate);
    $('#ubdate').attr('max', maxDate);
});

$('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    } );



  $('.editbtn').on('click',function(){
 $('#editModal').modal();

  $tr =$(this).closest('tr');

 var data = $tr.children("td").map(function(){
return $(this).text();
}).get();

console.log(data);

$('.uuid').val(data[0]);
$('.uname').val(data[1]);
$('.ugender').val(data[2]);
$('.ubdate').val(data[3]);
});
    $('.dltbtn').on('click',function(){
 $('#deleteModal').modal();

  $tr =$(this).closest('tr');

 var data = $tr.children("td").map(function(){
return $(this).text();
}).get();

console.log(data);

$('.dstaffid').val(data[0]);

});

$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
  </script>
</body>
</html>

