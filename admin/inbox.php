<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>



   
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>

      <?php 
       $seenmsg = mysqli_real_escape_string( $db->link, $_GET['seenmsg']);

        if(isset($seenmsg)){

          $seenid = $seenmsg;

          $sql = "UPDATE tbl_contact SET status ='1' WHERE id='$seenid'  ";
          $getmessage = $db->update($sql);

          if($getmessage){
          	echo "<span class='success'>Message Sent in the Seen Box !</span>";
          }else{
          	echo "<span class='error'>Something Went Wrong!</span>";
          }

    }

    ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
			   $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";

			   $msg = $db->select($query);

			   if($msg){
			   	$i = 0;

			   	   while($result = $msg->fetch_assoc()){
                       
                       $i++;


			?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textshorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							
							<td>
							    <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>||
								<a href="replymsg.php?replyid=<?php echo $result['id']; ?>">Reply</a> ||
								<a href="?seenmsg=<?php echo $result['id']; ?>">Seen</a>
						    </td>
						</tr>

					<?php  } } ?>
						
					</tbody>
				</table>
               </div>
            </div>




             <div class="box round first grid">
                <h2>Seen Message</h2>

                 <?php
                   if(isset($_GET['delmsgid'])){
                   	 $del_id = $_GET['delmsgid'];
                   	 $del_query = "DELETE FROM tbl_contact WHERE id='$del_id' ";

                   	 $del_cat = $db->delete($del_query);

                   	 if($del_cat){
                   	 	echo "<span class='success'>Message Deleted Successfully !</span>";
                   	 }else{
                   	 	echo "<span class='error'>Something Went Wrong!</span>";
                   	 }
                   }
                ?>


                <div class="block">        
                   <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
			   $query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";

			   $msg = $db->select($query);

			   if($msg){
			   	$i = 0;

			   	   while($result = $msg->fetch_assoc()){
                       
                       $i++;


			?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textshorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>||
							    <a  onclick="return confirm('Are You Sure To Delete!');" href="?delmsgid=<?php echo $result['id']; ?>">Delete</a>
								
						    </td>
						</tr>

					<?php  } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?> 


