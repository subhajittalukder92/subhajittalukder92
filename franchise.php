<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
include "functions.php";

$states = getStates("35"); 
$districts = getDistrictsByStateId("35"); 
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql		="SELECT * FROM `courses`
				";
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td style="text-align:center;">'.++$no.'</td>
				<td style="text-align:center;">'.$row['course_id'].'</td>
				<td style="text-align:center;">'.$row['course_name'].'</td>
				<td style="text-align:center;">'.$row['description'].'</td>
				<td style="text-align:center;">'.sprintf('%0' . 3 . 's', $row['course_id']).'</td>
				<td style="text-align:center;">'.$row['duration'].'</td>
				<td style="text-align:center;">'.$row['course_fee'].'</td>
				<td style="text-align:center;">'.$row['fee_type'].'</td>
			</tr>' ;
	}
}

?>
<?php include "include/menu.php";?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Franchise Setting</h3>
			  <button id="addMember" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add New</button><br/>
			  <p>&nbsp;</p>
			  <div class="clearfix"></div>
			  <div class="table-responsive">
					<table id="example" class="table table-stripped table-condensed">
						<thead>
							<th >SL NO			        </th>
							<th >Franchise Name	</th>
							<th >Director Name	</th>
							<th >Code	</th>
							<th >Aaddress	</th>
							<th >Contact	</th>
							<th >User Id			</th>
							<th >Password			</th>
							<th >Action			</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
		
		  		<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
	  <!-- Modal-->
	  
			</div>
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Franchise</h4>
          </div>
		  <form method="post" id="createForm" class="form-horizontal" action="franchiseCreate.php" autocomplete="off">
          <div class="modal-body">
		  <div class="messages"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">Franchise Name</label>
					<div class="col-sm-6">
						<input type="text" name="franchiseName" id="franchiseName" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Franchise Code</label>
					<div class="col-sm-6">
						<input type="text" name="franchiseCode" id="franchiseCode" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Director Name</label>
					<div class="col-sm-6">
						<input type="text" name="director" id="director" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Contact</label>
					<div class="col-sm-6">
						<input type="text" name="contact" id="contact" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Address</label>
					<div class="col-sm-6">
						<input type="text" name="address" id="address" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">State</label>
					<div class="col-sm-6">
						<select name="state" id="state" class="form-control" requiured>
							<option value="">Select State</option>
							<?php 
							
							if(count($states) > 0){
								foreach ($states as $key => $state) {
									echo '<option value="'.$state['id'].'">'.$state['state'].'</option>';
								}
								
							}
							
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">District</label>
					<div class="col-sm-6">
						<select name="district" id="district" class="form-control" requiured>
							<option value="">Select District</option>
							<?php 
							
							if(count($districts) > 0){
								foreach ($districts as $key => $district) {
									echo '<option value="'.$district['id'].'">'.$district['district_name'].'</option>';
								}
								
							}
							
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">User Name</label>
					 <div class="col-sm-6">
						<input type="text" name="userName" id="userName" class="form-control" required>

					</div>
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">Password</label>
					 <div class="col-sm-6">
						<input type="text" name="password" id="password" class="form-control" required>
					</div>
				</div>
			
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" id="modalSave"  class="btn btn-primary antosubmit">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
	  
    </div>
	<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Franchise</h4>
          </div>
		  <form method="post" id="updateMemberForm" class="form-horizontal" action="updateFranchise.php">
          <div class="modal-body">
		  <div class="editMessage"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">Franchise Name</label>
					<div class="col-sm-6">
						<input type="text" name="editName" id="editName" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Franchise Code</label>
					<div class="col-sm-6">
						<input type="text" name="editCode" id="editCode" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Director Name</label>
					<div class="col-sm-6">
						<input type="text" name="editDirector" id="editDirector" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Contact</label>
					<div class="col-sm-6">
						<input type="text" name="editContact" id="editContact" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Address</label>
					<div class="col-sm-6">
						<input type="text" name="editAddress" id="editAddress" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">State</label>
					<div class="col-sm-6">
						<select name="editState" id="editState" class="form-control" requiured>
							<option value="">Select State</option>
							<?php 
							
							if(count($states) > 0){
								foreach ($states as $key => $state) {
									echo '<option value="'.$state['id'].'">'.$state['state'].'</option>';
								}
								
							}
							
							?>
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">District</label>
					<div class="col-sm-6">
						<select name="editDistrict" id="editDistrict" class="form-control" requiured>
							<option value="">Select District</option>
							<?php 
							
							if(count($districts) > 0){
								foreach ($districts as $key => $district) {
									echo '<option value="'.$district['id'].'">'.$district['district_name'].'</option>';
								}
								
							}
							
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">User Name</label>
					 <div class="col-sm-6">
						<input type="text" name="editUserName" id="editUserName" class="form-control" required>
						<input type="hidden" name="editUserId" id="editUserId" class="form-control">
						<input type="hidden" name="editMemberId" id="editMemberId" class="form-control">
					</div>
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">Password</label>
					 <div class="col-sm-6">
						<input type="text" name="editPassword" id="editPassword" class="form-control" required>
					</div>
				</div>
				
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" id="modalSave"  class="btn btn-primary antosubmit">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
	  
    </div>
		<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
		  <div class="modal-dialog" role="document">
		  <div class="modal-content">
		  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title"><i class="fa fa-warning"></i> Warning</h4>
		  </div>
		  <div class="modal-body">
		  <font color="red">Do You Really Want To Remove This Info?</font>
		  </div>
		  <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  <button type="button" class="btn btn-danger" id="removeBtn" name="removeBtn">Yes</button>
		  </div>
		  </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
	</div>
		</div>
	</div>
