BEGIN

	DECLARE animalList VARCHAR(4000) DEFAULT ' '; 

	DECLARE c INT;
	DECLARE n VARCHAR(250);
	DECLARE s VARCHAR(250);
	DECLARE d INT;

	DECLARE condition_satisfaite BOOLEAN DEFAULT FALSE;
    
    DECLARE curseur_resultat CURSOR FOR
        (SELECT codeespece,nombapteme,sexe,datenaissance FROM animal
			WHERE codeespece = code);
	
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET condition_satisfaite = true;
    
	OPEN curseur_resultat;

        FETCH curseur_resultat INTO c,n,s,d;
		WHILE (NOT condition_satisfaite) DO
        
			SET animalList = CONCAT_WS(" ",animalList,c,n, s, d, ";");
			FETCH curseur_resultat INTO c,n,s,d;



		END WHILE;

	CLOSE curseur_resultat;

	RETURN animalList;

END