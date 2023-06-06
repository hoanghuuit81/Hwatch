<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Duyệt ảnh</title>
    <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.21.0/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var funcNum= <?php echo $_GET['CKEditorFuncNum'].';'; ?>

            $('#imageList').on('click','img',function(){
                var fileUrl = $(this).attr('title');
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();

            });
        });
    </script>

    <style type="text/css">
        ul.file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }    

        ul.file-list li{
            float: left;
            margin: 5px;
            border: 1px solid rgb(170, 166, 166);
            padding: 10px;
        }

        ul.file-list img{
            display: block;
            margin: 0 auto;

        }
        ul.file-list li:hover{
            background: cornsilk;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <div id="imageList">
        @foreach($fileNames as $file)
            <div class="thumbnail">
                <ul class="file-list">
                    <li>
                        <img src="{{asset('uploads/ckeditor/'.$file)}}" alt="thumb" title="{{asset('uploads/ckeditor/'.$file)}}" width="120" height="130" > 
                        <br>
                        <span style="color: blue" >{{ $file }}</span>   
                    </li>    
                </ul>    
            </div>
        @endforeach
    </div>
</body>
</html>