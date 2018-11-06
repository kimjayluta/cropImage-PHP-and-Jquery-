<?php
if (! empty($_POST["upload"])) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $targetPath = "uploads/" . $_FILES['userImage']['name'];
        if (move_uploaded_file($_FILES['userImage']['tmp_name'], $targetPath)) {
            $uploadedImagePath = $targetPath;
        }
    }
}
?>
<html>
<head>
    <title>Crop image</title>
    <link rel="stylesheet" href="jCrop/jquery.Jcrop.min.css" type="text/css" />
    <style>
        body {
            width: 550px;
            font-family: Arial;
        }

        .bgColor {
            width: 100%;
            height: 500px;
            background-color: #fff4be;
            border-radius: 4px;
            margin-bottom: 30px;
            margin-left: 350px;
            text-align: center;
        }

        .inputFile {
            padding: 5px;
            background-color: #FFFFFF;
            border: #F0E8E0 1px solid;
            border-radius: 4px;
        }

        .btnSubmit {
            background-color: #696969;
            padding: 5px 30px;
            border: #696969 1px solid;
            border-radius: 4px;
            color: #FFFFFF;
            margin-top: 10px;
        }

        #uploadFormLayer {
            padding: 20px;
        }

        input#crop {
            padding: 5px 25px 5px 25px;
            background: lightseagreen;
            border: #485c61 1px solid;
            color: #FFF;
            visibility: hidden;
        }

        #cropped_img {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="bgColor">
    <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
        <div id="uploadFormLayer">
            <input name="userImage" id="userImage" type="file" class="inputFile">
            <input type="submit" name="upload" value="Submit" class="btnSubmit">
        </div>
    </form>
    <!-- Print image here when crop is done-->
    <div>
        <img src="<?php echo $uploadedImagePath; ?>" id="cropbox" class="img" style="width: 100%; height: 100%;"/><br />
    </div>
    <!-- Button to crop image -->
    <div id="btn">
        <input type='button' id="crop" value='CROP'>
    </div>
    <!-- Print image here when upload function is done-->
    <div>
        <img src="#" id="cropped_img" style="display: none;">
    </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="jCrop/jquery.Jcrop.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var size;
        $('#cropbox').Jcrop({
            aspectRatio: 1,
            onSelect: function(c){
                size = {x:c.x,y:c.y,w:c.w,h:c.h};
                $("#crop").css("visibility", "visible");
            }
        });

        $("#crop").click(function(){
            var img = $("#cropbox").attr('src');
            $("#cropped_img").show();
            $("#cropped_img").attr('src','image-crop.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img);
        });
    });
</script>
</body>
</html>