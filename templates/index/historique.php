<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un site</title>

    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.html">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../">Liste des sites</a></li>
                <li><a href="../connexion">Connexion</a></li>
                <li><a href="../ajoutersite">Ajouter un site</a></li>
            </ul>
        </div>
    </nav>

    <h1 style="text-align: center">URL DU SITE: *url*</h1>

    <div id="liste-historique">
        <ul>
            <?php foreach ($sites as $history) { ?>
            <li><?php $this->s($history['status_code']) ?> : <?php $this->s($history['update_at']) ?></li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>