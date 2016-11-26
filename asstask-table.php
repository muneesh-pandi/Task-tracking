 <?php
include_once("common/database.class.php");
include_once("common/common.class.php");
include_once("common/db_config.php");
include_once("common/globals.php");
$db=new database;
 
?>        
        <table cellspacing="0" width="100%" id="example-news"   class="table table-striped table-hover table-responsive table-bordered ">

              <thead>
                <tr>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                     
							 $mid= $_SESSION['id'];

							
							  $str="select * from category where galleryid='$mid' order by STR_TO_DATE(postdate, '%d/%m/%y') desc";
							$res=$db->get_rsltset($str);
		for($n=0;$n<count($res);$n++)
		{
		$eid=$res[$n]['categoryid'];
	 	$title=$res[$n]['categoryname'];
		$desc=$res[$n]['description'];
		$desc1=substr($desc,0,200);
		$desc=substr($desc,0,1513);
		$pic=$res[$n]['catepic'];
		$ndate=$res[$n]['postdate'];
		if($pic!="")
			$picture='<img src="upload/'.$pic.'" alt=""  width="60" height="60"   class="contentimg fltlft" >';
		else
			$picture='';
		$website=$res[$n]['url'];
		if($website!="")
		{
			$web=$website;
			$blank='target="_blank"';
		}
	 


									
                      ?>
                <tr id="<?= $eid; ?>">
                <input type='hidden' name='caid' value='<?= $eid; ?>' />
                  <td width="10%"><?= $ndate; ?></td>
                  <td><?= $title; ?></td>
                  <td><?= $desc; ?></td>
                   <td  width="10%">
                   
                   <span title="Edit Record" data-toggle="tooltip" data-placement="top">  <a href="editnews-form.php?cid=<?= $eid; ?>" data-target="#edit-news" role="button" class="btn btn-default  btn-xs" data-toggle="modal"><i class="fa fa-pencil"></i></a>
  </span>
                   
                    <span title="Delete Record" data-toggle="tooltip" data-placement="top"><a href="deletenews-confirm.php?cid=<?= $eid; ?>" data-target="#delete-news" role="button" class="btn btn-default  btn-xs" data-toggle="modal"><i class="fa fa-trash"></i> </a> </span></td>
                </tr>
                               
           <?php } ?>     


              </tbody>
            </table>
 <script>
  $(document).ready(function() {
	  
    $('#example-news').DataTable( {
"aaSorting": []
} );
	
  $('#addnews').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});

} );

</script>
  
  