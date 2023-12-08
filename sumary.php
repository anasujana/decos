<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$last_date = mysqli_fetch_assoc(mysqli_query($conn, "SELECT tgl FROM plan ORDER BY tgl DESC LIMIT 1"));
$last = $last_date['tgl'];

$now_date = date("Y-m-d");

if (isset($_GET['fil_tgl_mulai']) and isset($_GET['fil_tgl_akhir'])) {
    $tgl_mulai = $_GET['fil_tgl_mulai'];
    $tgl_akhir = $_GET['fil_tgl_akhir'];

    $plan_deliv = mysqli_query($conn, "SELECT p.id,
                                                p.id_customer,
                                                cs.customer,
                                                p.tgl,
                                                p.tgl_kirim,
                                                p.id_cycle,
                                                cd.no_ct,
                                                cd.waktu,
                                                p.part_no,
                                                lp.part_name,
                                                lp.part_no_cst,
                                                lp.qty_box,
                                                p.plan,
                                                (select sum(qty) from prepare pr where pr.part_no_prep = p.part_no
                                                                                        and pr.no_delivery=p.no_delivery)
                                                AS act,
                                                p.no_delivery,
                                                sj.no_sj 
                                                from plan p 
                                                join cycle_deliv cd on p.id_cycle = cd.id
                                                left join customer_deliv cs on cs.id=p.id_customer
                                                join list_part lp on p.part_no = lp.part_no
                                                left join surat_jalan sj on sj.no_delivery=p.no_delivery
                                                WHERE (p.tgl>='$tgl_mulai' AND p.tgl<='$tgl_akhir') AND cs.id_area='$_SESSION[id_area]'
                                                ORDER BY cd.no_ct ASC, cs.customer DESC");
} else if (isset($_GET['fil_no_filter'])) {
    $no_deliv = $_GET['fil_no_filter'];

    $plan_deliv = mysqli_query($conn, "SELECT p.id,
                                                p.id_customer,
                                                cs.customer,
                                                p.tgl,
                                                p.tgl_kirim,
                                                p.id_cycle,
                                                cd.no_ct,
                                                cd.waktu,
                                                p.part_no,
                                                lp.part_name,
                                                lp.part_no_cst,
                                                lp.qty_box,
                                                p.plan,
                                                (select sum(qty) from prepare pr where pr.part_no_prep = p.part_no
                                                                                        and pr.no_delivery=p.no_delivery)
                                                AS act,
                                                p.no_delivery,
                                                sj.no_sj 
                                                from plan p 
                                                join cycle_deliv cd on p.id_cycle = cd.id
                                                left join customer_deliv cs on cs.id=p.id_customer
                                                join list_part lp on p.part_no = lp.part_no
                                                left join surat_jalan sj on sj.no_delivery=p.no_delivery
                                                WHERE p.no_delivery='$no_deliv'
                                                ORDER BY p.tgl, p.id_cycle, cs.customer ASC");
} else {
    $plan_deliv = mysqli_query($conn, "SELECT p.id,
                                                p.id_customer,
                                                cs.customer,
                                                p.tgl,
                                                p.tgl_kirim,
                                                p.id_cycle,
                                                cd.no_ct,
                                                cd.waktu,
                                                p.part_no,
                                                lp.part_name,
                                                lp.part_no_cst,
                                                lp.qty_box,
                                                p.plan,
                                                (select sum(qty) from prepare pr where pr.part_no_prep = p.part_no
                                                                                        and pr.no_delivery=p.no_delivery)
                                                AS act,
                                                p.no_delivery,
                                                sj.no_sj 
                                                from plan p 
                                                join cycle_deliv cd on p.id_cycle = cd.id
                                                left join customer_deliv cs on cs.id=p.id_customer
                                                join list_part lp on p.part_no = lp.part_no
                                                left join surat_jalan sj on sj.no_delivery=p.no_delivery
                                                WHERE (p.tgl='$last' OR p.tgl='$now_date') AND cs.id_area='$_SESSION[id_area]'
                                                ORDER BY p.tgl, p.id_cycle, cs.customer ASC");
}

$no = 1;

foreach ($plan_deliv as $data1) {
    $id_plan = $data1['id'];
    $part_no = $data1['part_no'];
    $tgl = $data1['tgl'];
    $tgl_kirim = $data1['tgl_kirim'];
    $id_customer = $data1['id_customer'];
    $id_cycle = $data1['id_cycle'];
    $no_delivery = $data1['no_delivery'];
    $part_name = $data1['part_name'];
    $qty_box = $data1['qty_box'];
    $plan = $data1['plan'];
    $actual = $data1['act'];
    $cycle = $data1['no_ct'];
    $jam = $data1['waktu'];
    $customer = $data1['customer'];
    $no_sj = $data1['no_sj'];
    if ($actual == NULL) {
        $balance = '';
    } else {
        $balance = $plan - $actual;
    };

    $a[$row][0] = $no;
    $a[$row][1] = $customer;
    $a[$row][2] = $tgl;
    $a[$row][3] = $tgl_kirim;
    $a[$row][4] = $cycle;
    $a[$row][5] = $jam;
    $a[$row][6] = $part_no;
    $a[$row][7] = $part_name;
    $a[$row][8] = $qty_box;
    $a[$row][9] = $plan;
    $a[$row][10] = $actual;
    $a[$row][11] = $balance;
    $a[$row][12] = $no_delivery;
    $a[$row][13] = $no_sj;
    $a[$row][14] = "<a href='plan_delivery/delete_plan.php?id_plan=$id_plan&part_no=$part_no&no_delivery=$no_delivery'> 
                        <button type='button' class='btn btn-danger btn-round text-dark alert_notif'>Hapus &nbsp;&nbsp;<i class='ti-trash'></i></button>
                    </a>
                    <a href='plan_delivery/update_plan.php?id_planing=$id_plan'> 
                        <button type='button' class='btn btn-success btn-round text-dark'>Edit &nbsp;&nbsp;<i class='ti-pencil'></i></button>
                    </a>";
    $row++;
    $no++;
}

$data = array(
    'data' => $a
);
echo json_encode($data);
