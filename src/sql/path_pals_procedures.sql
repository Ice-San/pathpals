-- === PROCEDURES ===

-- 1. CREATE TICKET STATUS

DELIMITER $$
CREATE PROCEDURE create_ticket_status(t VARCHAR(10))
BEGIN
	IF t = "open" OR t = "pending" OR t = "close" THEN
		INSERT INTO ticket_status(ts_status)
		VALUES(t);
	END IF;
END $$
DELIMITER ;

-- 2. CREATE RIDE TYPE

DELIMITER $$
CREATE PROCEDURE create_ride_types(t VARCHAR(10))
BEGIN
	IF t = "requested" OR t = "proposed" THEN
		INSERT INTO ride_types(rt_type)
		VALUES(t);
    END IF;
END $$
DELIMITER ;

-- 3. CREATE USER

DELIMITER $$
CREATE PROCEDURE create_user(un VARCHAR(50), e VARCHAR(100), n VARCHAR(50), ln VARCHAR(50), g VARCHAR(20), p VARCHAR(255), t VARCHAR(10), l INT)
BEGIN
	DECLARE user_exists INT;

    SELECT COUNT(*) INTO user_exists FROM users WHERE u_email = e;

    IF user_exists > 0 THEN
        LEAVE create_user;
    END IF;

	INSERT INTO users(u_username, u_email, p_id)
	VALUES(un, e, create_person(n, ln, g));

	SET @u_id = (
		SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
	);

	INSERT INTO passwords(pw_hashed_password, u_id)
	VALUES(p, @u_id);

	SET @ut_admin_id = (
		SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = t
	);

	SET @up_admin_id = (
		SELECT up_id FROM user_permissions AS up WHERE up.up_level = l
	);

	INSERT INTO accounts(u_id, ut_id, up_id)
	VALUES(@u_id, @ut_admin_id, @up_admin_id);
END $$
DELIMITER ;

-- 4. REQUEST ACCOUNT

DELIMITER $$
CREATE PROCEDURE request_account(c VARCHAR(40), un VARCHAR(50), e VARCHAR(100), n VARCHAR(50), ln VARCHAR(50), g VARCHAR(20), p VARCHAR(255), t VARCHAR(10), l INT)
BEGIN
	SET @i_id = (
		SELECT i_id FROM institutions AS i WHERE i.i_code = c
	);
    
    IF EXISTS (SELECT i_id FROM institutions AS i WHERE i.i_code = c) THEN
		CALL create_user(un, e, n, ln, g, p, t, l);
    
		INSERT INTO institutions_account(i_id, a_id)
		VALUES(@i_id, LAST_INSERT_ID());
    END IF;
END $$
DELIMITER ;

-- 5. UPDATE STATUS TICKET

DELIMITER $$
CREATE PROCEDURE update_status_ticket(e VARCHAR(100), s VARCHAR(20))
BEGIN
	SET @u_id = (
		SELECT u_id FROM users AS u WHERE u.u_id = get_user_id(e)
	);

	SET @ts_id = (
		SELECT ts_id FROM ticket_status AS ts WHERE ts.ts_status = s
	);

	INSERT INTO tickets(u_id, ts_id)
	VALUES(@u_id, @ts_id);
END $$
DELIMITER ;

-- 6. CREATE A CONNECTION

DELIMITER $$
CREATE PROCEDURE create_connection(r INT,de VARCHAR(100), te VARCHAR(100))
BEGIN
	INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
	VALUES(r, get_user_id(de), get_user_id(te));
END $$
DELIMITER ;

-- 7. GET ALL OFFERS

DELIMITER $$
CREATE PROCEDURE get_all_offers()
BEGIN
    SELECT * FROM all_offers_view;
END $$
DELIMITER ;

-- 8. GET ALL REQUESTS

DELIMITER $$
CREATE PROCEDURE get_all_requests()
BEGIN
    SELECT * FROM all_requested_view;
END $$
DELIMITER ;

-- 9. GET USER OFFER

DELIMITER $$
CREATE PROCEDURE get_user_offers(user_email VARCHAR(255))
BEGIN
    SELECT * FROM all_offers_view AS aov WHERE aov.user_email = user_email;
END $$
DELIMITER ;

-- 10. GET USER REQUESTS

DELIMITER $$
CREATE PROCEDURE get_user_requests(user_email VARCHAR(255))
BEGIN
    SELECT * FROM all_requested_view AS arv WHERE arv.user_email = user_email;
END $$
DELIMITER ;

-- 11. CREATE ADD OFFERS

DELIMITER $$
CREATE PROCEDURE add_offer(email VARCHAR(255), from_location VARCHAR(100), to_location VARCHAR(100), start_datetime DATETIME, end_datetime DATETIME)
BEGIN
	DECLARE u_id INT;

    SET u_id = (
        SELECT u_id FROM users WHERE u_email = email
    );

    INSERT INTO all_offers_view(email, username, career, class, ticket_id, ticket_status, ride_from, ride_to, ride_type, ride_start)
    VALUES(email, (SELECT u_username FROM users WHERE u_id = u_id), (SELECT u_career FROM users WHERE u_id = u_id), (SELECT u_class FROM users WHERE u_id = u_id), NULL, 'pending', from_location, to_location, 'proposed', start_datetime);
