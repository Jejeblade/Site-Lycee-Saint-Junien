<?php
include_once "../modele/bd_activite.php";
include_once "../modele/bd_competence.php";

if (!empty($_POST['idClasse'])) {
        $idCompetence = $_POST['idClasse'];
        $listeCompetence = getCompetenceChapeauByDiplomeFromClasse($idCompetence);
        for ($i = 1; $i <= 4; $i++) {
                $competence = "competence" . $i . "";
                $fonction = "sousCompetence" . $i . "(this.value);";
?>
                <select name="<?php echo $competence; ?>" onchange="<?php echo $fonction ?>;">
                        <option value="">--Choisir Une Compétence--</option>
                        <?php
                        foreach ($listeCompetence as $uneCompetence) { ?>
                                <option value="<?php echo $uneCompetence['idCompetence']; ?>"><?php echo $uneCompetence['libelleCompetence'] . ' ' . $uneCompetence['intituleCompetence']; ?></option>
                        <?php }
                        ?>
                </select>
        <?php
        }
}


if (!empty($_POST['idSousCompetence1'])) {
        $idSousCompetence = $_POST['idSousCompetence1'];

        $listeSousCompetence = getSousCompetenceById($idSousCompetence);

        ?>
        </br>
        <select name='sous_Competence1' onchange="apresChoix1(this.value);">
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['idSousCompetence2'])) {
        $idSousCompetence = $_POST['idSousCompetence2'];

        $listeSousCompetence = getSousCompetenceById($idSousCompetence);

?> </br>
        <select name='sous_Competence2' onchange="apresChoix2(this.value);">
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['idSousCompetence3'])) {
        $idSousCompetence = $_POST['idSousCompetence3'];

        $listeSousCompetence = getSousCompetenceById($idSousCompetence);

?> </br>
        <select name='sous_Competence3' onchange="apresChoix3(this.value);">
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['idSousCompetence4'])) {
        $idSousCompetence = $_POST['idSousCompetence4'];

        $listeSousCompetence = getSousCompetenceById($idSousCompetence);

?> </br>
        <select name='sous_Competence4' onchange="apresChoix4(this.value);">
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}


if (!empty($_POST['choix1'])) {

        $idSousCompetence = $_POST['choix1'];
        $idCompetence = getCompetenceBySousCompetence($idSousCompetence);
        $idCompetence = $idCompetence['idCompetence'];
        $listeSousCompetence = getSousCompetenceNotIn($idCompetence,$idSousCompetence);
?> </br>
        <select name='sous_Competence5'>
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['choix2'])) {

        $idSousCompetence = $_POST['choix2'];
        $idCompetence = getCompetenceBySousCompetence($idSousCompetence);
        $idCompetence = $idCompetence['idCompetence'];
        $listeSousCompetence = getSousCompetenceNotIn($idCompetence,$idSousCompetence);
?> </br>
        <select name='sous_Competence6'>
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['choix3'])) {

        $idSousCompetence = $_POST['choix3'];
        $idCompetence = getCompetenceBySousCompetence($idSousCompetence);
        $idCompetence = $idCompetence['idCompetence'];
        $listeSousCompetence = getSousCompetenceNotIn($idCompetence,$idSousCompetence);
?> </br>
        <select name='sous_Competence7'>
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}

if (!empty($_POST['choix4'])) {

        $idSousCompetence = $_POST['choix4'];
        $idCompetence = getCompetenceBySousCompetence($idSousCompetence);
        $idCompetence = $idCompetence['idCompetence'];
        $listeSousCompetence = getSousCompetenceNotIn($idCompetence,$idSousCompetence);
?> </br>
        <select name='sous_Competence8'>
                <option value="">--Choisir Une Sous-Compétence--</option>
                <?php
                foreach ($listeSousCompetence as $uneSousCompetence) { ?>
                        <option value="<?php echo $uneSousCompetence['idSousCompetence']; ?>"><?php echo $uneSousCompetence['libelleCompetence'] . '.' . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence']; ?></option>
                <?php }
                ?>
        </select>
<?php
}
?>
