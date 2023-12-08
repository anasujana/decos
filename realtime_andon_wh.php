<?php
    include('koneksi/koneksi.php');
    date_default_timezone_set('Asia/Jakarta')
?> 
<table class="tg table">                                          
    <thead>
        <tr>
        <th class="tg-v0401"></th>
        <th class="tg-v0401" style="font-size: 30px; color:white;">PLAN</th>
        <th class="tg-v0401"><a href="" style="font-size: 30px; color:white;">ACTUAL</a></th>
        <th class="tg-v0401"><a href="" style="font-size: 30px; color:white;">BALANCE</a></th>
        <th class="tg-v0401"><a href="" style="font-size: 30px; color:white;">ACHIEVEMENT</a></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $now_date = date("Y-m-d"); 
        mysqli_query($conn,"CREATE TEMPORARY TABLE total_acm SELECT ar.nama_area, 
                                                                ar.id, 
                                                                COALESCE(SUM(planing), 0) AS plan_deliv, 
                                                                COALESCE(SUM(actual), 0) AS act_deliv
                                                                FROM area ar 
                                                                LEFT JOIN (
                                                                            SELECT cd.id_area,
                                                                                SUM(plan) AS planing,
                                                                                SUM(CASE
                                                                                    WHEN sj.no_sj IS NOT NULL THEN
                                                                                        (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                                            AND pr.no_delivery = p.no_delivery)
                                                                                    ELSE 0
                                                                                END) AS actual
                                                                            FROM customer_deliv cd
                                                                            LEFT JOIN plan p ON cd.id = p.id_customer
                                                                            LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                            WHERE p.tgl = '$now_date' OR sj.no_sj IS NULL
                                                                            GROUP BY cd.id_area
                                                                ) AS tabletotal ON ar.id = tabletotal.id_area where id_dept=1
                                                                GROUP BY ar.id, ar.nama_area;
                                                                ");

        $del_acm = mysqli_query ($conn,"SELECT * FROM total_acm");

        foreach($del_acm AS $data_acm){
        $id = $data_acm['id'];
        $nama_area = $data_acm['nama_area'];
        $plan_deliv = $data_acm['plan_deliv'];
        $plan_total = number_format($plan_deliv,0,",",".");
        $act_deliv = $data_acm['act_deliv'];
        $act_total = number_format($act_deliv,0,",",".");
        $min_day = $plan_deliv-$act_deliv;
        $min_total = number_format($min_day,0,",",".");

        if($plan_deliv==null){
            $plan = 0;
        }else{
            $plan = $plan_total;
        }

        if($act_deliv==null){
            $actual = 0;
        }else{
            $actual = $act_total;
        }  

        $ach = ($plan_deliv == 0) ? "0%" : (($act_deliv === null || $plan_deliv === null) ? "0%" : round(($act_deliv / $plan_deliv) * 100, 1) . '%');


        ?>
    <tr>
        <td class="tg-v0401" style="font-size: 35px; color:white;">
            <a href="andon_customer.php?area=<?php echo $id ;?>" style="font-size: 35px; color:white;" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Delivery <?php echo $nama_area ;?>">
                <?php echo $nama_area ;?>
            </a>
        </td>
        <td class="tg-v040"><?php echo $plan ;?></td>
        <td class="tg-v040"><?php echo $actual ;?></td>
        <td class="tg-v040 <?php if($min>$plan){
                                    echo 'text-warning';
                                }else{
                                    echo 'text-white';
                                }?>">
                            <?php echo $min_total ;?></td>
        <td class="tg-v040 <?php
                                if($ach<85){
                                echo 'text-danger';
                                }else if($ach>=85 AND $ach<95){
                                echo 'text-warning';   
                                }else if($ach>=95 AND $ach<99){
                                echo 'text-success';   
                                }else if($ach>=100){
                                echo 'text-primary';   
                                }
                            ?>">
            <?php echo $ach ;?>
        </td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <?php
        mysqli_query ($conn,"CREATE TEMPORARY TABLE acm_wh_total SELECT SUM(plan_deliv) as plan_total, 
                                                                        SUM(act_deliv) as act_total
                                                                FROM total_acm");
        $total_del_acm = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM acm_wh_total"));
        $total_plan1 = $total_del_acm['plan_total'];
        $total_plan = number_format($total_plan1,0,",",".");
        $total_act1 = $total_del_acm['act_total'];
        $total_act = number_format($total_act1,0,",",".");
        $min_total = $total_plan1-$total_act1;
        $total_minus = number_format($min_total,0,",",".");
        if($total_plan==null){
            $plan_total = 0;
        }else{
            $plan_total = $total_plan;
        }

        if($total_act==null){
            $actual_total = 0;
        }else{
            $actual_total = $total_act;
        } 

        if($total_act1==null){
            $achtotal = "0%";
        }else{
            $achtotal = ($total_act1/$total_plan1)*100;
            $achtotal = round($achtotal,1).'%';
        }
        ?>
        <td class="tg-v0401" style="font-size: 27px; color:white;">TOTAL</td>
        <td class="tg-v040"><?php echo $plan_total ;?></td>
        <td class="tg-v040"><?php echo $actual_total;?></td>
        <td class="tg-v040 <?php if($total_minus>$total_plan){
                                    echo 'text-warning';
                                }else{
                                    echo 'text-white';
                                }?>"><?php echo $total_minus  ;?>
        </td>
        <td class="tg-v040 <?php
                                if($achtotal<85){
                                echo 'text-danger';
                                }else if($achtotal>=85 AND $achtotal<95){
                                echo 'text-warning';   
                                }else if($achtotal>=95 AND $achtotal<99){
                                echo 'text-success';   
                                }else if($achtotal>=100){
                                echo 'text-primary';   
                                }
                                ?>"><?php echo $achtotal ;?>
        </td>
    </tr>
    </tbody>                                        
</table>
