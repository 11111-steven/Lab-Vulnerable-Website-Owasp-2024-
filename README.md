**Explanatory Summary of Implemented Vulnerabilities**
**1. A01: Broken Access Control**
**What is it?** It is when a user can access data or functions that do not belong to them, such as viewing another user's profile.
**How was it integrated? (profile.php)**
The profile page was designed to search for a user by their UUID through the URL (e.g., profile.php?uuid=...).
The flaw: The PHP code only checks if the UUID exists, but never verifies if that UUID belongs to the logged-in user.
**How does the attack work?**
The attacker first needs the victim's UUID. They obtain it thanks to another vulnerability (SQL injection).
Then, they simply replace their own UUID in the URL with the victim's.
The application, not checking ownership, displays the other user's private data without any problems.

**2. A02: Cryptographic Failures**
**What is it?** It is when weak encryption methods are used or “secrets” (such as tokens) that should be protected are leaked.
**How was it integrated? (forgot_password.php and the logs/ folder)**
The “Forgot my password” function generates a single-use token to change the password.
The failure: Due to a supposed “debugging error,” the code was programmed to write this secret token to a text file (password_resets.log) inside a public folder on the server.
**How does the attack work?**
The attacker first needs the victim's email address (obtained with SQL injection).
They go to “Forgot my password” and request a reset for the victim.
Then, they exploit another vulnerability (the server's misconfiguration) to access the logs/password_resets.log file and steal the valid token.
They use the token to change the victim's password and take control of their account.

**3. A03: Injection (Blind SQL Injection)**
**What is it?** It is when an attacker can “inject” and execute their own commands in the database through an input field, such as a search engine.
**How was it integrated? (search_results.php)**
The code takes the text from the search engine and pastes it directly into the SQL query.
The flaw: Prepared queries, which are the standard defense, are not used. To make it more realistic, an error handler was added that hides error messages from the database,
making it a “blind” injection.
**How does the attack work?**
The attacker does not see errors, so they cannot view the data directly.
Instead, they inject commands that give them “yes” or “no” answers. The most professional way is with time: they inject the SLEEP(5) command.
If the page takes 5 seconds longer to load, the attacker knows that their command was executed. From there, they can use tools like sqlmap to extract the entire database,
character by character.

**4. A04: Insecure Design**
**What is it?** It is not a programming error, but a flaw in business logic. It occurs when a feature is designed without considering how it could be abused.
**How was it integrated? (confirm_purchase.php and purchase.php)**
The purchase process was designed in two steps. In the second step, the confirmation page sends the final price to the server in a hidden field on the form.
The flaw: The server blindly trusts the price sent by the customer and does not recheck it in the database before registering the purchase.
**How does the attack work?**
The attacker intercepts the communication between the confirmation page and the server with a tool such as Burp Suite.
They find the hidden parameter final_price with the actual value (e.g., 2150.50).
They change it to a ridiculous value (e.g., 1.00).
They send the modified request. The server accepts it as valid and registers the purchase for only one dollar.

**5. A05: Security Misconfiguration**
**What is it?** It is when the server or application has insecure default settings or leaves “doors open.”
**How was it integrated? (.htaccess file)**
An Apache configuration file called .htaccess was created in the root of the site.
The flaw: Within this file, the Options +Indexes option was enabled. This configuration tells the server: “If someone visits a folder that does not have an index.php file, show them a list of all the files inside.”
**How does the attack work?**
The attacker simply navigates to common directories in their browser (e.g., http://.../includes/ or http://.../logs/).
Instead of receiving an “Access Denied” error, the server shows them a complete list of files.
This allows the attacker to discover files they shouldn't see, such as the crucial password_resets.log, which allows them to carry out the Cryptographic Flaws attack.
