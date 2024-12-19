
USE cyber_complaint_db;

CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    other_category VARCHAR(255) DEFAULT NULL,
    description TEXT NOT NULL,
    date_of_incident DATE NOT NULL,
    evidence_filename VARCHAR(255) DEFAULT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
