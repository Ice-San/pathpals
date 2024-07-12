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
CREATE PROCEDURE add_offer(user_email VARCHAR(255), from_location VARCHAR(100), to_location VARCHAR(100), start_datetime DATETIME, end_datetime DATETIME)
BEGIN
    SET @u_id = (
        SELECT u_id FROM users WHERE u_email = user_email
    );

    INSERT INTO tickets(u_id, ts_id)
    VALUES(@u_id, (SELECT ts_id FROM ticket_status WHERE ts_status = 'pending'));

    SET @t_id = LAST_INSERT_ID();

    SET @rt_id = (
		SELECT rt_id FROM ride_types WHERE rt_type = 'proposed'
    );

    INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
    VALUES(from_location, to_location, start_datetime, end_datetime, @t_id, @rt_id);
END $$
DELIMITER ;

-- 12. CREATE ADD REQUEST

DELIMITER $$
CREATE PROCEDURE add_request(user_email VARCHAR(255), from_location VARCHAR(100), to_location VARCHAR(100), start_datetime DATETIME, end_datetime DATETIME)
BEGIN
    SET @u_id = (
        SELECT u_id FROM users WHERE u_email = user_email
    );

    INSERT INTO tickets(u_id, ts_id)
    VALUES(@u_id, (SELECT ts_id FROM ticket_status WHERE ts_status = 'pending'));

    SET @t_id = LAST_INSERT_ID();

    SET @rt_id = (
		SELECT rt_id FROM ride_types WHERE rt_type = 'requested'
    );

    INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
    VALUES(from_location, to_location, start_datetime, end_datetime, @t_id, @rt_id);
END $$
DELIMITER ;

-- 13. CREATE ACCEPT OFFERS

DELIMITER $$
CREATE PROCEDURE accept_offer(r_id INT, accepting_user_email VARCHAR(255))
BEGIN
    SET @traveler_id = (
            SELECT u_id FROM users WHERE u_email = accepting_user_email
        );

    SET @num_accepted = (
        SELECT COUNT(*) FROM connections WHERE u_id_traveler = @traveler_id
    );

    IF @num_accepted > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O usuário já aceitou uma oferta';
    ELSE
        SET @driver_id = (
            SELECT u_id_driver FROM connections WHERE r_id = r_id
        );

        INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
        VALUES(r_id, @driver_id, @traveler_id);
    END IF;
END $$
DELIMITER ;

-- 14. CREATE ACCEPT REQUEST

DELIMITER $$
CREATE PROCEDURE accept_request(r_id INT, accepting_user_email VARCHAR(255))
BEGIN
    SET @driver_id = (
            SELECT u_id FROM users WHERE u_email = accepting_user_email
        );

    SET @num_accepted = (
        SELECT COUNT(*) FROM connections WHERE u_id_driver = @driver_id
    );

    IF @num_accepted > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O utilizador já aceitou uma oferta ou um pedido';
    ELSE
        SET @traveler_id = (
            SELECT u_id_traveler FROM connections WHERE r_id = r_id
        );

        INSERT INTO connections(r_id, u_id_traveler, u_id_driver)
        VALUES(r_id, @traveler_id, @driver_id);
    END IF;
END $$
DELIMITER ;

-- 15. GET CONNECTIONS

DELIMITER $$
CREATE PROCEDURE get_connections(user_email VARCHAR(255))
BEGIN
    SELECT * FROM all_connections_view WHERE driver_email = user_email OR traveler_email = user_email;
END $$
DELIMITER ;

-- 16. CANCEL REQUESTS

DELIMITER $$
CREATE PROCEDURE cancel_requests(user_email VARCHAR(255))
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = user_email
        );

    DELETE FROM connections WHERE u_id_traveler = @u_id;
END $$
DELIMITER ;

-- 17. CANCEL OFFERS

DELIMITER $$
CREATE PROCEDURE cancel_offers(user_email VARCHAR(255))
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = user_email
        );

    DELETE FROM connections WHERE u_id_driver = @u_id;
END $$
DELIMITER ;

-- 18. GET USER INFO

DELIMITER $$
CREATE PROCEDURE get_user_info(user_email VARCHAR(255))
BEGIN
    SELECT * FROM user_data_view AS udv WHERE udv.user_email = user_email;
END $$
DELIMITER ;

-- 19. DELETE OFFERS

DELIMITER $$
CREATE PROCEDURE delete_offer(user_email VARCHAR(255), ride_id INT)
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = user_email
	);

    IF EXISTS (SELECT * FROM rides WHERE r_id = ride_id AND t_id IN (SELECT t_id FROM tickets WHERE u_id = @u_id)) THEN
        IF EXISTS (SELECT * FROM connections WHERE r_id = ride_id) THEN
            DELETE FROM connections WHERE r_id = ride_id;
        END IF;
        
        DELETE FROM rides WHERE r_id = ride_id;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O usuário não possui essa oferta.';
    END IF;
END $$
DELIMITER ;

-- 20. DELETE REQUESTS

DELIMITER $$
CREATE PROCEDURE delete_request(user_email VARCHAR(255), ride_id INT)
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = user_email
	);

    IF EXISTS (SELECT * FROM rides WHERE r_id = ride_id AND t_id IN (SELECT t_id FROM tickets WHERE u_id = @u_id)) THEN
        IF EXISTS (SELECT * FROM connections WHERE r_id = ride_id) THEN
            DELETE FROM connections WHERE r_id = ride_id;
        END IF;
        
        DELETE FROM rides WHERE r_id = ride_id;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A viagem especificada não é uma solicitação válida ou não está associada ao usuário.';
    END IF;
END $$
DELIMITER ;

-- 21. GET USER PERMISSIONS LEVEL

