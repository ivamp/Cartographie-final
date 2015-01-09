<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php?page=1">Cartographie</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="index.php?page=1">Liste des machines</a></li>
            <li><a href="index.php?page=2">Serveurs</a></li>
            <li><a href="index.php?page=3">Clients</a></li>
            <li><a href="index.php?page=4">Routeurs et périphériques</a></li>
            <li><a href="index.php?page=5">Chercher une machine</a></li>
            <li><a href="index.php?page=6">WIFI</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li role="presentation"><a href="#" id="alerteTarget">Alerte <span class="badge"><?php echo"".countAlert().""; ?></span></a></li>
        </ul>
    </div>
</nav>
<div class="row">
    <div class="col-md-2 col-md-offset-10">
        <div id="messageAlerte">
        </div>
    </div>
</div>

<script>
    $("#alerteTarget").click(function () {
        jQuery.ajax({
            type: "GET",
            url: "Vue/alerte.php",
            dataType: "html",
            cache: false,
            async: false,
            data: {},
            success: function (msg) {
                $("#messageAlerte").html(msg);
                ;
            },
            error: function (msg) {
                $("#messageAlerte").html(msg);
            }
        });
    });
</script>