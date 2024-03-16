DROP DATABASE path_pals_db;
CREATE DATABASE path_pals_db;

USE path_pals_db;

-- === TABLES ===

-- 1. PERSONS

CREATE TABLE persons (
	p_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    p_first_name VARCHAR(50) NULL,
    p_last_name VARCHAR(50) NULL,
    p_birth_date DATE NULL,
    p_genre VARCHAR(20) NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 2. USERS

CREATE TABLE users (
	u_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    u_username VARCHAR(50) NULL,
    u_email VARCHAR(100) NOT NULL,
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