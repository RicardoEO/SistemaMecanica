<?php
require('../../fpdf/fpdf.php');
session_start();



class myPDF extends FPDF

{

  protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';
  function header(){
    $this ->Image('../../img/logo.png',10,6,33);
    $this ->SetFont('Arial','B',14);
    $this ->Cell(276,5,'ORDEN DE TRABAJO',0,0,'C');
    $this ->Ln();
    $this ->SetFont('Times','',12);
    $this ->Cell(25,50,'Tecnico universitario en',0,0,'C');
    $this ->Ln(5);
    $this ->Cell(21,50,'Mecanica Automotriz',0,0,'C');
    $this ->Ln(5);
    $this ->Cell(20,50,'Universidad Tecnica',0,0,'C');
    $this ->Cell(400,50,'5to Semestre 2018',0,0,'C');
    $this ->Ln(5);
    $this ->Cell(19,50,'Federico Sta. Maria.',0,0,'C');


  }

  function primeraTabla(){

    $this ->SetFont('Times','B',12);
    $this ->Cell(20,10,'Profesor Encargado' . $nombre,1,0,'C');
    $this ->Cell();
    $this ->Ln();
  }

  function ejemplo1(){
    //set font to arial, bold, 14pt


  //invoice contents
  require ('../../conexion.php');
  $alumnos = array();
  $id = $_POST['id'];
  // ID DE ORDEN DE TRABAJO
  $consulta = "SELECT gru_id_grupo from ordendetrabajo where id_ot = $id;";
  $resultset = mysqli_query($link, $consulta);
  $grupo = mysqli_fetch_array($resultset);

  // ALUMNOS
  $consulta2 = "SELECT rutalumno from alumno_grupodetrabajo where id_grupo = $grupo[0];";
  $resultset2 = mysqli_query($link, $consulta2);

  while($resultado=mysqli_fetch_array($resultset2)) {
    $consulta22 = "SELECT nombres, appaterno from alumno where rutalumno = $resultado[0];";
    $resultset22 = mysqli_query($link, $consulta22);
    $resultado2 = mysqli_fetch_array($resultset22);
    array_push($alumnos, $resultado2[0] . ' ' . $resultado2[1] . ' ');
  }


  // HORA DE ENTREGA
  $consulta3 = "SELECT fecha_creacion from ordendetrabajo where id_ot = $id;";
  $resultset = mysqli_query($link, $consulta3);
  $entrega = mysqli_fetch_array($resultset);
  $entrega = $entrega[0];

  // FECHA
  $consulta4 = "SELECT fecha_creacion from ordendetrabajo where id_ot = $id;";
  $resultset3 = mysqli_query($link, $consulta4);
  $fecha = mysqli_fetch_array($resultset3);
  $fecha = $fecha['fecha_creacion'];

  // DATOS DEL VEHICULO
  $consulta5 = "SELECT idautomovil from ordendetrabajo where id_ot = $id;";
  $resultset4 = mysqli_query($link, $consulta5);
  $idautomovil = mysqli_fetch_array($resultset4);

  $consulta6 = "SELECT * from automovil where idautomovil = $idautomovil[0];";
  $resultset5 = mysqli_query($link, $consulta6);
  $datos = mysqli_fetch_array($resultset5);

  $patenteVehiculo = $datos['PATENTE'];
  $anhoVehiculo = $datos['ANO'];
  $kilometrajeVehiculo = $datos['KILOMETRAJE'];
  $vinVehiculo = $datos['VIN'];
  $sintomasVehiculo = $datos['SINTOMA_ANOMALIA'];
  $foto2 = $datos['FOTO'];
  $foto = base64_encode($foto2);


  // DUEÑO
  $consulta7 = "SELECT * from dueno where rut_dueno = $datos[1];";
  $resultset6 = mysqli_query($link, $consulta7);
  $dueño = mysqli_fetch_array($resultset6);

  $propietarioVehiculo = $dueño['NOMBRES_DUENO']. ' ' . $dueño['APPATERNODUENO']. ' ' . $dueño['APMATERNODUENO'];
  $telefonoPropietario = $dueño['TELEFONO_DUENO'];

  //NOMBRE PROFESOR
  $obtener = "SELECT rutProfesor1 from ordendetrabajo where id_ot = $id";
  $rsobtener = mysqli_query($link, $obtener);
  $arrayrut = mysqli_fetch_array($rsobtener); 
  $rutProfesor1 = $arrayrut['rutProfesor1'];
  $consulta8 = "SELECT * from profesor where rutprofesor = $rutProfesor1;";
  $resultset7 = mysqli_query($link, $consulta8);
  $nombres = mysqli_fetch_array($resultset7);
  $nombre = $nombres['NOMBRESPROFESOR'] . ' ' .$nombres['APPATERNO'] . ' ' . $nombres['APMATERNO'];
  $alumnoss = '';
  for($i=0;$i<sizeof($alumnos);$i++) {
      $alumnoss = $alumnoss . ' ' . $alumnos[$i];
  }
  $this ->Ln(30);

  $this->SetFont('Arial','B',12);

  $this->Cell(250 ,5,'Profesor Encargado: ' . $nombre,1,1);

  $this->Cell(150 ,5,'Alumnos: ' . $alumnoss,1,0);
  
  $this->Cell(100 ,5,'Entrega: ' . $entrega,1,1);

  $this->Cell(150 ,5,'Hora de recepcion: ' . '$horaDeRecepcion',1,0);
  $this->Cell(100 ,5,'Hora Entrega: ' . '$horaEntrega',1,1);

  $this->Cell(125 ,5,'Fecha: ' . $fecha,1,0);
  $this->Cell(125 ,5,'',1,1);


  $this ->Ln();
  $this ->SetFont('Arial','B',15);
  $this ->Cell(100,5,'DATOS DE VEHICULO',0,1);

  $this->SetFont('Arial','B',12);
  $this->Cell(55 ,5,'Marca',1,0);
  $this->Cell(70 ,5,'$marcaVehiculo',1,0);
  $this->Cell(55 ,5,'Anho',1,0);
  $this->Cell(70 ,5,$anhoVehiculo,1,1);

  $this->Cell(55 ,5,'Modelo',1,0);
  $this->Cell(70 ,5,'$modeloVehiculo',1,0);
  $this->Cell(55 ,5,'Patente',1,0);
  $this->Cell(70 ,5,$patenteVehiculo,1,1);

  $this->Cell(55 ,5,'Kilometraje',1,0);
  $this->Cell(70 ,5,$kilometrajeVehiculo,1,0);
  $this->Cell(55 ,5,'VIN',1,0);
  $this->Cell(70 ,5,$vinVehiculo,1,1);
  
  $this->Cell(55 ,5,'Documentos',1,0);
  $this->Cell(35 ,5,'$documento1',1,0);
  $this->Cell(35 ,5,'$documento2',1,0);
  $this->Cell(55 ,5,'Foto Padron.',1,0);
  $this->Cell(70 ,5,'Foto vehiculo',1,1);

  $this->Ln();
  $this->Cell(55 ,5,'Propietario: ' . $propietarioVehiculo,0,1);
  $this->Cell(55 ,5,'Telefono: ' . $telefonoPropietario,0,1);

  $this->Ln();
  $this ->SetFont('Arial','B',15);
  $this ->Cell(100,5,'SINTOMA Y/O ANOMALIA:',0,1);
  $this->SetFont('Arial','B',12);
  $this->Cell(100,5,$sintomasVehiculo,0,1);

  $this->Ln();
  $this ->SetFont('Arial','B',13);
  $this->Cell(130 ,5,'DESCRIPCION',1,0);
  $this->Cell(50 ,5,'REVISION',1,0);
  $this->Cell(70 ,5,'REPARACION',1,1);

  $this->Cell(130 ,5,'Cambio de aceite motor y filtro',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Niveles de aceite de transmision',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Chequeo y/o afinamiento',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Cambio de correa de distribucion / Aux.',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Analisis de Gases',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Inspeccion y/o reparacion de frenos',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Inspeccion y/o reparacion de motor',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Inspeccion y/o reparacion de embrague',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Reparacion tren delantero',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Engrase y/o reparacion de masas',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Mantencion de alternador',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Mantencion de arranque',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);

  $this->Cell(130 ,5,'Sistema de inyeccion Electronica',1,0);
  $this->Cell(50 ,5,'',1,0);
  $this->Cell(70 ,5,'',1,1);


  }
  
  function ejemplo2(){
    $this->Ln(30);
    $this->SetFont('Arial','B',12);
    $this->Cell(250 ,5,'Detalle de trabajo:',0,1);
    $this->Cell(250 ,5,'$detalleDeTrabajo',0,1);

    $this->Ln(40);

    $this->SetFont('Arial','BU',15);
    $this->Cell(250 ,5,'EQUIPO DE DIAGNOSTICO UTILIZADO',0,1);

    $this->Ln(20);

    $this->SetFont('Arial','B',13);
    $this->Cell(85 ,5,'EQUIPO REQUERIDO',1,0);
    $this->Cell(85 ,5,'VALORES OBTENIDO',1,0);
    $this->Cell(85 ,5,'VALORES STANDAR',1,1);

    $this->Cell(85 ,5,'COMPRESIMETRO',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'VACUOMETRO',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'ANALIZADOR DE GASES',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'OPACIMETRO',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'SCANNER',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'MULTIMETRO',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'EQUIP. PRESION INYECCCION',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'EQUIP. PRESION REFRIG.',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'MANOMETRO DE ACEITE',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'OSCILOSCOPIO',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Cell(85 ,5,'DINAMOMETRO.',1,0);
    $this->Cell(85 ,5,'',1,0);
    $this->Cell(85 ,5,'',1,1);

    $this->Ln(50);
    $this->SetFont('Arial','B',12);
    $this->Cell(100 ,5,'_______________',0,0);
    $this->Cell(100 ,5,'_______________',0,0);
    $this->Cell(100 ,5,'_______________',0,1);

    $this->Cell(100 ,5,'Firma Alumnos',0,0);
    $this->Cell(100 ,5,'firma Propietario',0,0);
    $this->Cell(100 ,5,'Firma Instructor',0,1);


  }

  function WriteHTML($html)
  {
      // HTML parser
      $html = str_replace("\n",' ',$html);
      $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
      foreach($a as $i=>$e)
      {
          if($i%2==0)
          {
              // Text
              if($this->HREF)
                  $this->PutLink($this->HREF,$e);
              else
                  $this->Write(5,$e);
          }
          else
          {
              // Tag
              if($e[0]=='/')
                  $this->CloseTag(strtoupper(substr($e,1)));
              else
              {
                  // Extract attributes
                  $a2 = explode(' ',$e);
                  $tag = strtoupper(array_shift($a2));
                  $attr = array();
                  foreach($a2 as $v)
                  {
                      if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                          $attr[strtoupper($a3[1])] = $a3[2];
                  }
                  $this->OpenTag($tag,$attr);
              }
          }
      }
  }

  function OpenTag($tag, $attr)
  {
      // Opening tag
      if($tag=='B' || $tag=='I' || $tag=='U')
          $this->SetStyle($tag,true);
      if($tag=='A')
          $this->HREF = $attr['HREF'];
      if($tag=='BR')
          $this->Ln(5);
  }

  function CloseTag($tag)
  {
      // Closing tag
      if($tag=='B' || $tag=='I' || $tag=='U')
          $this->SetStyle($tag,false);
      if($tag=='A')
          $this->HREF = '';
  }

  function SetStyle($tag, $enable)
  {
      // Modify style and select corresponding font
      $this->$tag += ($enable ? 1 : -1);
      $style = '';
      foreach(array('B', 'I', 'U') as $s)
      {
          if($this->$s>0)
              $style .= $s;
      }
      $this->SetFont('',$style);
  }

  function PutLink($URL, $txt)
  {
      // Put a hyperlink
      $this->SetTextColor(0,0,255);
      $this->SetStyle('U',true);
      $this->Write(5,$txt,$URL);
      $this->SetStyle('U',false);
      $this->SetTextColor(0);
  }
}

  //invoice contents
  require ('../../conexion.php');
  $alumnos = array();
  $id = $_POST['id'];
  // ID DE ORDEN DE TRABAJO
  $consulta = "SELECT gru_id_grupo from ordendetrabajo where id_ot = $id;";
  $resultset = mysqli_query($link, $consulta);
  $grupo = mysqli_fetch_array($resultset);

  // ALUMNOS
  $consulta2 = "SELECT rutalumno from alumno_grupodetrabajo where id_grupo = $grupo[0];";
  $resultset2 = mysqli_query($link, $consulta2);

  while($resultado=mysqli_fetch_array($resultset2)) {
    $consulta22 = "SELECT nombres, appaterno from alumno where rutalumno = $resultado[0];";
    $resultset22 = mysqli_query($link, $consulta22);
    $resultado2 = mysqli_fetch_array($resultset22);
    array_push($alumnos, $resultado2[0] . ' ' . $resultado2[1] . ' ');
  }


  // HORA DE ENTREGA
  $consulta3 = "SELECT fecha_creacion from ordendetrabajo where id_ot = $id;";
  $resultset = mysqli_query($link, $consulta3);
  $entrega = mysqli_fetch_array($resultset);
  $entrega = $entrega[0];

  // FECHA
  $consulta4 = "SELECT fecha_creacion from ordendetrabajo where id_ot = $id;";
  $resultset3 = mysqli_query($link, $consulta4);
  $fecha = mysqli_fetch_array($resultset3);
  $fecha = $fecha['fecha_creacion'];

  // DATOS DEL VEHICULO
  $consulta5 = "SELECT idautomovil from ordendetrabajo where id_ot = $id;";
  $resultset4 = mysqli_query($link, $consulta5);
  $idautomovil = mysqli_fetch_array($resultset4);

  $consulta6 = "SELECT * from automovil where idautomovil = $idautomovil[0];";
  $resultset5 = mysqli_query($link, $consulta6);
  $datos = mysqli_fetch_array($resultset5);

  $patenteVehiculo = $datos['PATENTE'];
  $anhoVehiculo = $datos['ANO'];
  $kilometrajeVehiculo = $datos['KILOMETRAJE'];
  $vinVehiculo = $datos['VIN'];
  $sintomasVehiculo = $datos['SINTOMA_ANOMALIA'];
  $foto2 = $datos['FOTO'];
  $foto = base64_encode($foto2);
  header('Content-Type: image/jpeg;');


$pdf = new myPDF();
$pdf ->AliasNbPages();
$pdf ->AddPage('P','A3',0);
$pdf ->ejemplo1();
$img = "<img src=\"data:image/jpeg;base64,".$foto."\"/>";
$pdf->WriteHTML($img);
if (!file_exists("archivos")) {
        mkdir("archivos",0777,true);
        $pdf->Output("archivos/ot.pdf","F");
} else {
$pdf->Output("archivos/ot.pdf","F");
}
?>