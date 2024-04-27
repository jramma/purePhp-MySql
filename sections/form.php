<div class="filtros">
    <form action="" method="get">
        <label for="orden">Ordenar por:</label>
        <select name="orden">
            <option value="nombre_asc">Nombre (A-Z)</option>
            <option value="nombre_desc">Nombre (Z-A)</option>
            <option value="tiempo_asc">Tiempo de preparación (ascendente)</option>
            <option value="tiempo_desc">Tiempo de preparación (descendente)</option>
        </select>
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <option value="">Todas</option>
            <option value="italiana">Italiana</option>
            <option value="vegana">Vegana</option>
            <option value="postre">Postre</option>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
            <option value="snack">Snack</option>
        </select>
        <label for="dificultad">Nivel de dificultad:</label>
        <select name="dificultad">
            <option value="">Todos</option>
            <option value="bajo">Bajo</option>
            <option value="medio">Medio</option>
            <option value="alto">Alto</option>
        </select>
        <input type="submit" value="Aplicar filtros">
    </form>
</div>
<style>
    .filtros {
        padding: 1rem;
        background-color: #374435;
    }

    form {
        display: flex;
        gap: 1rem;
        width: 100%;
        flex-wrap: wrap;
    }

    /* Estilos para pantallas de tamaño medio (tabletas, etc.) */
    @media screen and (max-width: 768px) {
        form {
            flex-direction: column;
        }
    }
</style>