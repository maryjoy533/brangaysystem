

<style>
#name {
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    outline:none;
    box-shadow:none;	
}



</style>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-bullhorn" aria-hidden="true"></i> formo8
        <small>Control panel</small>
      </h1>
    </section>
  
	<section>
	<div class="row">
		<div class="col-md-8" style="margin-left:50px; margin-top:20px">
			<div class="box box-primary">
		<center>
		<h3 class="box-title" >COMPLAINT FORM</h3></center>
			<!-- form start -->
			<?php $this->load->helper("form"); ?>
			<form role="form"  action="<?php echo base_url() ?>" method="post" role="form">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">                           
							<div class="form-group">
								<label for="autouser">Complainants</label>
								<input type="text" class="form-control required" id="autouser">
							</div>
						</div>
							<div class="col-md-6">                           
								<div class="form-group">
									<label for="res_Fname">Respondents</label>
									<input type="text" class="form-control required">
								</div>
							</div>
					</div> 

					<div class="row">
						<div class="col-md-6" >   
							<div class="form-group">
								<label for="autouser">Complainants address</label>
								<input type="text" class="form-control required" id="userid"  >
							</div>
						</div> 
						<div class="col-md-6">  
							<div class="form-group">
								<label for="autouser">Respondents address</label>
								<input type="text" class="form-control required" id="userid"  >
							</div>
						</div>
					</div>
						
						<div class="row">
							<div  class="col-md-12" style="margin-top:5%;">
								<div class="form-group">
									<label for="res_Fname">the following relief/s be granted to me/us in accordance with law
										and/or equity:
									</label>
									<textarea class="form-control" rows="5" id="comment"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control required" id="SMS_Keyword_ID" name="Keyword_desc">
										<option value="-1">Select category</option>
										<?php
										if(!empty($sms_keyword))
										{
											foreach ($sms_keyword as $keyword)
											{
												?>
												<option value="<?php echo $keyword->SMS_Keyword_ID ?>" <?php if($keyword->SMS_Keyword_ID == set_value('Keyword_desc')) {echo "selected=selected";} ?>><?php echo $keyword->Keyword_desc ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>	
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control required" id="inCharge_ID" name="inCharge_person">
										<option value="0">Select incharge</option>
										<?php
										if(!empty($incharge))
										{
											foreach ($incharge as $the_incharge)
											{
												?>
												<option value="<?php echo $the_incharge->inCharge_ID; ?>" 
												<?php if($the_incharge->inCharge_ID == set_value('inCharge_person')) {echo "selected=selected";} ?>>
												<?php echo $the_incharge->inCharge_person;?>
												</option>

												<?php
											}
										}
										?>
									</select>
								</div>	
							</div>
						</div>
							 
						<div class="row">
							<div class="col-md-3" style="padding-top:30px;">
								<div class="form-group">
									<label for="name" class="control-label">Made this day of:</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6" style="padding-top:29px;">
										<p id="demo"></p>									
							   </div>
							</div>
						</div>
						<div class="row">
							<div class="form-group" >
								<div class="col-md-3" style="float: right;">
									<input type="reset" class="btn btn-default" value="Reset" />
									<input type="submit" class="btn btn-primary" value="Submit" />
								</div>
							</div>
						</div>														
				</div><!-- /.box-body -->					
			</form>
		</div>
	</div>
	<div class="col-md-3" style="margin-left:10px; margin-top:20px"> 
		<div class="box box-primary">
		<center><h3 class="box-title">Forms</h3></center>
			<div class="box-body">

				<div class="row">
					<div class="col-md-12">
						<center><a style="margin-top:40px ;" class="btn btn-primary" href="form" role="button">Appointment Form</a></center>
						
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<center><a style="margin-top:40px ;" class="btn btn-primary" href="form" role="button">Appointment Form</a></center>
						
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<center><a style="margin-top:40px ;" class="btn btn-primary" href="form" role="button">Appointment Form</a></center>
						
					</div>
				</div>	

				<div class="row">
					<div class="col-md-12">
						<center><a style="margin-top:40px ;" class="btn btn-primary" href="form" role="button">Appointment Form</a></center>
						
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<center><a style="margin-top:40px ;" class="btn btn-primary" href="form" role="button">Appointment Form</a></center>
						
					</div>
				</div>
				
			</div>
		</div>
			<!-- form start -->
	</div>
</div>
</section> 
  
	
</div>

<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type='text/javascript'>
	var x = Date()
    $(document).ready(function(){

     // Initialize 
     $( "#autouser" ).autocomplete({

        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>index.php/Sms/residentlist",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });																																																																																																																																																																																																								
        },

		
        select: function (event, ui) {
          // Set selection
          $('#autouser').val(ui.item.label); 
		  $('#userid').val(ui.item.address);// display the selected text
          return false;
        }
		
      });
	  

    });
    </script>
<script type='text/javascript'>
var d = new Date();
document.getElementById("demo").innerHTML = d;
</script>