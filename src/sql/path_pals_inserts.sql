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
VALUES('Cavalo47', 'cavalo47@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('ruben3947583763826', @u_id);

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
VALUES('Cavalo45', 'cavalo45@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('rodrigo2344', @u_id);

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
VALUES('Cavalo46', 'cavalo46@gmail.com', LAST_INSERT_ID());

SET @u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('daniel45555', @u_id);

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

INSERT INTO rides(r_from, r_to, r_start, r_end, t_id, rt_id)
VALUES('Castelo Branco', 'Lisboa', NOW(), NULL, LAST_INSERT_ID(), @rt_id);

SET @r_id = (
	SELECT r_id FROM rides AS r WHERE r.r_id = LAST_INSERT_ID()
);

-- 10. CREATE A NEW USER REGULAR

INSERT INTO persons(p_first_name, p_last_name, p_genre)
VALUES ('João', 'Machado', 'M');

INSERT INTO users(u_username, u_email, p_id)
VALUES('Cavalo49', 'cavalo49@gmail.com', LAST_INSERT_ID());

SET @driver_u_id = (
	SELECT u_id FROM users AS u WHERE u.u_id = LAST_INSERT_ID()
);

INSERT INTO passwords(pw_hashed_password, u_id)
VALUES('joao492498', @u_id);

SET @ut_user_id = (
	SELECT ut_id FROM user_types AS ut WHERE ut.ut_type = 'user'
);

SET @up_user_id = (
	SELECT up_id FROM user_permissions AS up WHERE up.up_level = 2
);

INSERT INTO accounts(u_id, ut_id, up_id)
VALUES(@u_id, @ut_user_id, @up_user_id);

-- 11. CREATE A CONNECTION
INSERT INTO connections(r_id, u_id_driver, u_id_traveler)
VALUES(@r_id, @driver_u_id, @u_id);