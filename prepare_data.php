<?php
include('koneksi/koneksi.php');
$a = array();
$row = 0;

$now_date = date("Y-m-d");
if(isset($_GET['no_filter'])){ 
    $no_deliv = $_GET ['no_filter'];

    $plan_deliv = mysqli_query ($conn,"SELECT p.part_no,
                                                lp.part_name,
                                                lp.part_no_cst,
                                                lp.qty_box,
                                                p.plan,
                                                (select sum(qty) from prepare pr where  pr.part_no_prep = p.part_no
                                                                                        and pr.no_delivery=p.no_delivery)
                                                AS act,
                                                p.no_delivery
                                                from plan p 
                                                left join list_part lp on p.part_no = lp.part_no
                                                where no_delivery='$no_deliv'");


}

$no=1;

foreach($plan_deliv AS $data1){
$part_no = $data1['part_no'];
$part_cst = $data1['part_no_cst'];
$part_name = $data1['part_name'];
$qty_box = $data1['qty_box'];
$plan = $data1['plan'];
$actual = $data1['act'];
$no_delivery = $data1['no_delivery'];
if($actual==null){
    $actual = "0";
}else{
    $actual = "$actual";
};
$balance = $plan-$actual;
        
        $a[$row][0]=$no;
        $a[$row][1]=$part_no;
        $a[$row][2]=$part_name;
        $a[$row][3]=$part_cst;
        $a[$row][4]=$qty_box;
        $a[$row][5]=$plan;
        $a[$row][6]=$actual;
        $a[$row][7]=$balance;
    $row++;
    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

                    