<!DOCTYPE html>
<html>
    <head>
        <title>Brush</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            .content span.error {
                display:none;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="post" action="/create-design" enctype="multipart/form-data">
                    Name: <input type="text" name="name" value="">
                    <span class="error">* Invalid Name</span>
                    <br><br>
                    Description: <input type="text" name="description" value="">
                    <span class="error">* Invalid Description</span>
                    <br><br>
                    Artist Id: <input type="text" name="artist_id" value="">
                    <span class="error">* Invalid Artist Id</span>
                    <br><br>
                    Tshirt Price: <input type="text" name="tshirt_price" value="">
                    <span class="error">* Invalid Price</span>
                    <br><br>
                    Tshirt Sale Limit: <input type="text" name="tshirt_limit" value="">
                    <span class="error">* Invalid Limit</span>
                    <br><br>
                    Canvas Price: <input type="text" name="canvas_price" value="">
                    <span class="error">* Invalid Price</span>
                    <br><br>
                    Canvas Sale Limit: <input type="text" name="canvas_limit" value="">
                    <span class="error">* Invalid Limit</span>
                    <br><br>
                    Image: <input type="file" name="image" value="">
                    <span class="error">* Invalid Image</span>
                    <br><br>
                    Tshirt Image: <input type="file" name="tshirt_image" value="">
                    <span class="error">* Invalid Image</span>
                    <br><br>
                    Canvas Image: <input type="file" name="canvas_image" value="">
                    <span class="error">* Invalid Image</span>
                    <br><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>
