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
$sheet->getColumnDimension('B')->setWidth(80);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

  $sql = "SELECT * FROM `teacher`";      #Получение данных из таблицы teacher
  $result = mysqli_query($dbo, $sql);
  $data = mysqli_fetch_all($result, true);

      echo '<pre>';       #Тестовый просмотр именованного массива $data
    echo print_r($data);
    echo '</pre>';

  $i = 2;
  foreach ($data as $key => $value) {       #Заполнение поля Номер и поля ФИО
    $sheet->setCellValue('A'.$i, $i-1);
    $sheet->setCellValue('B'.$i, $value['first_name'].' '.$value['name'].' '.$value['last_name']);
    $i += 1;   
  }

  $sql = "SELECT * FROM `kurs_info`";
  $result = mysqli_query($dbo, $sql);
  $data = mysqli_fetch_all($result, true);

  $i = 2;
  foreach ($data as $key => $value) {       #Заполнение поля Номер и поля ФИО
    $sheet->setCellValue('C'.$i, $value['kurs_name']);
    $i += 1;   
  }



$writer = new Xlsx($spreadsheet);
//Сохраняем файл в текущей папке, в которой выполняется скрипт.
//Чтобы указать другую папку для сохранения. 
//Прописываем полный путь до папки и указываем имя файла
$writer->save('hello.xlsx');