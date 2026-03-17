-- Basis Data untuk SIEM & Cybersecurity Command Center (Red Team & DFIR)

-- 1. Modul Red Team Playbooks
CREATE TABLE IF NOT EXISTS playbooks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mitre_attack_id VARCHAR(50),
    tactic_name VARCHAR(255) NOT NULL,
    description TEXT,
    command_examples TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Modul Red Team: Target Management
CREATE TABLE IF NOT EXISTS targets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    target_name VARCHAR(255) NOT NULL,
    ip_address_or_url VARCHAR(255) NOT NULL,
    environment ENUM('prod', 'dev', 'staging') NOT NULL DEFAULT 'dev',
    criticality_level ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL DEFAULT 'Low',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. Modul Red Team: Vulnerabilities & Findings
CREATE TABLE IF NOT EXISTS vulnerabilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    target_id INT NOT NULL,
    vuln_name VARCHAR(255) NOT NULL,
    cvss_score DECIMAL(3,1) NOT NULL DEFAULT 0.0,
    severity ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL DEFAULT 'Low',
    status ENUM('Open', 'Mitigated', 'Closed') NOT NULL DEFAULT 'Open',
    poc_description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (target_id) REFERENCES targets(id) ON DELETE CASCADE
);

-- 4. Modul DFIR: Evidence Locker
CREATE TABLE IF NOT EXISTS evidence (
    id INT AUTO_INCREMENT PRIMARY KEY,
    case_id VARCHAR(50) NOT NULL,
    evidence_name VARCHAR(255) NOT NULL,
    file_hash_sha256 VARCHAR(64) NOT NULL, -- Locked via app logic
    acquired_date DATETIME NOT NULL,
    uploaded_by VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