</div>
</div>
	    <!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
</script>
<!--MultiSelect -->
<script type="text/javascript" src="docs/js/prettify.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	var table= $('#example').DataTable({
		"ajax":"retrieveFranchise.php",
		"paging":false,
		"order":[]
		});
	$(document).ready(function() {
		
		
		$('#addMember').on('click',function(){
			$('.messages').html("");
			$('#createForm')[0].reset();
			$('#updateMemberForm')[0].reset();
		});
		$('#sessionCode').on('focus',function(){
			 $.ajax({
				url: "getSessionCode.php",
				type: "POST",
				success:function(response)
				{
					$('#sessionCode').val(response) ;
				}
			});
		});
		
		 
		$('#createForm').unbind('submit').bind('submit',function(e){
			     
		var form	  = $(this);
		       $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType : 'json',
                    success:function(response) {
 
                        // remove the error 
                        $(".form-group").removeClass('has-error').removeClass('has-success');
 
                        if(response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
 
                            // reset the form
                            $("#createForm")[0].reset();      
 
                            // reload the datatables
                            table.ajax.reload(null, false);
                            // this function is built in function of datatables;
                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                        } // /else
                    } // success 
                });
		

		return false;
		
	});
	});

function editMember(id = null) 
{

$('#editMessage').html("");
    if(id) {
	$('.editMessage').html("");
        $.ajax({
            url: 'getSelectedFranchise.php',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
                $("#editUserId").val(response.description);
                $("#editName").val(response.franchise_name);
                $("#editCode").val(response.code);
                $("#editUserName").val(response.user_name);
                $("#editDirector").val(response.director_name);
                $("#editState").val(response.state_id);
                $("#editDistrict").val(response.district_id);
                $("#editUserId").val(response.user_id);
                $("#editAddress").val(response.address);
                $("#editContact").val(response.contact);
                $("#editMemberId").val(response.member_id);
                $("#editPassword").val(response.password);
               
                $("#updateMemberForm").unbind('submit').bind('submit', function() {
                 
                    var form = $(this);
					   $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response)
							{
                                if(response.success == true) {
                                    $(".editMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');
 
                                   
                                    table.ajax.reload(null, false);
                                  
 
                                } else {
                                    $(".editMessage").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                    '</div>')
                                }
                            } // /success
                        }); // /ajax
                  
 
                    return false;
                });
 
            } 
        }); 
 
    } else {
        alert("Error : Refresh the page again");
    }
}
function removeMember(id=null)
{
	if(id)
	{
		$('#removeBtn').unbind('click').bind('click',function()
		{

			 $.ajax({
                url: 'removeFranchise.php',
                type: 'post',
                data: {member_id : id},
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {                      
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
 
                        // refresh the table
                        table.ajax.reload(null, false);
 
                        // close the modal
                        $("#removeMemberModal").modal('hide');
 
                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }
            }); 
			
		});
	}
	
}
	
</script>
</body>
</html>
