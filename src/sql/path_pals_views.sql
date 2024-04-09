-- 1. CREATE GET OFFERS VIEW

CREATE VIEW all_offers_view AS
SELECT
    u.u_email AS user_email,
    u.u_username AS username,
    u.u_career AS career,
    u.u_class AS class,
    t.t_id AS ticket_id,
    ts.ts_status AS ticket_status,
    r.r_from AS ride_from,
    r.r_to AS ride_to,
    rt.rt_type AS ride_type,
    r.r_start AS ride_start
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
    r.r_from AS ride_from,
    r.r_to AS ride_to,
    rt.rt_type AS ride_type,
    r.r_start AS ride_start
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

-- 3. CREATE GET USER INFO VIEW

CREATE VIEW user_data_view AS
SELECT
    p.p_id,
    p.p_first_name,
    p.p_last_name,
    p.p_birth_date,
    p.p_genre,
    u.u_username,
    u.u_email,
    u.u_career,
    u.u_class,
    u.u_location,
    u.u_about
FROM
    persons AS p
JOIN
    users AS u ON p.p_id = u.p_id;