<?php
require '../../vendor/autoload.php'; # У меня данный файл находился на уровень выше


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//Создаем экземпляр класса электронной таблицы
$spreadsheet = new Spreadsheet();
//Получаем текущий активный лист
$sheet = $spreadsheet->getActiveSheet();
// Записываем в ячейку A1 данные
$sheet->setCellValue('A1', '№');
$sheet->setCellValue('B1', 'Авторы');
$sheet->setCellValue('C1', 'Курс');
$sheet->setCellValue('D1', 'Добавлено лекций');
$sheet->setCellValue('E1', 'Заполнено лекций');
$sheet->setCellValue('F1', 'Добавлено презентаций');
$sheet->setCellValue('G1', 'Добавлена информация о курсе');
$sheet->getRowDimension(1)->setRowHeight(50);
$sheet->getColumnDimension('B')->setWidth(70);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

  $sql = "SELECT * FROM `teacher`";      #Получение данных из таблицы teacher
  $result = mysqli_query($dbo, $sql);
  $teacher = mysqli_fetch_all($result, true);

   #echo '<pre>';       #Тестовый просмотр именованного массива $teacher
   #echo print_r($teacher);
   #echo '</pre>';

  $i = 2;
  foreach ($teacher as $key => $value) {       
    $sheet->setCellValue('A'.$i, $i-1);       #Заполнение поля Номер

    $sheet->setCellValue('B'.$i, $value['first_name'].' '.$value['name'].' '.$value['last_name']);  #Заполнение поля ФИО

    $teach_id = $value['id'];
    $sql = "SELECT * FROM `kurs_info` WHERE `user_id` = $teach_id";         #Получение данных из таблицы kurs_info
    $result = mysqli_query($dbo, $sql);
    $kurs_info = mysqli_fetch_all($result, true);

    $sheet->setCellValue('C'.$i, $kurs_info[0]['kurs_name']);     #Заполнение поля Курс  

    $kurs_id = $kurs_info[0]['id'];
    $sql = "SELECT * FROM `theme` WHERE `kurs_id` = $kurs_id";    #Получение данных из таблицы theme
    $result = mysqli_query($dbo, $sql);
    $theme = mysqli_fetch_all($result, true);

    $sheet->setCellValue('D'.$i, count($theme));    #Заполнение поля Добавлено лекций 

    $i += 1;

  };


$writer = new Xlsx($spreadsheet);
//Сохраняем файл в текущей папке, в которой выполняется скрипт.
//Чтобы указать другую папку для сохранения. 
//Прописываем полный путь до папки и указываем имя файла
$writer->save('hello.xlsx');
