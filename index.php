<?php include "inc/header.php"; ?>
<?php 
    spl_autoload_register(function($class_name){
        include("class/".$class_name.".php");
    });
    
    $user = new student();

    if (isset($_POST['create'])) {
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $address = $_POST['address'];


        $user->setName($name);
        $user->setEmail($email);
        $user->setAddress($address);


        if ($user->insert()) {
            echo "Data insert sucessful";
        }else{
            echo "Insert faild !!";
        }
    }

?>


<?php 
if (isset($_POST['update'])) {
        $id      = $_POST['id'];
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $address = $_POST['address'];

        $user->setName($name);
        $user->setEmail($email);
        $user->setAddress($address);


        if ($user->update($id)) {
            echo "Data Update sucessful";
        }else{
            echo "Update faild !!";
        }
    }

?>

<?php 
if (isset($_GET['action']) && $_GET['action']=='delete') {
        $id      = $_GET['id'];

        if ($user->delete($id)) {
            echo "Data Delete sucessful";
        }else{
            echo "Delete faild !!";
        }
    }
?>


<?php 
if (isset($_GET['action']) && $_GET['action']=='update') {
    $id = (int)$_GET['id'];
    $result = $user->readById($id);

?>
<!-- This section is for update  -->
<section class="mainleft">
    <form action="" method="post">
         <table>
            <input type="hidden" name="id" value="<?php echo $result['id']?>" />
            <tr>
               <td>Name: </td>
                <td><input type="text" name="name" value="<?php echo $result['name']?>" /></td>
            </tr>
            <tr>
               <td>Email: </td>
                <td><input type="text" name="email" value="<?php echo $result['email']?>"/></td>
            </tr>

            <tr>
              <td>Address: </td>
                <td><input type="text" name="address" value="<?php echo $result['address']?>" /></td>
            </tr>
            <tr>
              <td></td>
                <td>
                <input type="submit" name="update" value="Update"/>
                </td>
            </tr>
          </table>
    </form>
</section>

<?php
 } else {
?>

<!-- This section is for data insert  -->
<section class="mainleft">
    <form action="" method="post">
         <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name" required="1"/></td>    
            </tr>

            <tr>
               <td>Email: </td>
                <td><input type="text" name="email" /></td>
            </tr>

            <tr>
              <td>Address: </td>
                <td><input type="text" name="address" required="1"/></td>
            </tr>
            <tr>
              <td></td>
                <td>
                <input type="submit" name="create" value="Submit"/>
                <input type="reset" value="Clear"/>
                </td>
            </tr>
          </table>
    </form>
<?php 
    }
?>
</section>





<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Action</th>
    </tr>

<?php 
$i= 0;
    foreach ($user->readAll() as $key => $value) {
        $i++;
?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php echo $value['email'];?> </td>
        <td><?php echo $value['address'];?> </td>
        <td>
            <?php echo "<a href= 'index.php?action=update&id=".$value['id']."' onClick= 'return confirm(\"Do you want to Edit\")'> Edit</a>";?> ||
            <?php echo "<a href= 'index.php?action=delete&id=".$value['id']."' onClick= 'return confirm(\"Are you sure to delete this data\")'> Delete</a>";?>
        </td>
    </tr>
<?php }?>

  </table>
</section>










<?php include "inc/footer.php"; ?>