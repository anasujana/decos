<?php
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
$plan_deliv = mysqli_query($conn, "SELECT pd.part_no, 
                                                lp.part_name,
                                                COALESCE(s.stock_in, 0) AS stock_in,
                                                s.stock_out,
                                                s.id_stock,
                                                s.tgl,
                                                ar.nama_area,
                                                ks.jenis_stock
                                        FROM part_prod pd
                                        LEFT JOIN list_part lp ON lp.part_no = pd.part_no
                                        LEFT JOIN stock s ON pd.part_no = s.part_no AND s.tgl = '$now_date' AND s.kategori = '$_GET[kategori]'
                                        LEFT JOIN kategori_stock ks ON ks.id = s.kategori
                                        LEFT JOIN area ar ON ar.id = pd.id_area");


$no = 1;

foreach ($plan_deliv as $data1) {
    $nama_area = $data1['nama_area'];
    $part_no = $data1['part_no'];
    $part_name = $data1['part_name'];
    $prod = $data1['stock_in'];
    $stock_out = $data1['stock_out'];
    $part_asal = $data1['jenis_stock'];
    $id_stock = $data1['id_stock'];
    $tgl = $data1['tgl'];

    $a[$row][0] = $no;
    $a[$row][1] = $nama_area;
    $a[$row][2] = $part_no;
    $a[$row][3] = $part_name;
    if ($_GET['kategori'] == 1) {
        $a[$row][4] = $prod;
    } else {
        $a[$row][4] = $stock_out;
    }
    $a[$row][5] = "<button type='button' class='btn btn-icon btn-danger btn-circle btn-sm edit_in' data-toggle='modal' 
    data-tglin='$tgl' data-stockid='$id_stock' data-partno='$part_no' data-partname='$part_name' data-target='#editOjIn'> 
    <i class='ti-minus'></i>
    </button>";
    $row++;
    $no++;
}

$data = array(
    'data' => $a
);
echo json_encode($data);
