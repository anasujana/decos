<?php
include('../koneksi/koneksi.php');
$a = array();
$row = 0;

    $area = mysqli_query ($conn,"SELECT ar.id, 
                                    ar.nama_area,
                                    dept.nama_dept 
                            FROM area ar 
                            left join departemen dept on dept.id_dept=ar.id_dept");
    foreach($area AS $data){
    $id = $data['id'];  
    $area = $data['nama_area'];
    $nama_dept = $data['nama_dept'];
        
        $a[$row][0]=$area;
        $a[$row][1]=$nama_dept;
        $a[$row][2]= '<button type="button" class="btn btn-danger btn-round text-dark delete_data" data-id3="'.$id.'">Hapus &nbsp;&nbsp;<i class="ti-trash"></i></button>
                      <button type="button" class="btn btn-success btn-round text-dark edit_area" data-toggle="modal" data-idarea="'.$id.'" data-area="'.$area.'" 
                      data-dept="'.$nama_dept.'" data-target="#edit_area">Edit &nbsp;&nbsp;<i class="ti-pencil"></i></button>
                     ';

    $row++;

    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

                    