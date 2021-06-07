create function VODAN_EXTRACT_TXT(objeto json, roww int, tag varchar(255)) returns text
BEGIN
        #DECLARE info varchar(1000);
        DECLARE info TEXT CHARACTER SET utf8;
	IF roww IS NULL THEN 
	        SET info = JSON_EXTRACT(objeto, CONCAT('$[' , tag, ']' ));
	ELSE
        	SET info = JSON_EXTRACT(objeto, CONCAT('$[', roww, '].', tag ));
	END IF;
	SET info = JSON_UNQUOTE(info);
        IF info IS NULL THEN
                RETURN NULL;
        ELSEIF info = '' OR info = "" THEN
                RETURN NULL;
        END IF;
END;

