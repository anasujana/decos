<?php
    include 'koneksi/koneksi.php';
   // SCAN PART CST
        if(isset($_POST['no_deliv1']) AND isset($_POST['part_fln_scan1']) AND isset($_POST['part_cst_scan'])){
            $no_delivery1 = $_POST['no_deliv1'];
            $part_fln_scan1 = $_POST['part_fln_scan1'];
            $part_cst_scan = $_POST['part_cst_scan'];                                 
            $qr_part_no1 = explode("/",$part_fln_scan1);

            // ambil id customer
            $id_cs = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT id_customer FROM plan 
                                                                                    where part_no='$qr_part_no1[0]' 
                                                                                    AND no_delivery='$no_delivery1'"));

            $id_customer = $id_cs['id_customer']; 
            // ambil id customer

            // Cek part no
            $part_no_db2 = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT part_no_cst FROM part_deliv where part_no='$qr_part_no1[0]' AND customer_id=$id_customer"));
            $part_cst_db = $part_no_db2['part_no_cst'];
            // Cek part no

            // create id primary key
            $cst_deliv1 = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT customer FROM customer_deliv where id=$id_customer"));
            $cust1 = $cst_deliv1['customer'];
            $date_now = date("Y-m-d H:i:s");
            $id_primary1 = strtotime($date_now)."$cust1";
            // create id primary 
            
        if($part_cst_db!=$part_cst_scan){
            ?>
            <script>
                Swal.fire({
                            icon: 'error',
                            title: 'error!',
                            text: 'Part Number Tidak benar',
                            showConfirmButton: false,
                            timer: 1500
                        });
            </script>
            <?php
           }else if($part_cst_db==$part_cst_scan){
            // tambahkan ke database    
            $add = mysqli_query($conn,"INSERT INTO prepare (id_prep,part_no_prep,qty,no_delivery) VALUES ('$id_primary1','$qr_part_no1[0]','$qr_part_no1[1]','$no_delivery1')"); 
            ?>
                <script>
                    Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Scan QR label Complete.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                </script>
                <?php
          
            };
        }
    // SCAN PART CST
?>
