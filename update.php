<?php

include 'db_connect.php'; // 连接到数据库

function submitApplicantInfo($postData)
{
    $requiredFields = ['name', 'sex', 'major', 'college', 'QQ', 'number', 'first_choice'];
    foreach ($requiredFields as $field) {
        if (empty($postData[$field])) {
            header('Content-Type: application/json');
            return json_encode(['Ture' => '', 'error' => "缺少必填字段：{$field},111"]);
        }
    }

    $name = $postData['name'];
    $sex = $postData['sex'];
    $major = $postData['major'];
    $college = $postData['college'];
    $QQ = $postData['QQ'];
    $number = $postData['number'];
    $notes = isset($postData['notes']) ? $postData['notes'] : '';
    $first_choice = $postData['first_choice'];
    $second_choice = isset($postData['second_choice']) ? $postData['second_choice'] : '';
    $third_choice = isset($postData['third_choice']) ? $postData['third_choice'] : '';

    global $conn;

    $stmt = $conn->prepare("insert INTO newstudent (name, sex, major, college, QQ, number, notes, first_choice, second_choice, third_choice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        header('Content-Type: application/json');
        return json_encode(['True' => '', 'error' => '数据库错误: ' . $conn->error]);
    }
    $stmt->bind_param("ssssssssss", $name, $sex, $major, $college, $QQ, $number, $notes, $first_choice, $second_choice, $third_choice);

    $stmt->execute();
    $stmt->close();

    sendToDepartment($first_choice, $postData);
    if ($second_choice) {
        sendToDepartment($second_choice, $postData);
    }
    if ($third_choice) {
        sendToDepartment($third_choice, $postData);
    }
    return json_encode(['True' => '成功', 'error' => '']);
}

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

function sendToDepartment($department, $postData)
{
    $departmentPath = getDepartmentPath($department);

    if (!$departmentPath) {
        return false;
    }

    $filePath = $departmentPath . '.xlsx';

    if (file_exists($filePath)) {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        $foundRow = null;
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($sheet->getCell("F$row")->getValue() == $postData['number']) {
                $foundRow = $row;
                break;
            }
        }

        if ($foundRow) {
            $newRow = $foundRow;
        } else {
            $newRow = $highestRow + 1;
        }
    } else {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', '姓名');
        $sheet->setCellValue('B1', '性别');
        $sheet->setCellValue('C1', '专业');
        $sheet->setCellValue('D1', '学院');
        $sheet->setCellValue('E1', 'QQ');
        $sheet->setCellValue('F1', '电话');
        $sheet->setCellValue('G1', '备注');
        $sheet->setCellValue('H1', '第一志愿');
        $sheet->setCellValue('I1', '第二志愿');
        $sheet->setCellValue('J1', '第三志愿');
        $newRow = 2;
    }

    $sheet->setCellValue("A$newRow", $postData['name']);
    $sheet->setCellValue("B$newRow", $postData['sex']);
    $sheet->setCellValue("C$newRow", $postData['major']);
    $sheet->setCellValue("D$newRow", $postData['college']);
    $sheet->setCellValue("E$newRow", $postData['QQ']);
    $sheet->setCellValue("F$newRow", $postData['number']);
    $sheet->setCellValue("G$newRow", $postData['notes']);
    $sheet->setCellValue("H$newRow", $postData['first_choice']);
    $sheet->setCellValue("I$newRow", $postData['second_choice']);
    $sheet->setCellValue("J$newRow", $postData['third_choice']);

    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    return true;
}


function getDepartmentPath($department)
{
    $departmentPaths = [
        '产品经理与产品运营部' => '产品经理与产品运营部',
        '设计部' => '设计部',
        '技术研发部' => '技术研发部',
        '音视频文化部' => '音视频文化部',
        '新闻通讯部' => '新闻通讯部',
        '外宣部' => '外宣部',
        '行政事务部' => '行政事务部',
        '企划公关部' => '企划公关部',
        '微信推文部' => '微信推文部',
        '媒体运营部' => '媒体运营部'
    ];

    return isset($departmentPaths[$department]) ? $departmentPaths[$department] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = submitApplicantInfo($_POST);

    echo $response;
} else {
    echo json_encode(['Ture' => '','error' => '无效的请求,333']);
}



