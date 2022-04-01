<?php
require '../../Class/database.php';
$db = Database::getInstance();

// définir ma requête
$sql = <<<EOD
            Select pilote.nom, pilote.id, ecurie.nom as nomEcurie
			From pilote
			   join ecurie on pilote.idEcurie = ecurie.id
		    Order by pilote.id;
EOD;
$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($lesLignes);
