<?php
$uploadDir = 'uploads/';
$fileName = $_FILES['file']['name'];
$fileTmp = $_FILES['file']['tmp_name'];
if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
    echo '文件上传成功！';
} else {
    echo '文件上传失败！';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fileType = $_POST["fileType"];
  $title = $_POST["title"];
  $author = $_POST["author"];
  $publisher = $_POST["publisher"];
  $notes = $_POST["notes"];
  $pageCount = $_POST["pageCount"];
  $dateTime = $_POST["dateTime"];

  $fileName = $title . '_' . $author . '.txt';
  $uploadDir = 'uploads/';
  $uploadPath = $uploadDir . $fileName;

  $fileData = "文件类型: " . $fileType . "\n" .
              "标题: " . $title . "\n" .
              "作者: " . $author . "\n" .
              "发布者: " . $publisher . "\n" .
              "备注: " . $notes . "\n" .
              "页数: " . $pageCount . "\n" .
              "日期和时间: " . $dateTime;

  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  if (file_put_contents($uploadPath, $fileData)) {
    echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
  } else {
    echo "文件上传失败！";
  }
}
?>