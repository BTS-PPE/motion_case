DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetItems`()
SELECT * FROM `coque` 
JOIN `motif` ON coque.Id_motif = motif.Id_motif 
JOIN `modele` ON coque.Id_modele = modele.Id_modele$$
DELIMITER ;