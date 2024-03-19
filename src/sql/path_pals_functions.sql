-- === FUNCTIONS ===

-- 1. CREATE USER TYPE

DELIMITER $$
CREATE FUNCTION create_user_type(t VARCHAR(10)) RETURNS INT DETERMINISTIC
BEGIN
    IF t = "admin" OR t = "director" OR t = "user" THEN
		INSERT INTO user_types(ut_type)
		VALUES(t);
        
        RETURN LAST_INSERT_ID();
    END IF;
    
    RETURN 0;
END $$
DELIMITER ;

-- 2. CREATE USER PERMISSION

DELIMITER $$
CREATE FUNCTION create_user_permission(l INT) RETURNS INT DETERMINISTIC
BEGIN
	IF l = 0 OR l = 1 OR l = 2 OR l = 3 THEN	
		INSERT INTO user_permissions(up_level)
		VALUES(0);
        
        RETURN LAST_INSERT_ID();
	END IF;
    
    RETURN 0;
END $$
DELIMITER ;

-- 3. CREATE PERSON

DELIMITER $$
CREATE FUNCTION create_person(n VARCHAR(50), ln VARCHAR(50), g VARCHAR(20)) RETURNS INT DETERMINISTIC
BEGIN
	INSERT INTO persons(p_first_name, p_last_name, p_genre)
	VALUES (n, ln, g);
    
    RETURN LAST_INSERT_ID();
END $$
DELIMITER ;

-- 4. GET USER ID

DELIMITER $$
CREATE FUNCTION get_user_id(e VARCHAR(100)) RETURNS INT DETERMINISTIC
BEGIN
	RETURN (SELECT u_id FROM users AS u WHERE u.email = e);
END $$
DELIMITER ;

-- 5. CREATE TICKET

DELIMITER $$
CREATE FUNCTION create_ticket(e VARCHAR(100)) RETURNS INT DETERMINISTIC
BEGIN
	SET @u_id = (
		SELECT u_id FROM users AS u WHERE u.u_id = get_user_id(e)
	);

	SET @ts_id = (
		SELECT ts_id FROM ticket_status AS ts WHERE ts.ts_status = "open"
	);

	INSERT INTO tickets(u_id, ts_id)
	VALUES(@u_id, @ts_id);
    
    RETURN LAST_INSERT_ID();
END $$
DELIMITER ;

-- 6. CREATE RIDE

DELIMITER $$
CREATE FUNCTION create_ride(e VARCHAR(100)) RETURNS INT DETERMINISTIC
BEGIN
	SET @rt_id = (
		SELECT rt_id FROM ride_types AS rt WHERE rt.rt_type = 'proposed'
	);

	INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
	VALUES('Castelo Branco', 'Lisboa', NOW(), NULL, create_ticket(e), @rt_id);

	SET @r_id = (
		SELECT r_id FROM rides AS r WHERE r.r_id = LAST_INSERT_ID()
	);
    
    RETURN LAST_INSERT_ID();
END $$
DELIMITER ;