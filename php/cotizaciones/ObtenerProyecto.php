<option disabled selected value="x">Seleccionar proyecto</option>
<option value="0">*Nuevo Proyecto</option>

<?php
require_once("../conexion.php");
$sql = "SELECT code, name FROM tb_proyectos";
$query = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($query)) {
?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php
}
mysqli_close($mysqli);
?>