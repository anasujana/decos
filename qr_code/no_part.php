<?php
    include('../koneksi/koneksi.php');

    $line = $_GET["line"];
    echo "<option value=''>-- pilih part number --</option>";
    $part_no = mysqli_query($conn,"SELECT lp.part_no, lp.part_name FROM part_prod pp inner join list_part lp
                                                              on pp.part_no=lp.part_no
                                                where pp.id_line='$line' and lp.qty_box!=0 and status = 'aktif' order by lp.part_no asc");
    foreach ($part_no AS $data){
        $part_list = $data["part_no"];
        $part_name = $data["part_name"];
        ?>
            <option value="<?php echo $part_list; ?>"><?php echo $part_list." == ".$part_name; ?></option>
        <?php
    }
?>