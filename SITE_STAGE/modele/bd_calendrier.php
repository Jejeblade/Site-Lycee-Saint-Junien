<?php

include_once "bd_connexion.php";


function insertEvenement($event, $classe, $semaine)
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("INSERT INTO affecter VALUES(:idEvent, :idClasse, :idSemaine)");

        $req->bindValue('idEvent', $event);
        $req->bindValue('idClasse', $classe);
        $req->bindValue('idSemaine', $semaine);
        $req->execute();
    } catch (PDOException $e) {
        echo " <div id='msgErr' class='alert alert-danger mx-auto' role='alert'>
        Il y a déja un événement pour cette classe, cette semaine!
        <br>
        <a href='./?action=event'>retour</a>
        </div>";
        die();
    }
}


function getEvent()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("SELECT * from evenement");


        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}



function getMaxYearAndWeek()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("SELECT `year`, week from time_dimension where id = (select max(id) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getMinYearAndWeek()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("SELECT `year`, week from time_dimension where id = (select min(id) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getDateFin()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("select db_date from time_dimension where db_date =(select max(db_date) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getDateDebut()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("select db_date from time_dimension where db_date =(select min(db_date) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getAnneeFin()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("select year from time_dimension where db_date =(select max(db_date) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getAnneeDebut()
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("select year from time_dimension where db_date =(select min(db_date) from time_dimension)");


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getWeekByDate($dateDebut, $dateFin)
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("SELECT DISTINCT week from time_dimension where db_date BETWEEN :dateDebut and :dateFin ORDER BY id");
        $req->bindValue('dateDebut', $dateDebut);
        $req->bindValue('dateFin', $dateFin);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getEventsByClasseAndWeek($classe, $semaine)
{
    try {
        $connex = connexionPDO();
        $req = $connex->prepare("SELECT idEvent from affecter
        Where  idClasse=:classe and idWeek=:semaine");
        $req->bindValue('classe', $classe);
        $req->bindValue('semaine', $semaine);


        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function supprTableCalendrier()
{
    try {
        $connex = connexionPDO();
        $req =  $connex->prepare("ALTER TABLE affecter DROP FOREIGN KEY fk_week;
        ALTER TABLE attribuer_activite DROP FOREIGN KEY FK_WEEKDEBUT;
        ALTER TABLE attribuer_activite DROP FOREIGN KEY FK_WEEKFIN;
        ALTER TABLE attribuer_activite_matiere DROP FOREIGN KEY FK_WeekDeb10;
        ALTER TABLE attribuer_activite_matiere DROP FOREIGN KEY FK_WeekFin10;
        ALTER TABLE attribuer_activite DROP FOREIGN KEY FK_ACTIVITE11;
        ALTER TABLE attribuer_activite_matiere DROP FOREIGN KEY FK_Activite10;
        TRUNCATE attribuer_activite_matiere;
        TRUNCATE attribuer_activite;
        TRUNCATE affecter;
        TRUNCATE activite; 
        TRUNCATE time_dimension; 
        ALTER TABLE affecter
        ADD CONSTRAINT fk_week
        FOREIGN KEY (idWeek) REFERENCES time_dimension(Week);
        ALTER TABLE attribuer_activite
        ADD CONSTRAINT FK_WEEKDEBUT
        FOREIGN KEY (idWeekDebut) REFERENCES time_dimension(Week);
        ALTER TABLE attribuer_activite
        ADD CONSTRAINT FK_WEEKFIN
        FOREIGN KEY (idWeekFin) REFERENCES time_dimension(Week);
        ALTER TABLE attribuer_activite_matiere
        ADD CONSTRAINT FK_WeekDeb10
        FOREIGN KEY (idWeekDebut) REFERENCES time_dimension(Week);
        ALTER TABLE attribuer_activite_matiere
        ADD CONSTRAINT FK_WeekFin10
        FOREIGN KEY (idWeekFin) REFERENCES time_dimension(Week);
        ALTER TABLE attribuer_activite
        ADD CONSTRAINT FK_ACTIVITE11
        FOREIGN KEY (idActivite) REFERENCES activite(idActivite);
        ALTER TABLE attribuer_activite_matiere
        ADD CONSTRAINT FK_Activite10
        FOREIGN KEY (idActivite) REFERENCES activite(idActivite);");

        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function creeTableCalendrier($dateDebut, $dateFin)
{
    try {
        $connex = connexionPDO();
        $req =  $connex->prepare("CALL fill_date_dimension(:dateDebut, :dateFin)");

        $req->bindValue('dateDebut', $dateDebut, PDO::PARAM_STR);
        $req->bindValue('dateFin', $dateFin, PDO::PARAM_STR);

        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Convertit une date ou un timestamp en français
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}


function dateEN2FR($jour) //$jour au format aaaa-mm-jj
{

    return substr($jour, 8, 2) . substr($jour, 4, 4) . substr($jour, 0, 4);
}
