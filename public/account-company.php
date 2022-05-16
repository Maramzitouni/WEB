<?php
    require_once("../private/bdd_connect.php");
    include ('menu.php') ;

?>

<section id="mainCompany">
    

    <section>
        <section id="card">
            <div id="modif-account">
                <h3>Modifier votre compte :</h3>
                <form action="#" method="post">

                    <label for="name">Nom de l'entreprise<sup>*</sup></label>
                    <input type="text" placeholder="" value="<?php echo $_SESSION['name'] ; ?>" name="name" id="name" required>

                    <label for="email">E-mail<sup>*</sup></label>
                    <input type="email" value="<?php echo $_SESSION['email'] ; ?>" name="email" id="email" required placeholder="me@LoyaltyCard.fr" value="<?php echo h($user['email']); ?>">

                    <label for="password" >Mot de passe<sup>*</sup></label>
                    <input type="password" id="password" name="password" minlength="8" required value="">

                    <button type="submit" >CONFIRMER</button>

                </form>
            </div>
            <div id="companyPay">
                <?php
                    $req = $bdd->prepare("SELECT * FROM company WHERE id = ?");
                    $req->execute([$_SESSION['user_id']]);
                    $company = $req->fetch();

                ?>
                <H2>Chiffre d'affaire actuel : <span style="font-size: 1.3em;"><?= $company["CA"] ?></span></H2>
                <form action="../private/add_ca.php" method="POST" id="companyForm">
                    <input type="number" min="0" step="0.01" id="CA" name="CA" placeholder="Nouveau chiffre d'affaire" required>
                    <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"]; ?>">
                    <input type="submit">
                </form>
                <div>
                    <?php

                        $coef = 0;
                        $value = intval($company["CA"]);
                        if($value < 200000) $value*=0;
                        elseif($value < 800000) $value*=0.008;
                        elseif($value < 1500000) $value*=0.006;
                        elseif($value < 3000000) $value*=0.004;
                        elseif($value >= 3000000) $value*=0.003;

                    ?>
                    <p>Vous devez payer <span style="font-size: 1.3em;"><?= $value?> €</span> </p>
                    <button>Payer</button>
                </div>
            </div>
        </section>
    </section>
</section>




</body>
</html>
