

<form method="POST" class="lb mb-3" action="?action=strategie">

    <select aria-label="Default select example" name="classe" onchange="matiere(this.value,<?php echo $_SESSION['idProfesseur'];?>)">


        <?php
        if ($test != "") {
        ?>
            <option selected><?php echo $classeDeListe['niveauClasse'] . " " . $classeDeListe['nomDiplome']; ?></OPTION>
        <?php
        } else {
        ?>
            <option selected>-- Choisissez une Classe --</OPTION>
        <?php
        }

        foreach ($listeClasse as $uneClasse) {
       

        ?>

            <option value=<?php echo $uneClasse['idClasse']; ?>><?php echo $uneClasse['niveauClasse'] . " " . $uneClasse['nomDiplome'] ?></option>
        <?php
        }


        ?>
    </select>

    <div id="ListeMatiere"></div>


</form>