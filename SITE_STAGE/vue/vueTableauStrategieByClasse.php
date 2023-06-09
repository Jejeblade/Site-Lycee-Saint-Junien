<button type="button" id="export_button" class="btn btn-success btn-sm">Télécharger</button>
<br>
<div id="tableStrategie">
        <div id="employee_data">
            <table class="tableStrategie">

                <th colspan="2" rowspan="2"><a href="index.php?action=recap&id=<?php echo $classeDeListe['idClasse']; ?>">Récapitulif des compétences travaillées</a></th>



                <?php



                foreach ($listeCompetence as $uneCompetence) {
                    $nbSousCompInCompChapeau =  getCountCompetenceId($uneCompetence['idCompetence']);
                    $maxSousComp = $nbSousCompInCompChapeau['num'];
                ?>
                    <th colspan=<?php echo $maxSousComp; ?>><?php echo $uneCompetence['libelleCompetence'] . ' ' . $uneCompetence['intituleCompetence'] ?></th>

                <?php



                }
                ?>
                <tr>

                    <?php
                    foreach ($listeCompetence as $uneCompetence) {


                        foreach ($listeSousCompetence as $uneSousCompetence) {
                            $listeSousCompetence = getSousCompetenceById($uneCompetence['idCompetence']);
                        }

                        foreach ($listeSousCompetence as $uneSousCompetence) {
                    ?>

                            <th><?php echo $uneSousCompetence['libelleCompetence'] . '.'
                                    . $uneSousCompetence['libelleSousCompetence'] . ' ' . $uneSousCompetence['intituleSousCompetence'] ?></th>

                    <?php

                        }
                    }
                    ?>
                </tr>

                <tr>

                    <th>Numéro de la semaine</th>
                    <th>Nom de l'activité</th>
                    <?php
                    foreach ($listeCompetence as $uneCompetence) {


                        foreach ($listeSousCompetence as $uneSousCompetence) {
                            $listeSousCompetence = getSousCompetenceById($uneCompetence['idCompetence']);
                        }

                        foreach ($listeSousCompetence as $uneSousCompetence) {


                            $nbSousCompetence = nombreSousCompetenceVu($uneSousCompetence['idSousCompetence'], $classe);
                            $nombre = $nbSousCompetence['nbSousCompetence'];


                    ?>

                            <th> <?php echo $nombre ?></th>
                    <?php

                        }
                    }



                    ?>
                </tr>

                <?php
                $test = 0;
                $test2 = 0;
                foreach ($listeSemaine as $uneSemaine) {



                    if ($test == $uneSemaine['idWeekDebut'] && $test2 == $uneSemaine['idWeekFin']) {
                ?>
                        <tr>
                            <th><?php echo $uneSemaine['nomActivite']; ?></th>
                        <?php
                    } else {
                        $nbActiviteParSemaine = getCountSemaine($uneSemaine['idWeekDebut'], $uneSemaine['idWeekFin'], $classe);
                        $nbActiviteParSemaine = $nbActiviteParSemaine['num'];
                        ?>
                        <tr>
                            <th rowspan="<?php echo $nbActiviteParSemaine; ?>">
                                <?php
                                if ($uneSemaine['idWeekDebut'] != $uneSemaine['idWeekFin']) {
                                    echo $uneSemaine['idWeekDebut'] . '-' . $uneSemaine['idWeekFin'];
                                } else {
                                    echo $uneSemaine['idWeekDebut'];
                                } ?>

                            </th>

                            <th><?php echo $uneSemaine['nomActivite']; ?></th>

                            <?php
                            $test = $uneSemaine['idWeekDebut'];
                            $test2 = $uneSemaine['idWeekFin'];
                        }

                        foreach ($listeCompetence as $uneCompetence) {


                            foreach ($listeSousCompetence as $uneSousCompetence) {
                                $listeSousCompetence = getSousCompetenceById($uneCompetence['idCompetence']);
                            }

                            $listeSousCompetenceParSemaine = getSousCompetenceClasse($uneSemaine['idWeekDebut'], $uneSemaine['idActivite']);


                            foreach ($listeSousCompetence as $uneSousCompetence) {
                            ?><td><?php
                                    $verif = 0;

                                    foreach ($listeSousCompetenceParSemaine as $uneSousCompetenceParSemaine) {
                                    ?>


                                        <?php
                                        if ($verif == 0) {
                                            if ($uneSousCompetence['idSousCompetence'] == $uneSousCompetenceParSemaine['idSousCompetence']) {
                                                $verif = 1;
                                        ?><div id="cyan">X</td>
        </div><?php
                                                $verif = 1;
                ?>
    <?php
                                            }
                                        }
                                    }
                                }
                            }

    ?>
    </tr>
    <?php
                }


    ?>



    </table>
    </div>
    </div>
    <script>
        function html_table_to_excel(type, name) {
            var data = document.getElementById('employee_data');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });

            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });

            XLSX.writeFile(file, name +'.' + type);
        }

        const export_button = document.getElementById('export_button');
        var name = <?php echo json_encode($uneClasseId['niveauClasse'].'-'.$uneClasseId['nomDiplome'].'-'.$annee); ?>;
        export_button.addEventListener('click', () => {
            html_table_to_excel('xlsx', name);
        });
    </script>