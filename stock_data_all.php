<?php
include('koneksi/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
$all_stock_data = mysqli_query($conn, "WITH RankedData AS (
    SELECT
        DENSE_RANK() OVER (PARTITION BY sar.part_no ORDER BY sa.tgl_updated DESC) AS rnk,
        ar.nama_area AS wh,
        cs.customer,
        pp.part_no,
        lp.part_name,
        sa.qty AS total_stock,
        sa.del_day AS deliv_day,
        MAX(CASE WHEN sar.kategori = 1 THEN COALESCE(sar.current_stock, 0) END) AS stock_fg,
        MAX(CASE WHEN sar.kategori = 2 THEN COALESCE(sar.current_stock, 0) END) AS wip_rm,
        MAX(CASE WHEN sar.kategori = 3 THEN COALESCE(sar.current_stock, 0) END) AS wip_produksi,
        pl.plan,
        sa.std_stock AS std_stok,
        sa.remark,
        '' AS action
    FROM 
        list_part lp
        LEFT JOIN stock_all sa ON sa.part_no = lp.part_no AND sa.tgl_updated = (
            SELECT MAX(tgl_updated) FROM stock_all WHERE tgl_updated < CURRENT_DATE
        )
        LEFT JOIN stock_area sar ON sar.part_no = lp.part_no AND sar.kategori IN (1, 2, 3) AND sar.tgl_updated = (
            SELECT MAX(tgl_updated) FROM stock_area WHERE tgl_updated < CURRENT_DATE
        )
        LEFT JOIN kategori_stock ks ON ks.id = sar.kategori
        LEFT JOIN part_prod pp ON lp.part_no = pp.part_no
        LEFT JOIN customer_prod cs ON pp.customer_id = cs.id
        LEFT JOIN area ar ON ar.id = pp.id_area
        LEFT JOIN plan pl ON sar.part_no = pl.part_no AND pl.tgl = (
            SELECT MAX(tgl) FROM plan WHERE tgl = CURRENT_DATE
        )

    GROUP BY
        sar.part_no,
        ar.nama_area,
        cs.customer,
        pp.part_no,
        lp.part_name,
        sa.qty,
        sa.del_day,
        sa.std_stock,
        sa.remark,
        sa.tgl_updated
)

SELECT *
FROM RankedData
WHERE rnk = 1
ORDER BY total_stock DESC;
");

$no = 1;

$no = 1;
foreach ($all_stock_data as $data_stock) {
    $wh_name = $data_stock['wh'];
    $cust_name = $data_stock['customer'];
    $part_no_all = $data_stock['part_no'];
    $part_name_all = $data_stock['part_name'];
    $total_stock = $data_stock['total_stock'];
    $fg_stock = $data_stock['stock_fg'];
    $rm_stock = $data_stock['wip_rm'];
    $prod_stock = $data_stock['wip_produksi'];
    $del_day = $data_stock['deliv_day'];
    $std_stock = $data_stock['std_stok'];
    $bal_std = $total_stock - $std_stock;
    // Menghindari pembagian 0/0
    $stock_day = ($del_day != 0) ? $fg_stock / $del_day : 0;
    $stock_day = round($stock_day, 1);
    // Menangani kasus pembagian 0/0
    if ($del_day == 0 && $stock_day != 0) {
        $del_day = 0; // Atau berikan nilai atau pesan yang sesuai
    }

    $a[$row][0] = $no;
    $a[$row][1] = $wh_name;
    $a[$row][2] = $cust_name;
    $a[$row][3] = $part_no_all;
    $a[$row][4] = $part_name_all;
    $a[$row][5] = $total_stock;
    $a[$row][6] = $fg_stock; //deliv/day
    $a[$row][7] = $rm_stock; //stock fg
    $a[$row][8] = $prod_stock; //stock/day
    $a[$row][9] =  $del_day; //WIP RM
    $a[$row][10] = $std_stock; //WIP PROD
    $a[$row][11] = $bal_std; //PLAN DELIVERY
    $a[$row][12] =  $stock_day; //BALANCE DELIVERY
    $a[$row][13] = "<button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit' data-toggle='modal' 
    data-id='$part_no_all' data-nama='$part_name_all' data-qtydeliv='$del_day' data-qtystd='$std_stock'
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
