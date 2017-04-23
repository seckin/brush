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
                <form method="post" action="/create-artist" enctype="multipart/form-data">
                    Name: <input type="text" name="name" value="">
                    <span class="error">* Invalid Name</span>
                    <br><br>
                    Highlighted Image: <input type="file" name="highlighted_image" value="">
                    <span class="error">* Invalid Image</span>
                    <br><br>
                    Profile Image: <input type="file" name="profile_image" value="">
                    <span class="error">* Invalid Image</span>
                    <br><br>
                    Location: <input type="text" name="location" value="">
                    <span class="error">* Invalid Location</span>
                    <br><br>
                    Description: <input type="text" name="description" value="">
                    <span class="error">* Invalid Description</span>
                    <br><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>