END $$
DELIMITER ;

-- 12. CREATE A NEW PROCEDURE TO ADD REQUEST

DELIMITER $$
CREATE PROCEDURE add_request(email VARCHAR(255), from_location VARCHAR(100), to_location VARCHAR(100), start_datetime DATETIME)
BEGIN
    DECLARE u_id INT;

    SET u_id = (
        SELECT u_id FROM users WHERE u_email = email
    );

    INSERT INTO rides(r_from, r_to, r_start, t_id, rt_id)
    VALUES(from_location, to_location, start_datetime, NULL, (SELECT rt_id FROM ride_types WHERE rt_type = 'requested'));
END $$
DELIMITER ;

-- 13. CREATE ACCEPT OFFERS

DELIMITER $$
CREATE PROCEDURE accept_offer(r_id INT, accepting_user_email VARCHAR(255))
BEGIN
    DECLARE num_accepted INT;
    DECLARE driver_u_id INT;
    DECLARE traveler_u_id INT;

    SET num_accepted = (
        SELECT COUNT(*) FROM connections WHERE u_id_traveler = (SELECT u_id FROM users WHERE u_email = accepting_user_email)
    );

    IF num_accepted > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O usuário já aceitou uma oferta';
    ELSE
        SET traveler_u_id = (
            SELECT u_id FROM users WHERE u_email = accepting_user_email
        );

        SET driver_u_id = (
            SELECT u_id_driver FROM connections WHERE r_id = r_id
        );

        UPDATE rides
        SET u_id_traveler = traveler_u_id
        WHERE r_id = r_id;

        INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
        VALUES(r_id, driver_u_id, traveler_u_id);
    END IF;
END $$
DELIMITER ;

-- 14. CREATE ACCEPT REQUEST

DELIMITER $$
CREATE PROCEDURE accept_request(r_id INT, accepting_user_email VARCHAR(255))
BEGIN
    DECLARE num_accepted INT;
    DECLARE driver_u_id INT;
    DECLARE traveler_u_id INT;

    SET num_accepted = (
        SELECT COUNT(*) FROM connections WHERE u_id_driver = (SELECT u_id FROM users WHERE u_email = accepting_user_email)
    );

    IF num_accepted > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O usuário já aceitou uma solicitação';
    ELSE
        SET driver_u_id = (
            SELECT u_id FROM users WHERE u_email = accepting_user_email
        );

        SET traveler_u_id = (
            SELECT u_id_traveler FROM connections WHERE r_id = r_id
        );

        UPDATE rides
        SET u_id_driver = driver_u_id
        WHERE r_id = r_id;

        INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
        VALUES(r_id, driver_u_id, traveler_u_id);
    END IF;
END $$
DELIMITER ;

-- 15. GET CONNECTIONS

DELIMITER $$
CREATE PROCEDURE get_connections(user_email VARCHAR(255))
BEGIN
    DECLARE u_id INT;
    SET u_id = (SELECT u_id FROM users WHERE u_email = user_email);

    SELECT 
        c.c_id,
        r.r_id,
        r.r_from,
        r.r_to,
        r.r_start,
        r.r_end,
        u_driver.u_username AS driver_username,
        u_driver.u_email AS driver_email,
        u_traveler.u_username AS traveler_username,
        u_traveler.u_email AS traveler_email
    FROM 
        connections AS c
    INNER JOIN 
        rides AS r ON c.r_id = r.r_id
    INNER JOIN 
        users AS u_driver ON c.u_id_driver = u_driver.u_id
    INNER JOIN 
        users AS u_traveler ON c.u_id_traveler = u_traveler.u_id
    WHERE 
        u_id = u_id;
END $$
DELIMITER ;

-- 16. CANCEL REQUESTS

DELIMITER $$
CREATE PROCEDURE cancel_requests(user_email VARCHAR(255))
BEGIN
    DECLARE u_id INT;
    
    SET u_id = (SELECT u_id FROM users WHERE u_email = user_email);

    DELETE FROM connections WHERE u_id_traveler = u_id;
END $$
DELIMITER ;

-- 17. CANCEL OFFERS

DELIMITER $$
CREATE PROCEDURE cancel_offers(user_email VARCHAR(255))
BEGIN
    DECLARE u_id INT;
    
    SET u_id = (SELECT u_id FROM users WHERE u_email = user_email);
    
    DELETE FROM connections WHERE u_id_driver = u_id;
END $$
DELIMITER ;

-- 18. GET USER INFO

DELIMITER $$
CREATE PROCEDURE get_user_info(user_email VARCHAR(255))
BEGIN
    SELECT *
    FROM user_data_view
    WHERE u_email = user_email;
END $$
DELIMITER ;