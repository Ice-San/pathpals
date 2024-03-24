-- 1. CREATE GET OFFERS VIEW

CREATE VIEW all_offers_view AS
SELECT
    u.u_id AS user_id,
    u.u_username AS username,
    t.t_id AS ticket_id,
    ts.ts_status AS ticket_status,
    r.r_id AS ride_id,
    rt.rt_type AS ride_type,
    r.rideAt AS rideAt
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
    DATE(t.createdAt) = CURDATE()
ORDER BY
    t.createdAt ASC
LIMIT 100;