<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meilleurs Scores</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap"/>
    <script src="../js/scores.js" defer></script>
    <script src="../js/logout.js" defer></script>
</head>
<body class="scores-page">
    <?php include '../_includes/navbar.php'; ?>

    <h1>Tableau des Meilleurs Scores</h1>
    <div class="table-wrapper">
    <table id="scoresTable">
        <thead>
            <tr>
                <th>Position</th>
                <th>Nom</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</body>
</html>