<?php
//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

//Instanciate DB class
$dbc = new DBController();

//App Class
require './models/Users.php';

//Instatnciate app class
$app = new Users();

$roleid = $_SESSION['role'];


?>


<div class="container">

        <?php
            if(isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <br/>   

        <h1>
            <span>Users List</span>
            <?php 
                if($roleid != 2) { 
                    echo '<a href="./index.php?dan=adduser"><button class="btn btn-secondary btn-space float-end me-2">Add user</button></a>
                    <a href="./index.php?dan=resetuserpwd"><button class="btn btn-secondary float-end me-2">Reset user password</button></a>';
                } 
             ?>
        </h1>

        <hr/>

       <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $resultReq = $app->userList($dbc);
                    if($resultReq) {
                        echo '<tr>';   
                        foreach($resultReq as $key => $val) {    
                            echo '<td><img src="./uploads/'.$val['picture'].'" width="50" height="50" /></td>
                            <td>'.$val['fullname'].'</td>
                            <td>'.$val['email'].'</td>
                            <td>'.$val['phone'].'</td>
                            <td>'.$val['active'].'</td>
                            <td>'.$val['role'].'</td>';
                        echo '<td>
                                  <a href="#exampleModal" class="btn btn-primary me-2" data-bs-toggle="modal" data-id="'.$val['idusr'].'">Edit</a>';
                                  if($roleid != 2) {
                                    echo '<a type="button" class="btn btn-danger me-2" href="./actions/deleteuserAction.php?ID='.$val['idusr'].'" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
                                  }
                               echo '</td>
                             </tr>';
                        }
                    }
                ?>
            
    
            </tbody>
            <tfoot>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

    
    <!--  Modal edit Form  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="row g-3" action="./actions/edituserAction.php" method="post" enctype= multipart/form-data>

                       <div class="fetched-data"></div>

                       <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- END Modal edit Form  -->


</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

<!-- Data table JS script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<!-- Modal fetch data JS script -->
<script type="text/javascript">
   $(document).ready(function(){
    $('#exampleModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : './actions/userInfo.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>

<script type="text/javascript">
   function Confirm()
   {
        let conf = confirm('Are you sure you want to delete this user?');
        if (conf)
            return false;
        else
            return true;
   }
</script>