<option disabled selected>Select Client</option>

<?php
require_once("../conexion.php");
$sql= "SELECT code, name FROM tb_clientes WHERE code !='0' ";
$query = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($query)) {
    ?>
    	<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
    <?php  
}
mysqli_close($mysqli);
?>