<?php
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
$stock_data = mysqli_query($conn, "WITH RankedData AS (
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
                                                            LEFT JOIN stock_all sa ON sa.part_no = lp.part_no
                                                            LEFT JOIN stock_area sar ON sar.part_no = lp.part_no AND sar.kategori IN (1, 2, 3)
                                                            LEFT JOIN kategori_stock ks ON ks.id = sar.kategori
                                                            LEFT JOIN part_prod pp ON lp.part_no = pp.part_no
                                                            LEFT JOIN customer_prod cs ON pp.customer_id = cs.id
                                                            LEFT JOIN area ar ON ar.id = pp.id_area
                                                            LEFT JOIN plan pl ON sar.part_no = pl.part_no AND pl.tgl = '2023-12-15'
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
                                                    SELECT 
                                                        wh,
                                                        customer,
                                                        part_no,
                                                        part_name,
                                                        total_stock,
                                                        deliv_day,
                                                        stock_fg,
                                                        wip_rm,
                                                        wip_produksi,
                                                        plan,
                                                        std_stok,
                                                        remark,
                                                        action
                                                    FROM RankedData
                                                    WHERE rnk = 1
                                                    ORDER BY total_stock DESC;
                                        ");

$no = 1;

foreach ($stock_data as $data_stock) {
    $nama_area = $data_stock['wh'];
    $customer = $data_stock['customer'];
    $part_no = $data_stock['part_no'];
    $part_name = $data_stock['part_name'];
    $total_stock = $data_stock['total_stock'];
    $stock_fg = $data_stock['stock_fg'];
    $wip_rm = $data_stock['wip_rm'];
    $wip_produksi = $data_stock['wip_produksi'];
    $plan = $data_stock['plan'];
    $deliv_day = $data_stock['deliv_day'];
    $std_stock = $data_stock['std_stok'];
    $bal_deliv = $total_stock - $plan;
    $bal_std = $bal_deliv - $std_stock;
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
    $a[$row][5] = $total_stock;
    $a[$row][6] = $deliv_day; //deliv/day
    $a[$row][7] = $stock_fg; //stock fg
    $a[$row][8] = $stock_day; //stock/day
    $a[$row][9] =  $wip_rm; //WIP RM
    $a[$row][10] =  $wip_produksi; //WIP PROD
    $a[$row][11] = $plan; //PLAN DELIVERY
    $a[$row][12] =  $bal_deliv; //BALANCE DELIVERY
    $a[$row][13] = $std_stock; //STD STOCK
    $a[$row][14] = $bal_std; //BALANCE STD STOCK
    $a[$row][15] = $remark; //remark
    $a[$row][16] = "<button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit' data-toggle='modal' 
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
