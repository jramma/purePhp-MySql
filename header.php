<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jrammas</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav>
        <div>
            Logo
        </div>
        <ul>
            <li><a class="a_head" href="index.php">Inicio</a></li>
            <li><a class="a_head" href="recipes.php">Recipes</a></li>
        </ul>
        <div>
            Made with ❤️ by <a href="https://jramma.com">jramma</a>
        </div>
    </nav>
</header>

<body>

    <style>
        nav {
            border-bottom: 1px solid #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
        }

        ul {
            display: flex;
            justify-content: space-between;
            list-style: none;
            gap: 2rem;
        }

        .a_head {
            text-decoration: none;
            color: aqua;
            transition: 1s;
        }
        .a_head:hover{
            color: violet;
            text-decoration: underline;
            transition: 1s;
        }
    </style>