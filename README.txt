=====================================================================
 HEAL & RISE - NGO Rehabilitation & Empowerment Platform (PHP/MySQL)
=====================================================================

SETUP
-----
1. Copy the project folder into your web root (e.g. C:\xampp\htdocs\heal_rise).
2. Start Apache + MySQL (XAMPP).
3. Open phpMyAdmin and create a database named:  heal_rise
4. Import the file db.sql into that database.
5. Open in browser:  http://localhost/heal_rise/

LOGIN CREDENTIALS (password for all seeded accounts = 12345)
-----------------------------------------------------------
Admin        : admin@yahoo.com
NGO          : ngo@gmail.com
Team Member  : team@gmail.com
Counselor    : counselor@gmail.com
User         : user@gmail.com

MODULES
-------
1. Secure Registration & Privacy Protection
   - register.php  -> Users & NGOs sign up with privacy consent.
   - backend/verify.php -> Admin verifies each registration before login is allowed.
   - Sensitive details (CNIC, address, problem details) stored privately, seen only by Admin/assigned staff.

2. NGO Connection & Case Assignment
   - backend/cases.php  -> Admin connects a verified user to a relevant NGO and assigns a team member + counselor.
   - backend/team_cases.php / ngo_cases.php -> Team member and NGO monitor case progress.

3. Counseling & Continuous Support
   - backend/counselor_sessions.php -> Counselors/psychiatrists schedule and conduct regular online sessions (with meeting link) and record notes.
   - backend/user_sessions.php -> Users see and join their sessions.

4. Skill Development & Tracking
   - backend/team_skills.php -> Team member adds skills and updates progress %.
   - backend/ngo_skills.php  -> NGO collaborates and views skill progress.
   - backend/user_skills.php -> Users track their own empowerment progress.

5. Rehabilitation & Case Closure
   - backend/rehab.php -> Admin admits users to the institute, discharges them once recovered,
     and formally closes the case once the user is empowered.

NOTE
----
This project preserves the original template's design, Bootstrap styling and coding style.
