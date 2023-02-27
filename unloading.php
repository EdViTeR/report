<?php
require '../vendor/autoload.php';
include ("../database/databaseInfo.php");

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
$sheet->setCellValue('F1', 'Добавлено ' .chr( 13 ) .chr( 10 ) . 'презентаций');
$sheet->setCellValue('G1', 'Добавлена ' .chr( 13 ) .chr( 10 ) . 'информация о курсе');
$sheet->getRowDimension(1)->setRowHeight(50);
$sheet->getColumnDimension('B')->setWidth(70);



$writer = new Xlsx($spreadsheet);
//Сохраняем файл в текущей папке, в которой выполняется скрипт.
//Чтобы указать другую папку для сохранения. 
//Прописываем полный путь до папки и указываем имя файла
$writer->save('../hello.xlsx');