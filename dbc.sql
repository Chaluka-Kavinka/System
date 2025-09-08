CREATE DATABASE IF NOT EXISTS volunteer_connect_db;
USE volunteer_connect_db;

-- users (volunteers, organizations, admins)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Volunteer','Organization','Admin') NOT NULL DEFAULT 'Volunteer',
    nic VARCHAR(20) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    profile_pic VARCHAR(255),
    is_new TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- events (created by organizations)
CREATE TABLE IF NOT EXISTS events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(255),
    event_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES users(user_id) ON DELETE CASCADE
);


-- registrations (volunteers join events)
CREATE TABLE event_registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    volunteer_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Registered','Completed','Cancelled') DEFAULT 'Registered',
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE,
    FOREIGN KEY (volunteer_id) REFERENCES users(user_id) ON DELETE CASCADE
);

--volunteer_requests table
CREATE TABLE IF NOT EXISTS volunteer_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    org_id INT NOT NULL,                -- FK to users.user_id
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(100),
    volunteer_count INT,
    datetime DATETIME,
    status ENUM('Pending','Approved','Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (org_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

