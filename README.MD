# WiFi Cloud API (AIL SMS Gateway)

**This is the current API for logging users onto aamra Mikrotik Hotspots - using cloud based pages.**

### Description

The cloud based WiFi portals send the user's entered data (username, mobile numebr etc.) and the appropriate functions are then carried out. The flow of data is as below:

1. Delete entry from RADIUS radcheck table (if exists)
2. Generate new OTP and insert into RADIUS radcheck table
3. Add user details to WiFiUsers table
4. Send SMS to user with OTP

### Structure

```
.
+-- Controller
|   +-- UserLogin.php
+-- Database
|   +-- DBConfig.php
|   +-- Handler.php
+-- SMS
|   +-- SMS_Old.php
|   +-- SMS.php
+-- README.MD
```