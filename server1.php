<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function fetchData() {
    // Koneksi ke database (gantilah dengan kredensial dan nama database yang sesuai)
    include('koneksi/koneksi.php');
    date_default_timezone_set('Asia/Jakarta');
    $now_date = date("Y-m-d"); 
    $del_acm = mysqli_query($conn, "SELECT ar.nama_area, 
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


    $ach_deliv = [];
    $total_planning = 0;
    $total_actual = 0;
    $total_minus = 0;
    
    while ($row = mysqli_fetch_assoc($del_acm)) {
        $planning = $row['plan_deliv'];
        $actual = $row['act_deliv'];
        
        // Pastikan $planning dan $actual tidak null atau 0 sebelum melakukan perhitungan
        if ($planning != 0 OR $actual != 0) {
            // Hitung achievement (actual/planning)
            $achievement = ($actual / $planning) * 100;
            $achievement = round($achievement, 1);
    
            // Hitung data minus (pengurangan planning - actual)
            $minus = $planning - $actual;
    
            // Tambahkan hasil perhitungan ke dalam array
            $row['achievement'] = $achievement;
            $row['minus'] = $minus;
    
            $ach_deliv[] = $row;
    
            // Tambahkan ke total planning, actual, dan minus
            $total_planning += $planning;
            $total_actual += $actual;
            $total_minus += $minus;
        } else{
            // Jika $planning atau $actual adalah null atau 0, masukkan nilai default atau pesan kesalahan ke dalam array
            $row['achievement'] = 0;
            $row['minus'] = 0;
    
            $ach_deliv[] = $row;
        }
    }
    
    // Hitung total achievement setelah selesai loop
    if ($total_planning !== 0) {
        $total_achievement = ($total_actual / $total_planning) * 100;
        $total_achievement = round($total_achievement, 1);
    } else {
        $total_achievement = 0;
    }
    
    // Tambahkan total ke dalam array
    $total_data = [
        'total_planning' => $total_planning,
        'total_actual' => $total_actual,
        'total_minus' => $total_minus,
        'total_achievement' => $total_achievement // Total Achievement
    ];
    
    $ach_deliv[] = $total_data;
    

    return $ach_deliv;
}

while (true) {
    // Ambil data absensi dari database
    $ach_deliv = fetchData();

    // Pastikan $ach_deliv adalah array yang valid
    if (is_array($ach_deliv)) {
        // Kirim data absensi ke klien dalam format JSON
        echo "data: " . json_encode($ach_deliv) . "\n\n";
    } else {
        // Jika $ach_deliv tidak valid, kirimkan array kosong
        echo "data:" . json_encode([]) . "\n\n";
    }
    
    ob_flush();
    flush();

    // Tunggu beberapa detik sebelum mengirim data lagi
    sleep(1);
}

?>
