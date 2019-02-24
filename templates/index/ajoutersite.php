<?php \controllers\internals\Incs::head(); ?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="./">Liste des sites</a></li>
                <?php if (!$logged) { ?>
                <li><a href="./connexion">Connexion</a></li>
                <?php } else {?>
                <li><a href="./deconnexion">Deconnexion</a></li>
                <?php } ?>
                <?php if ($admin) { ?>
                <li class = "active"><a href="#">Ajouter un site</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    
    <form action="./add_website" method="post" class = "formulaires">
        <div class = "form-group">
            <label for = "InputURL">URL</label>
            <input name="url" class = "form-control" id = "InputURL" placeholder="URL du site">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le site</button>
    </form>

</body>

</html>