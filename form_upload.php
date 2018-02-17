<?php
require "proses.php";

$data = show();

if (isset($_POST["upload"])) {
    return upload();
}

?>
    <h1>upload file image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <br><br>
        <button type="submit" id="upload" name="upload">Upload</button>
    </form>
    <br>
<?php
while ($show = $data->fetch(PDO::FETCH_LAZY)) { ?>
    <img src="img/<?= $show->file; ?>" width="80">
<?php } ?>