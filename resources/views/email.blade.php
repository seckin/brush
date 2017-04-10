<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

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
                <form method="post" action="/email">
                    Name: <input type="text" name="name" value="">
                    <span class="error">* Invalid Name</span>
                    <br><br>
                    E-mail: <input type="text" name="email" value="">
                    <span class="error">* Invalid Email</span>
                    <br><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>
