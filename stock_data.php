<?php
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
$stock_data = mysqli_query($conn, "SELECT cs.customer, 
                                            pp.part_no,
                                            ar.nama_area,
                                            lp.part_name,
                                            lp.current_stock,
                                            lp.deliv_day,
                                            lp.std_stock
                                    FROM list_part lp 
                                    inner join part_prod pp on lp.part_no = pp.part_no
                                    inner join customer_prod cs on pp.customer_id=cs.id 
                                    inner join area ar on ar.id=pp.id_area
                                    order by pp.part_no asc");

$no = 1;

foreach ($stock_data as $data_stock) {
    $nama_area = $data_stock['nama_area'];
    $customer = $data_stock['customer'];
    $part_no = $data_stock['part_no'];
    $part_name = $data_stock['part_name'];
    $current_stock = $data_stock['current_stock'];
    $deliv_day = $data_stock['deliv_day'];
    $std_stock = $data_stock['std_stock'];
    // Menghindari pembagian 0/0
    $stock_day = ($deliv_day != 0) ? $current_stock / $deliv_day : 0;
    $stock_day = round($stock_day, 1);

    // Menangani kasus pembagian 0/0
    if ($deliv_day == 0 && $stock_day != 0) {
        $deliv_day = 0; // Atau berikan nilai atau pesan yang sesuai
    }

    $a[$row][0] = $no;
    $a[$row][1] = $nama_area;
    $a[$row][2] = $customer;
    $a[$row][3] = $part_no;
    $a[$row][4] = $part_name;
    $a[$row][5] = $std_stock ." hari";
    $a[$row][6] = $current_stock;
    $a[$row][7] = $deliv_day;
    $a[$row][8] = $stock_day." hari";
    $a[$row][9] = "<button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit' data-toggle='modal' 
    data-id='$part_no' data-nama='$part_name' data-qtystock='$current_stock' data-qtydeliv='$deliv_day' data-qtystd='$std_stock'
    data-target='#editModal'> 
    EDIT
    </button>";
    $row++;
}

$data = array(
    'data' => $a
);
echo json_encode($data);
