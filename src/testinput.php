<!-- php vard_dump $_FILES -->
<?php
    var_dump($_FILES);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("image_visualisation");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <form action="testinput.php" method="post">
        <input type="file" onchange="showPreview(event);" name="uploadfile" accept=".jpg" id="imgInp">
        <input type="submit" value="envoyer">
    </form>
    <div class="image_visualisation">
        <img id="image_visualisation" src="#" alt="">

    </div>
</body>

</html>