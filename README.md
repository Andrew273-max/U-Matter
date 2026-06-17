# U-Matter
A mobile-first web platform for Ukrainian volunteers and supporters to organise events, raise funds, and coordinate volunteer activity across the Netherlands and Europe.

## About the project
U Matter provides a centralised, trustworthy place for Ukrainian volunteers to post and discover events, create and donate to fundraising campaigns, and connect with other people doing similar work. Every listing is tied to a verified user account, and fund creators are required to upload proof of eligibility documentation. The platform is built as a student project (Andrew Naumenko, IN-IM1, 2026) and is currently in active development.

----------------------------------------------------------------
## Tech stack

| Layer | Technology |
|---|---|
| Front-end | HTML, CSS, JavaScript |
| Back-end | PHP |
| Database | MySQL |
| Font | Inter (Google Fonts) |
| Icons | Font Awesome 4.7.0 |
| Contact form | EmailJS |

--------------------------------------------------------------------------------------------------------------------
## Pages

| File | Description |
|---|---|
| `index.html` | Homepage — hero banner, intro text, image slideshow, links to events and funds |
| `event_list.php` | Lists all events from the database as clickable cards |
| `event_info.php` | Full details of a single event (name, purpose, organiser, date) |
| `fund_list.php` | Lists all fundraising campaigns from the database as clickable cards |
| `fund_info.php` | Full details of a single fund (name, purpose, goal, organiser, end date) |
| `create_event.php` | Form to submit a new event to the database |
| `create_fund.php` | Form to submit a new fund to the database, including eligibility document upload |
| `login.php` | Login form — authenticates against the accounts table using hashed passwords |
| `signup.php` | Registration form — stores name, email, phone, hashed password, profile picture, and verification document |
| `profile.php` | Displays the logged-in user's account details (requires active session) |
| `logout.php` | Destroys the session and clears localStorage, redirects to login |
| `contact.html` | Contact form — sends messages via EmailJS without a back-end mail server |
| `dbconnect.php` | Database connection file — included by all PHP pages that query the database |

-------------------------------------------------------------------------------------------------------
## JavaScript

| File | Description |
|---|---|
| `js/shared/hamburger_menu.js` | Toggles the mobile navigation menu open/closed; also checks `localStorage` to swap the nav link between Log in and Profile depending on login state |
| `js/specific/contact.js` | Handles the contact form submission via EmailJS — loading state, success/error feedback, auto-hide after 5 seconds |

------------------------------------------------------------------------------------------------------
## Database

The database is named `umatterdb` and contains three tables. SQL dump files are included in the repository for setup.

**accounts**
- `id` (PK, auto-increment)
- `first_name`, `last_name`, `phone_number`, `email`
- `pass` (bcrypt hash via PHP `password_hash()`)
- `profile_pic` (file path to uploaded image)
- `proof_eligibility` (file path to the uploaded document)

**events**
- `id` (PK, auto-increment)
- `name`, `organizer`, `purpose`, `description`
- `date_time`
- `photo` (file path to uploaded picture of the event)

**funds**
- `id` (PK, auto-increment)
- `name`, `organizer`, `purpose`, `description`
- `fund_goal` (decimal), `end_date`
- `eligibility` (file path to the uploaded document)


-----------------------------------------------------------------------------------------------------
## Folder structure
```
/
├── index.html
├── contact.html
├── event_list.php
├── event_info.php
├── fund_list.php
├── fund_info.php
├── create_event.php
├── create_fund.php
├── login.php
├── signup.php
├── profile.php
├── logout.php
├── dbconnect.php
├── styles.css
├── js/
│   ├── shared/
│   │   └── hamburger_menu.js
│   └── specific/
│       └── contact.js
├── assets/
│   ├── icon.png
│   ├── hero.png
│   ├── background.png
│   ├── background-2.png
│   ├── background-3.png
│   ├── search.png
│   ├── img1.jpg
│   ├── img2.jpg
│   └── img3.jpg
├── uploads/
    └── (user-uploaded profile pictures and documents)
    └── sql/
        ├── umatterdb_accounts0.sql
        ├── umatterdb_events0.sql
        └── umatterdb_funds0.sql
```

----------------------------------------------------------------------------------------
## Setup

## Requirements
- PHP 7.4 or higher
- MySQL 8.0 or higher
- A local server environment (e.g. XAMPP, WAMP, or Laragon)

## Installation

1. Clone the repository into your server's web root (e.g. `htdocs` for XAMPP):
```bash
git clone https://github.com/Andrew273-max/U-Matter.git
```

2. Create the database in MySQL:
```sql
CREATE DATABASE umatterdb;
```

3. Import the three SQL dump files:
```bash
mysql -u root -p umatterdb < sql/umatterdb_accounts0.sql
mysql -u root -p umatterdb < sql/umatterdb_events0.sql
mysql -u root -p umatterdb < sql/umatterdb_funds0.sql
```

4. Open `dbconnect.php` and update the credentials to match your local MySQL setup:
```php
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "umatterdb";
```

5. Open `index.html` or navigate to `localhost/U-Matter` in your browser.

> ## Note: Do not commit real database credentials to version control. Consider using environment variables or a config file excluded via `.gitignore` for production use.


----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## Current status
The front end is complete. The back-end connection is implemented for account management (login, signup, logout, profile) and for reading and writing events and funds from the database. The contact form works via EmailJS.

Features planned for future development:
- Activity history on the profile page (events attended, funds donated to)
- User bio field
- Fund progress tracking (amount raised vs. goal)
- Search functionality on the event and fund list pages
- Admin moderation for submitted listings

## License

This project is a student assignment. All rights reserved © Andrew Naumenko 2026.