DELIMITER $$
CREATE PROCEDURE get_user_permissions_level(user_email VARCHAR(255))
BEGIN
	SELECT up.up_level AS permission_level
    FROM accounts AS acc
    INNER JOIN user_permissions AS up ON acc.up_id = up.up_id
    INNER JOIN users AS u ON acc.u_id = u.u_id
    WHERE u.u_email = user_email;
END $$
DELIMITER ;

-- 22. GET USER TYPE

DELIMITER $$
CREATE PROCEDURE get_user_type(user_email VARCHAR(255))
BEGIN
    SELECT ut.ut_type AS user_type
    FROM accounts AS acc
    INNER JOIN user_types AS ut ON acc.ut_id = ut.ut_id
    INNER JOIN users AS u ON acc.u_id = u.u_id
    WHERE u.u_email = user_email;
END $$
DELIMITER ;

-- 23. GET ALL USERS INFO

DELIMITER $$
CREATE PROCEDURE get_all_users_info(user_email VARCHAR(255), user_search VARCHAR(255))
BEGIN    
    SET @u_i_code = (
        SELECT i.i_code 
        FROM users u
        INNER JOIN accounts a ON u.u_id = a.u_id
        INNER JOIN institutions_account ia ON a.a_id = ia.a_id
        INNER JOIN institutions i ON ia.i_id = i.i_id
        WHERE u.u_email = user_email
        LIMIT 1
    );
    
    IF user_search IS NOT NULL THEN
        SELECT * 
        FROM all_users_info_view 
        WHERE institution_code = @u_i_code
          AND email <> user_email
          AND (username LIKE CONCAT('%', user_search, '%') OR email LIKE CONCAT('%', user_search, '%'))
          AND username NOT IN (
              SELECT u.u_username
              FROM users u
              INNER JOIN accounts a ON u.u_id = a.u_id
              INNER JOIN user_types ut ON a.ut_id = ut.ut_id
              WHERE ut.ut_type = 'admin'
          )
          AND username NOT IN (
              SELECT u.u_username
              FROM users u
              INNER JOIN accounts a ON u.u_id = a.u_id
              INNER JOIN user_permissions up ON a.up_id = up.up_id
              WHERE up.up_level = 0
          )
        LIMIT 50;
    ELSE
        SELECT * 
        FROM all_users_info_view 
        WHERE institution_code = @u_i_code
          AND email <> user_email
          AND username NOT IN (
              SELECT u.u_username
              FROM users u
              INNER JOIN accounts a ON u.u_id = a.u_id
              INNER JOIN user_types ut ON a.ut_id = ut.ut_id
              WHERE ut.ut_type = 'admin'
          )
          AND username NOT IN (
              SELECT u.u_username
              FROM users u
              INNER JOIN accounts a ON u.u_id = a.u_id
              INNER JOIN user_permissions up ON a.up_id = up.up_id
              WHERE up.up_level = 0
          )
        LIMIT 50;
    END IF;
END $$
DELIMITER ;

-- 24. CREATE GET OFFERS PROCEDURE

DELIMITER $$
CREATE PROCEDURE get_offers_from_institution(user_email VARCHAR(255))
BEGIN
	SET @i_code = (
		SELECT i.i_code 
        FROM users u
        INNER JOIN accounts a ON u.u_id = a.u_id
        INNER JOIN institutions_account ia ON a.a_id = ia.a_id
        INNER JOIN institutions i ON ia.i_id = i.i_id
        WHERE u.u_email = user_email
	);
    
    SELECT * FROM all_offers_view WHERE institution_code = @i_code;
END $$
DELIMITER ;

-- 25. CREATE GET REQUESTS PROCEDURE

DELIMITER $$
CREATE PROCEDURE get_requests_from_institution(user_email VARCHAR(255))
BEGIN    
	SET @i_code = (
		SELECT i.i_code 
        FROM users u
        INNER JOIN accounts a ON u.u_id = a.u_id
        INNER JOIN institutions_account ia ON a.a_id = ia.a_id
        INNER JOIN institutions i ON ia.i_id = i.i_id
        WHERE u.u_email = user_email
	);
    
    SELECT * FROM all_requested_view WHERE institution_code = @i_code;
END $$
DELIMITER ;

-- 26. DELETE USER

DELIMITER $$
CREATE PROCEDURE delete_user(user_email VARCHAR(255))
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = user_email
	);

	DELETE FROM institutions_account WHERE a_id IN (SELECT a_id FROM accounts WHERE u_id = @u_id);
	DELETE FROM accounts WHERE u_id = @u_id;
	DELETE FROM passwords WHERE u_id = @u_id;
	DELETE FROM users WHERE u_id = @u_id;
END $$
DELIMITER ;

-- 27. UPDATE USER INFO

DELIMITER $$
CREATE PROCEDURE update_user_info(p_user_email VARCHAR(100), p_first_name VARCHAR(50), p_last_name VARCHAR(50), p_age VARCHAR(2), p_username VARCHAR(50), p_career VARCHAR(30), p_class VARCHAR(30), p_location VARCHAR(255), p_about VARCHAR(30), p_password VARCHAR(255))
BEGIN
    SET @u_id = (
		SELECT u_id FROM users WHERE u_email = p_user_email
	);
    

    UPDATE persons
    SET 
        p_first_name = p_first_name,
        p_last_name = p_last_name,
        p_age = p_age
    WHERE p_id = @u_id;
    

    UPDATE users
    SET 
        u_username = p_username,
        u_career = p_career,
        u_class = p_class,
        u_location = p_location,
        u_about = p_about
    WHERE u_id = @u_id;
    
    IF p_password IS NOT NULL THEN
        UPDATE passwords
        SET pw_hashed_password = p_password
        WHERE u_id = u_id;
    END IF;
END $$
DELIMITER ;