<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jrammas</title>
    <link rel="stylesheet" href="style.css">
</head>
<main>
<header>
    <nav>
        <ul>
            <li><a class="a_head" href="/">Home</a></li>
            <li><a class="a_head" href="/#activity_2">Act_2</a></li>
            <li><a class="a_head" href="recipes.php">Recetas</a></li>
            <li><a class="a_head" href="/api/recipes/1">API_recetas</a></li>
            <li><a class="a_head" href="/api/recipe/1">API_receta</a></li>
        </ul>
        <ul>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a class="a_head" href="profile.php">Perfil</a></li>
                <li><a class="a_head" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a class="a_head" href="login.php">Login</a></li>
                <li><a class="a_head" href="signup.php">Sign up</a></li>
            <?php endif; ?>
        </ul>
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
            transition: 0.3s;
        }

        .a_head:hover {
            color: violet;
            text-decoration: underline;
            transition: 0.3s;
        }

        /* Estilos para pantallas de tamaño medio (tabletas, etc.) */
        @media screen and (max-width: 768px) {
            ul {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Estilos para pantallas pequeñas (teléfonos móviles, etc.) */
        @media screen and (max-width: 480px) {
            nav {
                padding: 0.5rem;
            }

            ul {
                gap: 0.5rem;
            }
        }
    </style>