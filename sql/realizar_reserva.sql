CREATE OR REPLACE FUNCTION reserva

(passuser VARCHAR, pass VARCHAR, codigo_vuelo VARCHAR, cant_pasajeros INTEGER, OUT valor integer, OUT razon varchar)

LANGUAGE plpgsql AS $$
DECLARE
    vuelo RECORD;
    personas RECORD;
    cantidad RECORD;
    passports TEXT[];
    passport TEXT;
BEGIN
    IF pass = '' THEN
        valor := 0;
        razon := 'Pasaportes vacíos';
    ELSE
        passports = string_to_array(pass, ',');
        FOREACH passport IN ARRAY passports LOOP
            SELECT COUNT(*) into cantidad FROM persona WHERE pasaporte = passport;
            IF cantidad.count != 1 THEN
                valor := 1;
                razon := 'Pasaportes invalidos o repetidos';
                RETURN;
            END IF;
        END LOOP;
        SELECT * INTO personas FROM persona WHERE pasaporte in (pass);
    END IF;
END $$