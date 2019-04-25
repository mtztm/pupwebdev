<button id="btn-notif" class="btn-hide" data-toggle="modal" data-target="#NotifModal" 	>Select</button>
	
<style type="text/css">
	.btn-hide{
		display: none;
	}
	.modal-body{
	  padding: 4px;
	}
    .modaladjust
    {
      margin-top: 100px;
    }
    .modal
    {
    	overflow-y: auto;
    }
    @page{
      size: 8.5in 11in;
    }


  	@media print {
		body * {
		  visibility: hidden;
		}
		#printArea * {
		  visibility: visible;
		  width:100%; 
		  height:100%;
		  page-break-after:always;
		  margin-left: auto;
		  margin-right: auto;
		  display: block;
		}
		#printArea {
		  position: absolute;
		;
		}
		#printArea button{
		  visibility: hidden;
		}

		.modal-backdrop {
			z-index: 1050;
		}



}
</style>
<script src="\pupwebdev\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script>
<div class="modal fade modaladjust" id="NotifModal"> 
			<div class="modal-dialog">
				<div class="modal-content">
				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="col-12 modal-title text-center" id="sample">You have a new Transaction!</h4>
				  </div>
				</div>
			</div>
</div>
<!-- data-toggle="modal" data-target="#NotifModal" -->
<!-- onclick="openModal()"				 -->
						
<nav class="navbar navbar-light">
  <div class="queue">
    <div class="queue-status" id = "qNum">
      <!-- <h4>Queue Number</h4>
      <span class="queue-number" id="qNum">0001</span>
      <div class="queue-requestbutton">
        <span id="transaction">Transaction</span>
        <button type="button" class="btn btn-sm btn-warning" id="brkBtn">Break</button>
        <button type="button" class="btn btn-sm btn-warning" id="nxtBtn">Next</button> -->
      </div>
    </div>
  <!-- </div> -->

  <?php
  //mitzie nag eeror to kaya kinomment namin
	//$prevlastqueue = include 'CheckLastTransaction.php';
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $pageOn = explode('/pupwebdev/auth/schoolAdmin/', $path);
    $activenav = isset($pageOn[1]) ? $pageOn[1] : null;
  ?>
<div class="dashboard-menu" style=" height: 250px; overflow-y:scroll;" >
    <h6>Dashboard</h6>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='index.php' || $activenav=='') {echo 'active';} ?>" href="index.php"><i class="fas fa-home icon"></i>Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='inventory.php') {echo 'active';} ?>" href="inventory.php"><i class="fas fa-window-restore icon"></i>Items</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='inventory_2.php') {echo 'active';} ?>" href="inventory_2.php"><i class="fas fa-window-restore icon"></i>Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='borrowing.php') {echo 'active';} ?>" href="borrowing.php"><i class="fas fa-dolly-flatbed icon"></i>Borrowing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='schoolAdministrator_Reservation.php') {echo 'active';} ?>" href="schoolAdministrator_Reservation.php"><i class="fas fa-calendar-alt icon"></i>Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='pending.php') {echo 'active';} ?>" href="pending.php"><i class="fas fa-clock icon"></i>Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='staff.php') {echo 'active';} ?>" href="staff.php"><i class="fas fa-user-friends icon"></i>Staff</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='queuePerOffice.php') {echo 'active';} ?>" href="queuePerOffice.php"><i class="fas fa-user-friends icon"></i>Queue Per Office</a>
      </li>
    </ul>
  </div>
</nav>

<script type="text/javascript">
		
		
	$(document).ready(function(){
		var profcount =  0;
		var qCount =  0;
    var breakCount = 1;
		
		$("#nxtBtn").click(function(){

      alert("aaaaaa");
			profcount = profcount + 1;
			qCount = qCount + 1;
			$.ajax({
				url:"queueTable.php",
				method:"POST",
				data:{queueNewCount: qCount},
			});
      $("#qNum").load("loaddb.php", {profNewCount: profcount});
		});
    $("#brkBtn").click(function(){
			$.ajax({
				url:"breakButton.php",
				method:"POST",
				data:{breakNewCount: breakCount},
			});
      $("#qNum").load("loaddb.php", {breakNewCount: breakCount});
		});
    setInterval(function(){
			$('#qNum').load("loaddb.php");
		}, 4000);
		
	});
</script>
<audio id="soundHandle" style="display: none;"></audio>
<script>
  soundHandle = document.getElementById('soundHandle');
  soundHandle.src = '/pupwebdev/auth/student/sound/dingdong.mp3';
</script>