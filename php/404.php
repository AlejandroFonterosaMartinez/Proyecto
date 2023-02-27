<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: red;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 1;
        }

        h1 {
            font-size: 84px;
            margin-bottom: 50px;
        }
        p{
            font-size: 24px;
        }
    </style>
</head>

<body>
    <canvas id="canvas"></canvas>
    <div class="content">
        <h1>404</h1>
        <p>PAGINA NO ENCONTRADA</p>
    </div>
    <script src="../javascript/canvas.js"></script>
</body>

</html>