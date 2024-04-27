<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jrammas</title>
</head>

<body>
    <div class="container">
        <h1>Receta Aleatoria</h1>
        <div>
            <?php
            // Incluir el script PHP para obtener la receta
            include 'activity_2.php';
            ?>
        </div>
    </div>

    <div class="container2">
        <h2> Últimas 5 recetas publicadas</h2>
        <div class="box">
            <?=
            include 'activity_3.php';
            ?>
        </div>
    </div>
</body>

</html>
<style>
    :root {
        color-scheme: light dark;

    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 80%;
    }

    .container div {
        max-width: 80%;
    }



    img {
        max-width: 10rem;
        height: 10rem;
        object-fit: cover;
        border-radius: 2rem;
    }

    h2 {
        color: greenyellow;
    }

    .box {
        padding: 1rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    @media screen and (max-width: 1100px) {
        .box {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media screen and (max-width: 800px) {
        .box {
            grid-template-columns: 1fr;
        }
    }

    .receta {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        border: 1px solid #fff;
    }

    .receta_flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }
</style>