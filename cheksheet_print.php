<?php   
include('koneksi/koneksi.php');
session_start();
require_once (__DIR__ . '/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$img= "<img src='assets/images/logo fln.png' width=200px>";

$table_head = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT p.tgl,
                                                            jam.no_ct,
                                                            jam.waktu,
                                                            cd.customer,
                                                            p.no_delivery
                                                    from plan p 
                                                    left join cycle_deliv jam on jam.id = p.id_cycle 
                                                    left join customer_deliv cd on cd.id = p.id_customer 
                                                    left join area ar on ar.id = cd.id_area
                                                    where p.no_delivery='bb-20231110-9-1-0'"));

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Paid');
$drawing->setDescription('Paid');
$drawing->setPath('assets/images/logo fln.png'); // put your path and image here
$drawing->setHeight(80);
$drawing->setCoordinates('A1');
$drawing->setOffsetX(0);
$drawing->setRotation(0);
$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(10);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

$sheet->setCellValue('B2', 'CHEKSHEET DELIVERY');
$sheet->setCellValue('D1', 'Customer');
$sheet->setCellValue('D2', 'Tgl');
$sheet->setCellValue('D3', 'Cycle');
$sheet->setCellValue('D4', 'Jam');
$sheet->setCellValue('D5', 'No Deliv');
$sheet->setCellValue('E1', ':');
$sheet->setCellValue('E2', ':');
$sheet->setCellValue('E3', ':');
$sheet->setCellValue('E4', ':');
$sheet->setCellValue('E5', ':');
$sheet->setCellValue('F1', $table_head['customer']);
$sheet->setCellValue('F2', $table_head['tgl']);
$sheet->setCellValue('F3', $table_head['no_ct']);
$sheet->setCellValue('F4', $table_head['waktu']);
$sheet->setCellValue('F5', $table_head['no_delivery']);
$sheet->setCellValue('A7', 'Part no');
$sheet->setCellValue('B7', 'Part name');
$sheet->setCellValue('C7', 'Qty/Box');
$sheet->setCellValue('D7', 'Plan');
$sheet->setCellValue('E7', 'Actual');
$sheet->setCellValue('F7', 'Balance');

$plan_deliv = mysqli_query ($conn,"SELECT 
                                    cs.customer,
                                    p.tgl,
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
                                    WHERE (p.tgl='2023-11-10' OR p.tgl='2023-11-10') AND cs.id_area=1
                                    ORDER BY p.tgl, p.id_cycle, cs.customer ASC");

$i = 8;
foreach($plan_deliv AS $data){
    $plan = $data['plan'];
    $actual = $data['act'];
    $balance = $plan-$actual;

    $sheet->setCellValue('A'.$i, $data['part_no']);
    $sheet->setCellValue('B'.$i, $data['part_name']);
    $sheet->setCellValue('C'.$i, $data['qty_box']);
    $sheet->setCellValue('D'.$i, $data['plan']);
    $sheet->setCellValue('E'.$i, $data['act']);
    $sheet->setCellValue('F'.$i, $balance);
    $i++;
}

$sheet->setCellValue('A46', "Pic Prepare");
$sheet->setCellValue('B46', "CHECKED");
$sheet->setCellValue('A50', "ANA SUJANA");
$sheet->setCellValue('B50', "EDI PURWANTO");

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' =>
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A7:F'.$i)->applyFromArray($styleArray);
$spreadsheet->getActiveSheet()->getStyle('A1:F'.$i)
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$spreadsheet->getActiveSheet()->mergeCells('B2:C2');
$spreadsheet->getActiveSheet()->getStyle('B2')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('E1:E5')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('A46:B54')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$sheet->getStyle('B2')->getFont()->setSize(15);
$sheet->getStyle('B2')->getFont()->setBold(true);
$sheet->getStyle('A7:F7')->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToPage('A1:FF'.$i);

$writer = new xlsx($spreadsheet);
$file_name= 'chekshet & sumary delivery';
header ('Content-Type: application/vnd.ms-excel; charset=utf-8');
header ('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
header ('Cache-Control: max-age=0');
$writer->save('php://output');

                                  