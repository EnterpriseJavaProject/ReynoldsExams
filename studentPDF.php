<?php 
session_start();
include('FPDF/fpdf.php');



$connection = mysqli_connect("localhost","root","","registration");
$query = "SELECT * FROM students";
$query_run = mysqli_query($connection, $query);




class PDF extends FPDF{
    function Header(){
        $this->SetFont('arial', 'B', '15');
        $this->Image('images/aiti.png', 120, 0, 60, 40);
        $this->cell(100,10,'GHANA-INDIA KOFI ANNAN CENTER OF EXCELLENCE IN ICT STUDENTS REPORTS',0,1);
    }
}



if (isset($_POST['btn_pdf']))
 {
     

    $pdf = new PDF('p', 'mm', 'a3');
    $pdf->SetTopMargin('40');
    $pdf->SetFont('arial', 'b', '12');
    $pdf->AddPage();
   $pdf->cell('30', '10', 'STUDENT ID', '1', '0', 'C');
    $pdf->cell('55', '10', 'NAMES', '1', '0', 'C');
    $pdf->cell('30', '10', 'CONTACT', '1', '0', 'C');
   $pdf->cell('20', '10', 'GENDER', '1', '0', 'C');
    $pdf->cell('65', '10', 'EMAIL', '1', '0', 'C');
    $pdf->cell('50', '10', 'ADDRESS', '1', '0', 'C');
    $pdf->cell('35', '10', 'DATE OF BIRTH', '1', '1', 'C');



   $pdf->SetFont('arial', '', '10');

   while ($row = mysqli_fetch_assoc($query_run)) 
   {
        $pdf->cell('30', '10', $row['student_id'], '1', '0', 'C');
       $pdf->cell('55', '10', $row['username'], '1', '0', 'C');
       $pdf->cell('30', '10', $row['phone'], '1', '0', 'C');
       $pdf->cell('20', '10', $row['gender'], '1', '0', 'C');
       $pdf->cell('65', '10', $row['email'], '1', '0', 'C');
       $pdf->cell('50', '10', $row['address'], '1', '0', 'C');
       $pdf->cell('35', '10', $row['dob'], '1', '1', 'C');
   }



    $pdf->Output();

}





?>









