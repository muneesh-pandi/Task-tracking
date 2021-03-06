 <?php
session_start();
include_once("common/database.class.php");
include_once("common/common.class.php");
include_once("common/db_config.php");
include_once("common/globals.php");
$db=new database;
$error=$_REQUEST['msg'];
   $mid= $_SESSION['id'];
 
?>        

<!DOCTYPE html>
<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Task Management</title>

        <!-- Bootstrap -->
        <link href="dist/css/bootstrap.css" rel="stylesheet" media="screen" />
        <link href="assets/css/custom.css" rel="stylesheet" media="screen" />
        <link rel="stylesheet" href="tree-grid/css/jquery.treegrid.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- jQuery -->
        <script src="assets/js/jquery.v2.0.3.js"></script>
        <script type="text/javascript" src="tree-grid/js/jquery.treegrid.bootstrap3.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                $('.tree').treegrid();
                $('.tree-2').treegrid({
                    expanderExpandedClass: 'glyphicon glyphicon-minus',
                    expanderCollapsedClass: 'glyphicon glyphicon-plus'
                });

            });
        </script>
        <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        </head>

        <body id="top">

<!-- /.modal-dialog- addTask -->


                <div class="modal fade bs-example-modal-lg" id="add-Task" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                       <div class="modal-body">
                        <p>Loading...</p>
                      </div>
                     </div>
                    <!-- /.modal-content --> 
                  </div>
                  <!-- /.modal-dialog --> 
                </div>



 

<!-- /.modal-dialog- editTask -->
<div class="modal fade bs-example-modal-lg" id="edit-Task" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg">
    <div class="modal-content">
              <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Task</h4>
      </div>
              <div class="modal-body">
        <form class="form-horizontal">
                  <div class="form-group">
            <label class="control-label col-md-4">Date</label>
            <div class="col-md-6">
                      <div class="input-group date" id="datetimepicker6">
                <input class="form-control input-small input-inline" value="" type="text">
                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span> </div>
                    </div>
          </div>
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
                </form>
      </div>
              <div class="modal-footer">
        <button type="button" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
            </div>
    <!-- /.modal-content --> 
  </div>
          <!-- /.modal-dialog --> 
        </div>
<!-- CONTENT -->
<div class="container ">
<div class="container offset-0"> 
          
          <!-- CONTENT -->
          <div class="col-md-12  offset-0">
    <div class="  padding40">
              <div >
        <div> <span class=" size20 grey">Welcome to My Task Management </span>
                  <div class="line2"></div>
                </div>
        <div class="breadcrub offset-0 margtop20" >
                  <div> <a class="homebtn left" href="#"></a>
            <div class="left">
                      <ul class="bcrumbs">
                <li>/ </li>
                <li><a href="#" class="active">Task Management </a></li>
              </ul>
                    </div>
            <a class="backbtn right" href="#"></a> </div>
                  <div class="clearfix"></div>
                  <div class="brlines"></div>
                </div>
        <div class="panel panel-default  margtop40">
                  <div class="panel-heading"> <i class="fa fa-Taskpaper-o"></i> Task Management
            <div class="pull-right margbottom20" ><span title="Add News" data-toggle="tooltip" data-placement="top">
                    <a href="addtask-form.php" data-target="#add-Task" role="button" class="btn btn-primary  btn-xs" data-toggle="modal"><i class="fa fa-plus"></i></a></button>
                    </span> </div>
          </div>
                  <div class="panel-body">
 

            <div class="table-responsive" id="taskmsg">
                      <center><div id="successnews"></div></center>
                      <table   id="example"  class=" tree table table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%">
                <thead>
                          <tr>
                    <th>Title</th>
                    <th>Done</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                        </thead>
                <tbody>
                          <tr class="treegrid-1">
                    <td>Root node 1</td>
                    <td><input type="checkbox" class="form-control" /></td>
                    <td><span class="label label-success">Complete</span></td>
                    <td  width="5%" align="center"><span title="Edit Record" data-toggle="tooltip" data-placement="top"><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#edit-Task"><i class="fa fa-pencil"></i></a></span> </td>
                  </tr>
                          <tr class="treegrid-2 treegrid-parent-1">
                    <td>Node 1-1</td>
                    <td><input type="checkbox" class="form-control" /></td>
                    <td><span class="label label-primary" >Inprogress</span></td>
                    <td  width="5%" align="center"><span title="Edit Record" data-toggle="tooltip" data-placement="top"><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#edit-Task"><i class="fa fa-pencil"></i></a></span> </td>
                  </tr>
                          <tr class="treegrid-3 treegrid-parent-1">
                    <td>Node 1-2</td>
                    <td><input type="checkbox" class="form-control" /></td>
                    <td><span class="label label-primary">complete</span></td>
                    <td  width="5%" align="center"><span title="Edit Record" data-toggle="tooltip" data-placement="top"><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#edit-Task"><i class="fa fa-pencil"></i></a></span> </td>
                  </tr>
                          <tr class="treegrid-4 treegrid-parent-3">
                    <td>Node 1-2-1</td>
                    <td><input type="checkbox" class="form-control" /></td>
                    <td>In Progress</td>
                    <td  width="5%" align="center"><span title="Edit Record" data-toggle="tooltip" data-placement="top"><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#edit-Task"><i class="fa fa-pencil"></i></a></span> </td>
                  </tr>
                        </tbody>
              </table>
                    </div>
          </div>
                </div>
        <!--<div class="form-group" align="center">
    <button type="submit" class="selectbtn mt1 text-center"> Save Changes</button>

  </div>	--> 
        
      </div>
              <div class="clearfix"></div>
              <br />
              <br />
            </div>
    <!-- END CONTENT --> 
    
  </div>
        </div>
<!-- END OF CONTENT --> 

<!-- This page JS --> 
<script src="assets/js/js-index.js"></script> 
<script src="assets/js/js-dashboard.js"></script> 
<script type="text/javascript" src="dist/js/jquery.treegrid.js"></script> 

<!-- Custom Select --> 
<script type='text/javascript' src='assets/js/jquery.customSelect.js'></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="dist/js/bootstrap.min.js"></script> 

<!-- datatables --> 

<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable( {

    } );
} );

 </script> 
  <script>
  $(document).ready(function() {
	  
    $('#example').DataTable( {
"aaSorting": []
} );
	
  $('#addtask').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});

} );

</script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</body>
</html>
