<?php \controllers\internals\Incs::head(); ?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.html">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="./">Liste des sites</a></li>
                <li><a href="./connexion">Connexion</a></li>
                <li class = "active"><a href="#">Ajouter un site</a></li>
            </ul>
        </div>
    </nav>
    
    <form class = "formulaires">
        <div class = "form-group">
            <label for = "InputURL">URL</label>
            <input class = "form-control" id = "InputURL" placeholder="URL du site">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le site</button>
    </form>

</body>

</html>