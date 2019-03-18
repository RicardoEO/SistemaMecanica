<?php
require '../../vendor/autoload.php';
require ('../../conexion.php');

use PhpOffice\PhpSpreadSheet\SpreadSheet;
use PhpOffice\PhpSpreadSheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
$cont = -1;
$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];
$select = $_POST['cursos_excel'];
$arreglo = array();
$fecha = $_POST['fecha'];
    if(!file_exists('archivos')) {
        mkdir('archivos',0777,true);
        if(file_exists('archivos')) {
            if(move_uploaded_file($guardado, 'archivos/' .$nombre)) {
                $ruta = 'archivos/' .$nombre;
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xls");
                $spreadsheet = $reader->load($ruta);
                $sheet = $spreadsheet->getActiveSheet();
                foreach ($sheet->getRowIterator(9) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                    foreach ($cellIterator as $cell) {
                        if (!is_null($cell)) {
                            $value = $cell->getValue();
                            array_push($arreglo, $value);
                            print_r($arreglo);
                        }
                    }
                }
                echo "Archivo guardado con exito";
            }else{
                echo "Archivo no se pudo guardar";
            }
        }
    }else{
        if(move_uploaded_file($guardado, 'archivos/' .$nombre)) {
            $ruta = 'archivos/' .$nombre;
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xls");
                $spreadsheet = $reader->load($ruta);
                $sheet = $spreadsheet->getActiveSheet();
                foreach ($sheet->getRowIterator(10) as $row) {
                    $cellIterator = $row->getCellIterator("D","K");
                    $cellIterator->setIterateOnlyExistingCells(false);
                    foreach ($cellIterator as $cell) {
                        if (!is_null($cell)) {
                            $value = $cell->getValue();
                            array_push($arreglo, $value);
                        }
                    }
                }
                $exito = 0;
                $largo = (count($arreglo))-1;
                while(($cont)<=$largo) {
                    if (($cont) < $largo) {
                    $cont++;
                    $rut = $arreglo[$cont];
                    echo '<script> console.log('.$rut.')</script>';
                    } else {
                        echo '<script> console.log('.$rut.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $dv = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $ap_p_alumno = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $ap_m_alumno = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $nom_alumno = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $vtr = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $Carrera = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    if (($cont) < $largo) {
                    $cont++;
                    $correo = $arreglo[$cont];
                    echo '<script> console.log('.$cont.')</script>';
                    } else {
                        echo '<script> console.log('.$cont.')</script>';
                        break;
                    }

                    $verificacion = "SELECT * from alumno_curso where rutalumno = '$rut' and idcurso = '$select';";
                    $exito++;
                    $pre_rs = mysqli_query($link, $verificacion);

                    $contar = mysqli_num_rows($pre_rs);

                    if ($contar == 0) {

                        echo('<pre>');
                        echo($correo);
                        echo('</pre>');
                        $verificacion2 = "SELECT * from alumno where rutalumno = '$rut'";
                        $exito2++;
                        $pre_rs2 = mysqli_query($link, $verificacion);
    
                        $contar2 = mysqli_num_rows($pre_rs);
                        if ($contar2 == 0) {
                            $consulta = "INSERT into alumno (rutalumno, nombres, correoalumno, appaterno, apmaterno) values ('$rut', '$nom_alumno', '$correo', '$ap_p_alumno', '$ap_m_alumno')";

                            $resultset = mysqli_query($link, $consulta);
                        
                            $tabla_usuario = "SELECT id_usuario from usuario order by id_usuario desc limit 1";

                            $resultset2 = mysqli_query($link, $tabla_usuario);

                            $valor = mysqli_fetch_array($resultset2);

                            $aumento = $valor[0];

                            $aumento++;

                            $consulta2 = "INSERT into usuario (id_usuario, rut_usuario, correo_usuario, password_usuario, privilegio) values ($aumento, '$rut', '$correo', '$rut', 3)";

                            $resultset3 = mysqli_query($link, $consulta2) or die ("Error en la consulta"); 
                        }

                        $consulta3 = "INSERT into alumno_curso (rutalumno, idcurso, fecha) values ('$rut', '$select', '$fecha')";
    
                        $resultset4 = mysqli_query($link, $consulta3) or die ("Error en la consulta");
                    

                        if ($resultset && $resultset2) {
                            if ($exito <= sizeof($arreglo)) {
                                echo "Alumnos cargados con exito";
                            }
                        } else {
                            echo "Ocurrio un problema en la operacion";
                            break;
                        }
                    } else {

                    }

                }
        }else{
            echo "Archivo no se pudo guardar";
        }
    }
?>