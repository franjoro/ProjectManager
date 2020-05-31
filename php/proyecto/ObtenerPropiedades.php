<option disabled selected>Select Client</option>

<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql= "SELECT code, name FROM tb_propiedades WHERE owner='".$cliente."' ";
$query = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($query)) {
    ?>
    	<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
    <?php  
}
mysqli_close($mysqli);
?>