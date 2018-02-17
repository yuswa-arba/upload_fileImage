<?php
require "connect.php";

function upload()
{
    global $db;

    $name_file = $_FILES['file']['name'];
    $size_file = $_FILES['file']['size'];
    $error_file = $_FILES['file']['error'];
    $tmp_file = $_FILES['file']['tmp_name'];

    $ekstensiGambarValidate = ["jpg", "jpeg", "gif", "png"];
    $ekstensiGambar = explode('.', $name_file);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    $name_file_baru = uniqid() . "." . $ekstensiGambar;

    if ($error_file === 4) {
        echo "<script>
                alert('anda harus memilih file terlebih dahulu');
                window.location.href = 'form_upload.php';
              </script>";
    } elseif (!in_array($ekstensiGambar, $ekstensiGambarValidate)) {
        echo "<script>
                alert('anda hanya bisa mengupload file image');
                window.location.href = 'form_upload.php';
              </script>";
    } elseif ($size_file > 20000000) {
        echo "<script>
                alert('anda hanya bisa mengupload file dibawah 10MB');
                window.location.href = 'form_upload.php';
              </script>";
    } else {
        move_uploaded_file($tmp_file, "img/" . $name_file_baru);

        $query = "INSERT INTO upload VALUE ('', '$name_file_baru')";
        $upload = $db->prepare($query);
        if ($upload->execute()) {
            echo "<script>
                    alert('success $name_file_baru');
                    window.location.href = 'form_upload.php';
                  </script>";
        }
    }
}

function show()
{
    global $db;

    $query = "SELECT * FROM upload";
    $data = $db->prepare($query);
    $data->execute();

    return $data;
}