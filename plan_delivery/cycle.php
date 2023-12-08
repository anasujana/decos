<?php
    include('../koneksi/koneksi.php');

    $id_cs = $_GET["cs"];
    echo "<option value=''>-- Pilih Cycle --</option>";
    $cst = mysqli_query($conn,"SELECT * FROM cycle_deliv where customer_id='$id_cs' AND status='aktif'");
    foreach ($cst AS $data){
        $id = $data["id"];
        $cycle = $data["no_ct"];
        $jam = $data["waktu"];
        ?>
            <option value="<?php echo $id; ?>"><?php echo $cycle ; ?></option>
        <?php
    }
?>