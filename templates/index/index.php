<?php \controllers\internals\Incs::head(); ?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li class = "active"><a href="#">Liste des sites</a></li>
                <li><a href="./connexion">Connexion</a></li>
                <li><a href="./ajoutersite">Ajouter un site</a></li>
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
                    <td><a type="button" role="button" class="btn btn-warning">Supprimer</a></td>
                    <td><a href="historique/<?php $this->s($site['id']); ?>" type="button" role="button" class="btn btn-info">Historique</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>