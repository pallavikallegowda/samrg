<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account</title>
</head>
<body>
     <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Reports</th>
                    <th>Information Gathering</th>
                    <th>Report Build</th>
     <!--           <th>Design</th> -->
                    <th>Review</th>
                    <th>Approval</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                        $sql1 = "select * from report";
                        $result1 = $conn->query($sql1);
                        if ($result1 ->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
									echo '<tr><td class="report-title">'.$row1['title'].'</td>';
									$report_id=$row1['report_id'];
                                    include 'automation_db_connect.php' ; 
                                    $deadline_query="select u.role,ur.deadline from user_report ur, user u where u.user_id=ur.user_id and ur.report_id=".$report_id." ;";
                                    $all_deadline = $conn->query($deadline_query);
                                    if(!$all_deadline){
                                        echo $conn->error;
                                    }
                                    else if($all_deadline->num_rows > 0){
                                        
                                        
                                        
                                        
                                         while($deadline = $all_deadline->fetch_assoc()){
                                            
                                            if($deadline['role'] == "Analyst"){
												$analyst_remaining_days=0;
												$analyst_deadline_reached=false;
                                                $analyst_deadline=date('d-m-Y',strtotime($deadline['deadline']));
                                                $analyst_remaining_days=round((strtotime($deadline['deadline'])-time())/(60 * 60 * 24));
                                                if($analyst_remaining_days <= 0){
                                                    $analyst_deadline_reached=true;
                                                }
                                            }
                                            if($deadline['role'] == "Reviewer" ){
												$reviewer_remaining_days=0;
												$reviewer_deadline_reached=false;
                                                $reviewer_deadline=date('d-m-Y',strtotime($deadline['deadline']));
                                                $reviewer_remaining_days=round((strtotime($deadline['deadline'])-time())/(60 * 60 * 24));
                                                if($reviewer_remaining_days <= 0){
                                                    $reviewer_deadline_reached=true;
                                                }
                                            }
                                         }
                                    }
                                    if($analyst_deadline_reached){
                                      echo '<td><div class="red"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline was on '.$analyst_deadline.'">Crossed Deadline</p></td>';   
                                    }
                                    else{
										echo '<td>';
										if($row1['state_info_gathering']==='finished')
											{echo '<a href=""><div class="green"></div></a>';}
										else if($row1['state_info_gathering'] === 'started')
											{echo '<div class="yellow"></div>';}
										else{echo '<div class="gray"></div>';}
										echo '</td>';
                                    }
                                    if($analyst_deadline_reached){
                                      echo '<td><div class="red"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline was on '.$analyst_deadline.'">Crossed Deadline</p></td>';   
                                    }
                                    else{
										echo '<td>';
                                      	if($row1['state_report_building']==='finished')
                                          	{echo '<a href=""><div class="green"></div></a><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline was '.$analyst_deadline.'">Work completed</p>';}
                                      	else if($row1['state_report_building']==='started')
                                          	{echo '<a href="report_details.php?report_id='.$row1['report_id'].'"><div class="yellow"></div></a><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline is '.$analyst_deadline.'">'.$analyst_remaining_days.' days for completion</p>';}
										else{echo '<div class="gray"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Should be completed within '.$analyst_deadline.'">ETA '.$analyst_remaining_days.' days</p>';}
										echo '</td>';
									}
                                
                               /*      if($row1['state_design']==='finished')
                                    {echo '<td><div class="green"></div></td>';}
                                    else if($row1['state_design']==='started')
                                    {echo '<td><div class="yellow"></div></td>';}
                                    else{echo '<td><div class="gray"></div></td>';}
                                */	 if($reviewer_deadline_reached){
									echo '<td><div class="red"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline was on '.$reviewer_deadline.'">Crossed Deadline</p></td>';   
									}	
									else{
										echo '<td>';
										if($row1['state_review']==='finished')
											{echo '<div class="green"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline was '.$reviewer_deadline.'">Work completed</p>';}
										else if($row1['state_review']==='started')
											{echo '<div class="yellow"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Deadline is '.$reviewer_deadline.'">'.$reviewer_remaining_days.' days for completion</p>';}
										else{echo '<div class="gray"></div><p class="remaining_days" data-toggle="tooltip" data-html="true" data-placement="left" title="Should be completed within <br> '.$reviewer_deadline.'">ETA '.$reviewer_remaining_days.' days</p>';}
										echo '</td>';
									}
                                    if($row1['state_approval']==='finished')
                                    {echo '<td><div class="green"></div></td>';}
                                    else if($row1['state_approval']==='started')
                                    {echo '<td><div class="yellow"></div></td>';}
                                    else{echo '<td><div class="gray"></div></td>';}
                         
                                if($row1['state_review']==='finished'){
                                    echo "<td><a href='#' class='btn btn-primary'>approve</a></td>";
                                }
                              else{
                               	 echo "<td>";
                               	 if($row1['state_info_gathering']==='finished'){
                               	     echo "<button class='btn btn-primary clear-report' id='".$row1['report_id']."' data-toggle='modal' data-target='#myModal'>Clear Report Data</button>";
                               	 }
                                else{
                                    echo "Information not yet gathered";
                                }
                                echo "</td>";
				}
			echo "</tr>";

                    }} ?>
                <link rel="stylesheet" type="text/css" href="style.css"> 
                </tbody>
            </table>
    </div>
    <hr/>
    <div class="container-fluid"><a href='add-report.php' class='btn btn-primary float-right'>Add Report</a><a href='register-user.php' class='btn btn-primary float-right mr-3'>Add User</a></div>
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
         <button type="button" class="delete btn btn-danger" data-dismiss="modal">Clear</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
    $('.clear-report').click(function(){
       var title=$(this).parent().parent().children('.report-title').text();
        var id= $(this).attr('id');
        $('.delete').attr('id','del'+id);
        $('.modal-body').html("You are about to clear all the data regarding to the report: <br> "+title+". <br> Are you sure you want to clear?");
        $('.delete').html('Clear');
    });
    $('.delete').click(function(){
        var clear_button=$(this);
        $(this).attr("disabled",true);
        $(this).next().attr("disabled",true);
        var del_id=$(this).attr('id');
        var id = del_id.substring(3,);
        $(this).html('<span class="spinner-border spinner-border-sm mr-2"></span>Clearing..');
        $.post('delete-report.php',{
            report_id:""+id+"",
        },function(data){
            clear_button.html('Done');
            window.location.reload();
        });
    });
});
    
</script>
    </body>
    
</html>
