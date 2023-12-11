<?php
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
$stock_data = mysqli_query($conn, "SELECT
                                        ar.nama_area,
                                        cs.customer,
                                        pp.part_no,
                                        lp.part_name,
                                        SUM(sa.qty) AS stok_all,
                                        SUM(CASE sar.kategori WHEN 1 THEN sar.current_stock ELSE 0 END) AS stock_fg,
                                        SUM(CASE sar.kategori WHEN 2 THEN sar.current_stock ELSE 0 END) AS wip_rm,
                                        SUM(CASE sar.kategori WHEN 3 THEN sar.current_stock ELSE 0 END) AS wip_produksi,
                                        sa.del_day,
                                        sa.std_stock,
                                        sa.remark
                                        FROM
                                        list_part lp
                                        LEFT JOIN stock_all sa ON sa.part_no = lp.part_no
                                        LEFT JOIN stock_area sar ON sar.part_no = lp.part_no
                                        LEFT JOIN kategori_stock ks ON ks.id = sar.kategori
                                        LEFT JOIN part_prod pp ON lp.part_no = pp.part_no
                                        LEFT JOIN customer_prod cs ON pp.customer_id = cs.id
                                        LEFT JOIN area ar ON ar.id = pp.id_area
                                        WHERE sar.kategori IN (1, 2, 3)
                                        GROUP BY ar.nama_area, cs.customer, pp.part_no, lp.part_name, sa.del_day, sa.std_stock, sa.remark
                                        ORDER BY stok_all DESC;
                                        ");

$no = 1;

foreach ($stock_data as $data_stock) {
    $nama_area = $data_stock['nama_area'];
    $customer = $data_stock['customer'];
    $part_no = $data_stock['part_no'];
    $part_name = $data_stock['part_name'];
    $stock_all = $data_stock['stok_all'];
    $stock_fg = $data_stock['stock_fg'];
    $wip_rm = $data_stock['wip_rm'];
    $wip_produksi = $data_stock['wip_produksi'];
    $deliv_day = $data_stock['del_day'];
    $std_stock = $data_stock['std_stock'];
    $remark = $data_stock['remark'];
    // Menghindari pembagian 0/0
    $stock_day = ($deliv_day != 0) ? $stock_fg / $deliv_day : 0;
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
    $a[$row][5] = $deliv_day; //deliv/day
    $a[$row][6] = $stock_fg; //stock fg
    $a[$row][7] = $stock_day; //stock/day
    $a[$row][8] =  $wip_rm; //WIP RM
    $a[$row][9] =  $wip_produksi; //WIP PROD
    $a[$row][10] = 0; //PLAN DELIVERY
    $a[$row][11] = 0; //BALANCE DELIVERY
    $a[$row][12] = $std_stock; //STD STOCK
    $a[$row][13] = 0; //BALANCE STD STOCK
    $a[$row][14] = "remark"; //remark
    $a[$row][15] = "<button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit' data-toggle='modal' 
    data-id='$part_no' data-nama='$part_name' data-qtydeliv='$deliv_day' data-qtystd='$std_stock'
    data-target='#editModal'> 
    EDIT
    </button>";
    $row++;
    $no++;
}

$data = array(
    'data' => $a
);
echo json_encode($data);
