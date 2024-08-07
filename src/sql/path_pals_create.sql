DROP DATABASE u325475326_path_pals_db;
CREATE DATABASE u325475326_path_pals_db;

USE u325475326_path_pals_db;

-- === TABLES ===

-- 1. PERSONS

CREATE TABLE persons (
	p_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    p_first_name VARCHAR(50) NULL,
    p_last_name VARCHAR(50) NULL,
    p_age VARCHAR(2) NULL,
    p_genre VARCHAR(20) NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. USERS

CREATE TABLE users (
	u_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    u_username VARCHAR(50) NULL,
    u_email VARCHAR(100) NOT NULL,
    u_career VARCHAR(30) NULL,
    u_class VARCHAR(30) NULL,
    u_location VARCHAR(255) NULL,
    u_about VARCHAR(30) NULL,
    p_id INT NOT NULL,
    
    FOREIGN KEY (p_id) REFERENCES persons(p_id),
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. PASSWORDS

CREATE TABLE passwords (
	pw_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pw_hashed_password VARCHAR(255) NOT NULL,
    u_id INT NOT NULL,
    
    FOREIGN KEY (u_id) REFERENCES users(u_id),
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. USER TYPES

CREATE TABLE user_types (
	ut_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ut_type VARCHAR(50) UNIQUE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. USER PERMISSIONS

CREATE TABLE user_permissions (
	up_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    up_level INT UNIQUE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 6. ACCOUNTS

CREATE TABLE accounts (
	a_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    u_id INT NOT NULL,
    ut_id INT NOT NULL,
    up_id INT NOT NULL,
    
    FOREIGN KEY (u_id) REFERENCES users(u_id),
    FOREIGN KEY (ut_id) REFERENCES user_types(ut_id),
    FOREIGN KEY (up_id) REFERENCES user_permissions(up_id),
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 7. INSTITUTIONS

CREATE TABLE institutions (
	i_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    i_code VARCHAR(30) NOT NULL,
    i_name VARCHAR(40) NULL,
    i_description TEXT NULL,
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 8. INSTITUTIONS ACCOUNT

CREATE TABLE institutions_account (
	ia_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    i_id INT NOT NULL,
    a_id INT NOT NULL,
    
    FOREIGN KEY (i_id) REFERENCES institutions(i_id),
    FOREIGN KEY (a_id) REFERENCES accounts(a_id),
	
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 9. TICKET STATUS

CREATE TABLE ticket_status (
	ts_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ts_status VARCHAR(30) NOT NULL,
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 10. TICKETS

CREATE TABLE tickets (
	t_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    u_id INT NOT NULL,
    ts_id INT NOT NULL,
    
    FOREIGN KEY (u_id) REFERENCES users(u_id),
    FOREIGN KEY (ts_id) REFERENCES ticket_status(ts_id),
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 11. RIDES TYPES

CREATE TABLE ride_types (
	rt_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rt_type VARCHAR(30) NOT NULL,
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 12. RIDES

CREATE TABLE rides (
	r_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    r_from VARCHAR(100) NOT NULL,
    r_to VARCHAR(100) NOT NULL,
    r_start DATETIME NOT NULL,
    r_end DATETIME NULL,
    t_id INT NOT NULL,
    rt_id INT NOT NULL,
    
    FOREIGN KEY (t_id) REFERENCES tickets(t_id),
    FOREIGN KEY (rt_id) REFERENCES ride_types(rt_id),
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 13. CONNECTIONS

CREATE TABLE connections (
	c_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    r_id INT NOT NULL,
    u_id_driver INT NOT NULL,
    u_id_traveler INT NOT NULL,
    
    FOREIGN KEY (r_id) REFERENCES rides(r_id),
    FOREIGN KEY (u_id_driver) REFERENCES users(u_id),
    FOREIGN KEY (u_id_traveler) REFERENCES users(u_id),
    
	createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- === INSERTS ===

-- 1. CREATE USER TYPES

INSERT INTO user_types(ut_type)
VALUES('admin');

INSERT INTO user_types(ut_type)
VALUES('director');

INSERT INTO user_types(ut_type)
VALUES('user');

-- 2. CREATE USER PERMISSIONS

INSERT INTO user_permissions(up_level)
VALUES(0);

INSERT INTO user_permissions(up_level)
VALUES(1);

INSERT INTO user_permissions(up_level)
VALUES(2);

INSERT INTO user_permissions(up_level)
VALUES(3);

-- 3. CREATE TICKET STATUS

INSERT INTO ticket_status(ts_status)
VALUES('open');

INSERT INTO ticket_status(ts_status)
VALUES('pending');

INSERT INTO ticket_status(ts_status)
VALUES('close');

-- 4. CREATE RIDE TYPES

INSERT INTO ride_types(rt_type)
VALUES('requested');

INSERT INTO ride_types(rt_type)
VALUES('proposed');

-- 5. CREATE ADMIN

INSERT INTO persons(p_first_name, p_last_name, p_genre)
VALUES ('Rúben', 'Costa', 'M');

INSERT INTO users(u_username, u_email, p_id)
VALUES('userTest47', 'userTest47@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('admin123admin', @u_id);

SET @ut_admin_id = (
	SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = 'admin'
);

SET @up_admin_id = (
	SELECT up_id FROM user_permissions AS up WHERE up.up_level = 0
);

INSERT INTO accounts(u_id, ut_id, up_id)
VALUES(@u_id, @ut_admin_id, @up_admin_id);

-- 6. CREATE ONE USER DIRECTOR

INSERT INTO persons(p_first_name, p_last_name, p_genre)
VALUES ('Rodrigo', 'Costa', 'M');

INSERT INTO users(u_username, u_email, p_id)
VALUES('userTest45', 'userTest45@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('123', @u_id);

SET @ut_director_id = (
	SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = 'director'
);

SET @up_director_id = (
	SELECT up_id FROM user_permissions AS up WHERE up.up_level = 1
);

INSERT INTO accounts(u_id, ut_id, up_id)
VALUES(@u_id, @ut_director_id, @up_director_id);

-- 7. CREATE ONE USER REGULAR

INSERT INTO persons(p_first_name, p_last_name, p_genre)
VALUES ('Daniel', 'Costa', 'M');

INSERT INTO users(u_username, u_email, p_id)
VALUES('userTest46', 'userTest46@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('123', @u_id);

SET @ut_user_id = (
	SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = 'user'
);

SET @up_user_id = (
	SELECT up_id FROM user_permissions AS up WHERE up.up_level = 2
);

INSERT INTO accounts(u_id, ut_id, up_id)
VALUES(@u_id, @ut_user_id, @up_user_id);

-- 8. CREATE ONE TICKET

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

SET @ts_id = (
	SELECT ts_id FROM ticket_status AS ts WHERE ts.ts_status = "open"
);

INSERT INTO tickets(u_id, ts_id)
VALUES(@u_id, @ts_id);

-- 9. CREATE ONE RIDE

SET @rt_id = (
	SELECT rt_id FROM ride_types AS rt WHERE rt.rt_type = 'proposed'
);

SET @t_id = (
	LAST_INSERT_ID()
);

INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
VALUES('Castelo Branco', 'Lisboa', NOW(), NOW(), LAST_INSERT_ID(), @rt_id);

-- === TESTS BEGIN ===

INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
VALUES('Porto', 'Lisboa', NOW(), NOW(),  @t_id, @rt_id);

INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
VALUES('Coimbra', 'Lisboa', NOW(), NOW(),  @t_id, @rt_id);

-- === TEST END ===

SET @r_id = (
	SELECT r_id FROM rides AS r WHERE r.r_id = LAST_INSERT_ID()
);

-- 10. CREATE A NEW USER REGULAR

INSERT INTO persons(p_first_name, p_last_name, p_genre)
VALUES ('João', 'Machado', 'M');

INSERT INTO users(u_username, u_email, p_id)
VALUES('userTest49', 'userTest49@gmail.com', LAST_INSERT_ID());

SET @driver_u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('123', @u_id);

SET @ut_user_id = (
	SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = 'user'
);

SET @up_user_id = (
	SELECT up_id FROM user_permissions AS up WHERE up.up_level = 2
);

INSERT INTO accounts(u_id, ut_id, up_id)
VALUES(@u_id, @ut_user_id, @up_user_id);

SET @accounts_a_id = (
	SELECT a_id FROM accounts AS a WHERE a.a_id = LAST_INSERT_ID()
);

-- 11. CREATE A CONNECTION

INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
VALUES(@r_id, @driver_u_id, @u_id);

-- 12. CREATE INSTITUTIONS

INSERT INTO institutions(i_code, i_name, i_description)
VALUES("5D84V546ED", "IPC", "Instituto Politécnico de Castelo Branco");

INSERT INTO institutions(i_code, i_name, i_description)
VALUES("5478DF54C1", "ETPS", "Escola Técnologica e Profissional da Sertã");

-- 13. CONNECT INSTITUTION

SET @ipc_id = (
    SELECT i_id FROM institutions WHERE i_code = '5D84V546ED'
);

SET @etps_id = (
    SELECT i_id FROM institutions WHERE i_code = '5478DF54C1'
);

INSERT INTO institutions_account(i_id, a_id)
VALUE(@etps_id, 1);

INSERT INTO institutions_account(i_id, a_id)
VALUE(@etps_id, 2);

INSERT INTO institutions_account(i_id, a_id)
VALUE(@ipc_id, 3);

-- === CREATE VIEWS ===

-- 1. CREATE GET OFFERS VIEW

CREATE VIEW all_offers_view AS
SELECT
    u.u_email AS user_email,
    u.u_username AS username,
    u.u_career AS career,
    u.u_class AS class,
    t.t_id AS ticket_id,
    ts.ts_status AS ticket_status,
    r.r_id AS ride_id,
    r.r_from AS ride_from,
    r.r_to AS ride_to,
    rt.rt_type AS ride_type,
    r.r_start AS ride_start,
    r.r_end AS ride_end,
    i.i_code AS institution_code
FROM
    tickets AS t
INNER JOIN
    users AS u ON t.u_id = u.u_id
INNER JOIN
    ticket_status AS ts ON t.ts_id = ts.ts_id
INNER JOIN
    rides AS r ON t.t_id = r.t_id
INNER JOIN
    ride_types AS rt ON r.rt_id = rt.rt_id
INNER JOIN
    accounts AS a ON u.u_id = a.u_id
INNER JOIN
    institutions_account AS ia ON a.a_id = ia.a_id
INNER JOIN
    institutions AS i ON ia.i_id = i.i_id
WHERE
    rt.rt_type = 'proposed'
    AND DATE(r.r_start) >= CURDATE()
ORDER BY
    r.r_start ASC
LIMIT 100;

-- 2. CREATE GET REQUESTED VIEW

CREATE VIEW all_requested_view AS
SELECT
    u.u_email AS user_email,
    u.u_username AS username,
    u.u_career AS career,
    u.u_class AS class,
    t.t_id AS ticket_id,
    ts.ts_status AS ticket_status,
    r.r_id AS ride_id,
    r.r_from AS ride_from,
    r.r_to AS ride_to,
    rt.rt_type AS ride_type,
    r.r_start AS ride_start,
    r.r_end AS ride_end,
    i.i_code AS institution_code
FROM
    tickets AS t
INNER JOIN
    users AS u ON t.u_id = u.u_id
INNER JOIN
    ticket_status AS ts ON t.ts_id = ts.ts_id
INNER JOIN
    rides AS r ON t.t_id = r.t_id
INNER JOIN
    ride_types AS rt ON r.rt_id = rt.rt_id
INNER JOIN
    accounts AS a ON u.u_id = a.u_id
INNER JOIN
    institutions_account AS ia ON a.a_id = ia.a_id
INNER JOIN
    institutions AS i ON ia.i_id = i.i_id
WHERE
    rt.rt_type = 'requested'
    AND DATE(r.r_start) >= CURDATE()
ORDER BY
    r.r_start ASC
LIMIT 100;

-- 3. CREATE GET ALL CONNECTION VIEW

CREATE VIEW all_connections_view AS
SELECT
    c.c_id AS connection_id,
    r.r_id AS ride_id,
    r.r_from AS ride_from,
    r.r_to AS ride_to,
    r.r_start AS ride_start,
    r.r_end AS ride_end,
    rt.rt_type AS ride_type,
    u_driver.u_id AS driver_id,
    u_driver.u_username AS driver_username,
    u_driver.u_email AS driver_email,
    u_traveler.u_id AS traveler_id,
    u_traveler.u_username AS traveler_username,
    u_traveler.u_email AS traveler_email
FROM
    connections AS c
INNER JOIN
    rides AS r ON c.r_id = r.r_id
INNER JOIN
    ride_types AS rt ON r.rt_id = rt.rt_id
INNER JOIN
    users AS u_driver ON c.u_id_driver = u_driver.u_id
INNER JOIN
    users AS u_traveler ON c.u_id_traveler = u_traveler.u_id;

-- 4. CREATE GET USER INFO VIEW

CREATE VIEW user_data_view AS
SELECT
    p.p_first_name AS first_name,
    p.p_last_name AS last_name,
    p.p_age AS user_birthday,
    p.p_genre AS user_genre,
    u.u_username AS user_username,
    u.u_email AS user_email,
    u.u_career AS user_career,
    u.u_class AS user_class,
    u.u_location AS user_location,
    u.u_about AS user_about,
    i.i_name AS institution_name,
    pw.pw_hashed_password AS user_password
FROM
    persons AS p
JOIN
    users AS u ON p.p_id = u.p_id
JOIN
    accounts AS a ON u.u_id = a.u_id
JOIN
    institutions_account AS ia ON a.a_id = ia.a_id
JOIN
    institutions AS i ON ia.i_id = i.i_id
LEFT JOIN
    passwords AS pw ON u.u_id = pw.u_id;
    
-- 5. CREATE GET ALL USERS INFO VIEW

CREATE VIEW all_users_info_view AS
SELECT 
    u.u_username AS username, 
    u.u_email AS email,
    i.i_code AS institution_code
FROM 
    users u
INNER JOIN 
    accounts a ON u.u_id = a.u_id
INNER JOIN 
    institutions_account ia ON a.a_id = ia.a_id
INNER JOIN 
    institutions i ON ia.i_id = i.i_id;

-- 6. GET ALL TICKETS

CREATE VIEW all_tickets_view AS
SELECT 
	t.t_id AS ticket_id,
    u.u_email AS user_email,
    ts.ts_status AS ticket_status
FROM
	tickets AS t
INNER JOIN
	ticket_status AS ts ON ts.ts_id = t.ts_id
INNER JOIN
	users AS u ON t.u_id = u.u_id;

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
CREATE PROCEDURE create_user(un VARCHAR(50), e VARCHAR(100), n VARCHAR(50), ln VARCHAR(50), g VARCHAR(20), p VARCHAR(255), t VARCHAR(10), l INT, i_code VARCHAR(30)) create_user_label:
BEGIN
	DECLARE user_exists INT;

    SELECT COUNT(*) INTO user_exists FROM users WHERE u_email = e;

    IF user_exists > 0 THEN
        LEAVE create_user_label;
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
    
    SET @i_id = (
		SELECT i_id FROM institutions AS i WHERE i.i_code = i_code
	);
    
    INSERT INTO institutions_account(i_id, a_id)
    VALUES(@i_id, @u_id);
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
    SELECT * FROM all_offers_view AS aov 
    INNER JOIN tickets AS t ON t.t_id = aov.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE ts.ts_status != 'open' AND ts.ts_status != 'close';
END $$
DELIMITER ;

-- 8. GET ALL REQUESTS

DELIMITER $$
CREATE PROCEDURE get_all_requests()
BEGIN
    SELECT *
    FROM all_requested_view AS arv
    INNER JOIN tickets AS t ON t.t_id = arv.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE ts.ts_status != 'open' AND ts.ts_status != 'close';
END $$
DELIMITER ;

-- 9. GET USER OFFER

DELIMITER $$
CREATE PROCEDURE get_user_offers(user_email VARCHAR(255))
BEGIN
    SELECT * FROM all_offers_view AS aov 
    INNER JOIN tickets AS t ON t.t_id = aov.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE aov.user_email = user_email AND ts.ts_status != 'open' AND ts.ts_status != 'close';
END $$
DELIMITER ;

-- 10. GET USER REQUESTS

DELIMITER $$
CREATE PROCEDURE get_user_requests(user_email VARCHAR(255))
BEGIN    
    SELECT *
    FROM all_requested_view AS arv
    INNER JOIN tickets AS t ON t.t_id = arv.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE u.u_email = user_email AND ts.ts_status != 'open' AND ts.ts_status != 'close';
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
        SELECT COUNT(*) FROM connections WHERE u_id_driver = @driver_id
    );

    IF @num_accepted > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O utilizador já aceitou uma oferta';
    ELSE
        /*SET @driver_id = (
            SELECT t.u_id FROM rides AS r
            INNER JOIN tickets AS t ON t.t_id = r.t_id
            INNER JOIN ride_types AS rt ON rt.rt_id = r.rt_id
            WHERE r.r_id = r_id AND rt.rt_type = 'proposed'
        );*/
        
        # ------
        SET @driver_id = (
            SELECT t.u_id
            FROM rides AS r
            INNER JOIN tickets AS t ON t.t_id = r.t_id
            WHERE r.r_id = r_id
        );
        # ------
        
        SET @ticket_id = (
            SELECT t.t_id 
            FROM tickets AS t
            INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
            INNER JOIN rides AS r ON r.t_id = t.t_id
            WHERE t.u_id = @driver_id AND r.r_id = r_id AND ts.ts_status != 'open' AND ts.ts_status != 'close'
        );

        INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
        VALUES(r_id, @driver_id, @traveler_id);
        
        SET @connections_count = (
            SELECT COUNT(*)
            FROM connections AS c
            WHERE c.c_id = LAST_INSERT_ID()
        );
        
        SET @ticket_status_open_id = (
            SELECT ts.ts_id 
            FROM ticket_status AS ts
            WHERE ts.ts_status = 'open'
        );
        
		UPDATE tickets AS t
		SET t.ts_id = @ticket_status_open_id
		WHERE t.t_id = @ticket_id;
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
            SELECT t.u_id
            FROM rides AS r
            INNER JOIN tickets AS t ON t.t_id = r.t_id
            WHERE r.r_id = r_id
        );
        
        SET @ticket_id = (
            SELECT t.t_id 
            FROM tickets AS t
            INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
            INNER JOIN rides AS r ON r.t_id = t.t_id
            WHERE t.u_id = @traveler_id AND r.r_id = r_id AND ts.ts_status != 'open' AND ts.ts_status != 'close'
        );
        
        INSERT INTO connections(r_id, u_id_traveler, u_id_driver)
        VALUES(r_id, @traveler_id, @driver_id);
        
        SET @connections_count = (
            SELECT COUNT(*)
            FROM connections AS c
            WHERE c.c_id = LAST_INSERT_ID()
        );
        
        SET @ticket_status_open_id = (
            SELECT ts.ts_id 
            FROM ticket_status AS ts
            WHERE ts.ts_status = 'open'
        );
        
        IF @connections_count > 0 THEN
            UPDATE tickets AS t
            SET t.ts_id = @ticket_status_open_id
            WHERE t.t_id = @ticket_id;
		END IF;
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
    
    SET @connections_traveler_count = (
        SELECT COUNT(*) FROM connections WHERE u_id_traveler = @u_id
    );
    
    SET @connections_driver_count = (
        SELECT COUNT(*) FROM connections WHERE u_id_driver = @u_id
    );
    
    SET @ticket_id = (
        SELECT t.t_id
        FROM connections AS c
        INNER JOIN rides AS r ON r.r_id = c.r_id
        INNER JOIN tickets AS t ON t.t_id = r.t_id
        WHERE u_id_driver = @u_id OR u_id_traveler = @u_id
    );

    IF @connections_traveler_count > 0 THEN
        DELETE FROM connections WHERE u_id_traveler = @u_id;
    END IF;
    
    IF @connections_driver_count > 0 THEN
        DELETE FROM connections WHERE u_id_driver = @u_id;
    END IF;
    
    SET @ticket_status_close_id = (
        SELECT ts.ts_id 
        FROM ticket_status AS ts
        WHERE ts.ts_status = 'close'
    );
    
    UPDATE tickets AS t
    SET t.ts_id = @ticket_status_close_id
    WHERE t.t_id = @ticket_id;
END $$
DELIMITER ;

-- 17. CANCEL OFFERS

DELIMITER $$
CREATE PROCEDURE cancel_offers(user_email VARCHAR(255))
BEGIN
    SET @u_id = (
        SELECT u_id FROM users WHERE u_email = user_email
    );
    
    SET @connections_traveler_count = (
        SELECT COUNT(*) FROM connections WHERE u_id_traveler = @u_id
    );
    
    SET @connections_driver_count = (
        SELECT COUNT(*) FROM connections WHERE u_id_driver = @u_id
    );
    
    SET @ticket_id = (
        SELECT t.t_id
        FROM connections AS c
        INNER JOIN rides AS r ON r.r_id = c.r_id
        INNER JOIN tickets AS t ON t.t_id = r.t_id
        WHERE u_id_driver = @u_id OR u_id_traveler = @u_id
    );

    IF @connections_traveler_count > 0 THEN
        DELETE FROM connections WHERE u_id_traveler = @u_id;
    END IF;
    
    IF @connections_driver_count > 0 THEN
        DELETE FROM connections WHERE u_id_driver = @u_id;
    END IF;
    
    SET @ticket_status_close_id = (
        SELECT ts.ts_id 
        FROM ticket_status AS ts
        WHERE ts.ts_status = 'close'
    );
    
    UPDATE tickets AS t
    SET t.ts_id = @ticket_status_close_id
    WHERE t.t_id = @ticket_id;
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
		SET @ticket_id = (
			SELECT t.t_id FROM tickets AS t 
            INNER JOIN rides AS r ON r.t_id = t.t_id
            WHERE t.u_id = @u_id AND r.r_id = ride_id
        );
        
        SET @ticket_status_close_id = (
			SELECT ts.ts_id FROM ticket_status AS ts WHERE ts.ts_status = 'close'
        );
        
        UPDATE tickets AS t
		SET t.ts_id = @ticket_status_close_id
		WHERE t.t_id = @ticket_id;
    
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
		SET @ticket_id = (
			SELECT t.t_id FROM tickets AS t 
            INNER JOIN rides AS r ON r.t_id = t.t_id
            WHERE t.u_id = @u_id AND r.r_id = ride_id
        );
        
        SET @ticket_status_close_id = (
			SELECT ts.ts_id FROM ticket_status AS ts WHERE ts.ts_status = 'close'
        );
        
        UPDATE tickets AS t
		SET
			t.ts_id = @ticket_status_close_id
		WHERE t.t_id = @ticket_id;
    
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
$$
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
    
    SELECT *
    FROM all_offers_view AS aov
    INNER JOIN tickets AS t ON t.t_id = aov.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE institution_code = @i_code AND u.u_email != user_email AND ts.ts_status != 'open' AND ts.ts_status != 'close';
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
    
    SELECT *
    FROM all_requested_view AS arv
    INNER JOIN tickets AS t ON t.t_id = arv.ticket_id
    INNER JOIN ticket_status AS ts ON ts.ts_id = t.ts_id
    INNER JOIN users AS u ON u.u_id = t.u_id
    WHERE institution_code = @i_code AND u.u_email != user_email AND ts.ts_status != 'open' AND ts.ts_status != 'close';
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
        WHERE u_id = @u_id;
    END IF;
END $$
DELIMITER ;