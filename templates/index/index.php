<?php \controllers\internals\Incs::head(); ?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li class = "active"><a href="#">Liste des sites</a></li>
                <?php if (!$logged) { ?>
                <li><a href="./connexion">Connexion</a></li>
                <?php } else {?>
                <li><a href="./deconnexion">Deconnexion</a></li>
                <?php } ?>
                <?php if ($admin) { ?>
                <li class = "active"><a href="./ajoutersite">Ajouter un site</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <h1 style="text-align: center">Liste des sites</h1>

    <div class="tableaux">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">URL</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sites as $site) { ?>
                <tr>
                    <td><?php $this->s($site['url_site']); ?></td>
                    <td><?php $this->s($site['status']); ?></td>
                    <?php if ($admin) { ?>
                    <td><a href="supprimer/<?php $this->s($site['id']); ?>" type="button" role="button" class="btn btn-warning">Supprimer</a></td>
                    <?php } ?>
                    <td><a href="historique/<?php $this->s($site['id']); ?>" type="button" role="button" class="btn btn-info">Historique</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>