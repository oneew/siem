# Security Alerts Management

## Overview
The Security Alerts module displays real-time security alerts from the database. The system shows actual alerts that have been added through the application interface or imported from security tools.

## Current Status
The alerts page is already configured to display real data from the database. If you're seeing demo/sample data, it's because the database was populated with sample records during the initial setup.

## Managing Alerts Data

### Clearing Demo Data
If you want to remove the demo/sample alerts and start with a clean slate:

1. **Through the Web Interface** (Development Mode Only):
   - Navigate to the Alerts page
   - Click the "Clear All Alerts" button (only visible in development mode)
   - Confirm the action when prompted

2. **Using Database Seeders**:
   ```bash
   # To clear only alerts
   php spark db:seed ClearAlertsOnlySeeder
   
   # To clear all data (use with caution)
   php spark db:seed ClearAlertsSeeder
   ```

### Adding Real Alerts
You can add real alerts through:

1. **Manual Creation**:
   - Click "Create Alert" on the alerts dashboard
   - Fill in the alert details
   - Save the alert

2. **Programmatic Import**:
   - Use the Alerts model to insert records directly
   - Integrate with security tools via APIs

## Database Structure
The alerts are stored in the `alerts` table with the following key fields:
- `alert_name`: The name/title of the alert
- `alert_type`: Type of alert (Authentication, Network, Malware, etc.)
- `priority`: Alert priority (Low, Medium, High, Critical)
- `status`: Current status (Active, Investigating, Closed, False Positive)
- `source_ip`: Source IP address related to the alert
- `description`: Detailed description of the alert
- `rule_name`: Name of the detection rule that triggered the alert

## Security Notes
- The "Clear All Alerts" button is only available in development mode for safety
- In production environments, data management should be done through proper administrative procedures