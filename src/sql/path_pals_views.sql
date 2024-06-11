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
    r.r_end AS ride_end
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
    r.r_end AS ride_end
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
    p.p_birth_date AS user_birthday,
    p.p_genre AS user_genre,
    YEAR(CURDATE()) - YEAR(p.p_birth_date) - (RIGHT(CURDATE(), 5) < RIGHT(p.p_birth_date, 5)) AS user_age,
    u.u_username AS user_username,
    u.u_email AS user_email,
    u.u_career AS user_career,
    u.u_class AS user_class,
    u.u_location AS user_location,
    u.u_about AS user_about
FROM
    persons AS p
JOIN
    users AS u ON p.p_id = u.p_id;