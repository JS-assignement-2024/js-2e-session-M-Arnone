<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap"/>
    <script src="../js/exercises.js" defer></script>
    <script src="../js/logout.js" defer></script>
</head>
<body class="exercise-page">
    <?php include '../_includes/navbar.php'; ?> 
    <p id="user-welcome"></p>

     <div id="question-container">
        <h2 class="title-ex">Choisis les opérations et le nombre d'exercices</h2>
        <button id="btn-addition" onclick="selectOperation('addition')">➕</button>
        <button id="btn-subtraction" onclick="selectOperation('subtraction')">➖</button>
        <button id="btn-multiplication" onclick="selectOperation('multiplication')">✖️</button>
        <button id="btn-division" onclick="selectOperation('division')">➗</button>
        <input type="number" id="num-exercises" placeholder="Nombre d'exercices">
        <button onclick="generateExercises()">Générer les exercices</button>
    </div>
    <div id="drag-drop-container"></div>

    <button id="submit-button" style="display: none;" onclick="submitAnswers()">Valide tes réponses</button>
</body>
</html>