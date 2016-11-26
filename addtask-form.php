                  <?php
include_once("common/database.class.php");
include_once("common/common.class.php");
include_once("common/db_config.php");
include_once("common/globals.php");
$db=new database;
$error=$_REQUEST['msg'];
   $mid= $_SESSION['id'];
 
?><style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#addtaskform .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Task</h4>
                </div>
                <div class="modal-body">
         <form class="form-horizontal addtaskform" id="addtaskform" name="addtaskform"  method="POST">
                    <div class="form-group">
            <label class="control-label col-md-4"> Title<span class="red">*</span></label>
            <div class="col-md-6">
                      <input type"text" name="title" class="form-control" />
                    </div>
          </div>
                  <div class="form-group">
            <label class="control-label col-md-4"> Parent id<span class="red">*</span></label>
            <div class="col-md-6">
                      <select class="form-control customSelect">
                <option>Default Top</option>
                <option>taskA</option>
                <option>task B</option>
              </select>
                    </div>
          </div>
                                <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="update-btn"  id="submittaskbtn" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        </form>
 </div>
 
                <script type="text/javascript">
   $(document).ready(function() {
	 
	 
     $('#addtaskform')
        .formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
             fields: {
 				
                   
            task_title: {
                validators: {
                    notEmpty: {
                        message: 'The task title is required and can\'t be empty'
                    }
                }
            },
			 task_desc: {
                validators: {
                    notEmpty: {
                        message: 'The description is required and can\'t be empty'
                    }
                }
            },
			 task_date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required and can\'t be empty'
                    }
                }
            } 
            }
        })
		
		 .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

         var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
				
 				
				
             $.ajax({
                url: 'addtask-action.php',
				data:  $form.serialize(),
                cache: false,
                type: 'POST',
				beforeSend: function()
			{	
 				$("#submittaskbtn").html('<img src="images/btn-ajax-loader.gif" width="31" height="31" alt=""/> &nbsp; Loading ...');
			},
                success: function(result) {
					
					   $("#successtask").html('<div class="alert alert-success"><button type="button" class="close">×</button>Success! task has been added. </div>');
          window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3000);
                    $("#taskmsg").delay(1000).fadeIn('slow', function(){
					 
  			     $("#taskmsg").html(result);
				 
 		        	$("#add-task").modal('hide');
					 
					$("#addtaskform")[0].reset();
				 
 				 }); // reset submit button text.
                }
				
            });
         });
		
     
}); 
</script>
 
