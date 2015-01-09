<body>
    <?php
        session_start();
        require_once 'Include/haut.php';
        require_once 'Classe/ListeMachine.php';
        require_once 'Fonctions/Generique.php';
        $listeMachine=new ListeMachine();
        if(empty($_GET['page'])){
            $_SESSION['page']=1;
            $page=$_SESSION['page'];
        }else{
            $_SESSION['page']=$_GET['page'];
            $page=$_SESSION['page'];
            
        }
    ?>
    <div class="container-row">
        <?php 
            require_once 'Vue/menu.php'; 
            if($page==1){
                require_once 'Vue/liste_des_machines.php';
            }elseif($page==2){
                require_once 'Vue/liste_des_serveurs.php';
            }elseif($page==3){
                require_once 'Vue/liste_des_clients.php';
            }elseif($page==4){
                require_once 'Vue/liste_des_peripherique.php';
            }elseif($page==2){
                require_once 'Vue/liste_des_serveurs.php';
            }elseif($page==5){
                require_once 'Vue/chercherMachine.php';
            }elseif($page==6){
                require_once 'Vue/wifi.php';
            }
        ?>
        
    </div>
</body>
</html>
