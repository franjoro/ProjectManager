<option value="0">*Proovedor generico</option>

<?php
require_once("../conexion.php");
$sql = "SELECT code, name FROM tb_providers WHERE code!= '0'";
$query = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($query)) {
?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php
}
mysqli_close($mysqli);
?>