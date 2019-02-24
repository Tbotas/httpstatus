<?php \controllers\internals\Incs::head(); ?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.html">Super_TP</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="./">Liste des sites</a></li>
                <li class="active"><a href="#">Connexion</a></li>
                <li><a href="./ajoutersite">Ajouter un site</a></li>
            </ul>
        </div>
    </nav>
    
    <form action="./login" class = "formulaires">
        <div class = "form-group">
            <label for = "InputEmail">Addresse email</label>
            <input name="email" type = "email" class = "form-control" id = "InputEmail" placeholder="Entrez votre addresse email">
        </div>
        <div class = "form-group">
            <label for = "InputMdp">Mot de passe</label>
            <input name="password" type = "password" class = "form-control" id = "InputEmail" placeholder="Entrez votre mot de passe">
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>

</body>

</html>