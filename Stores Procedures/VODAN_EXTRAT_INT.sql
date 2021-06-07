create function VODAN_EXTRACT_INT(objeto json, roww int, tag varchar(255)) returns int
BEGIN
        DECLARE info VARCHAR(128);
	IF roww IS NULL THEN 
	        SET info = JSON_EXTRACT(objeto, CONCAT('$[' , tag, ']' ));
	ELSE
        	SET info = JSON_EXTRACT(objeto, CONCAT('$[', roww, '].', tag ));
	END IF;

        IF info IS NULL THEN
                RETURN NULL;
        END IF;
        
        SET info = JSON_UNQUOTE(info);
                
        IF info = '' THEN
                RETURN NULL;
        END IF;
        
        RETURN CAST(info AS UNSIGNED); 
END;


