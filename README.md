# DreamTrip - A PHP Travel Planning Application

DreamTrip is a dynamic web application designed to help users manage their travel destinations. Users can add new places to a wishlist, mark them as visited, and view statistics about their travels. The application features a modern, responsive interface and is built with a focus on security and user experience, featuring seamless AJAX-powered navigation.

## ✨ Features

- **User Authentication:** Secure user registration and login system.
- **Dashboard:** An overview of travel statistics (total destinations, visited, wishlist).
- **Destination Management:** Add, edit, and delete travel destinations.
- **Dynamic Filtering & Search:** Instantly search and filter destinations by name, country, type, or status.
- **AJAX-Powered Navigation:** A smooth, single-page application (SPA) feel with no full-page reloads when navigating.
- **Image Uploads:** Users can upload images for their destinations.

## 🛠️ Tech Stack

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, Tailwind CSS, Vanilla JavaScript
- **Server:** Apache (via XAMPP)

---

## 🚀 Core Concepts & Implementation

This project implements several modern web development practices to ensure it is both functional and secure.

### 1. AJAX-Powered Navigation

To create a fluid user experience, the application avoids full-page reloads when navigating between main pages (like Dashboard and Add Destination). This is achieved through a combination of client-side JavaScript and server-side PHP logic.

**How it Works:**

1.  **Client-Side (JavaScript - `scripts/app.js`):**
    *   **Event Interception:** The script listens for clicks on any link with the `.nav-link` class.
    *   **Preventing Default:** It prevents the browser's default navigation behavior.
    *   **Fetching Content:** It uses the `fetch()` API to make a background request to the link's URL, adding a `?ajax=1` query parameter. This parameter signals to the server that the request is from our AJAX script.
    *   **Updating the DOM:** The HTML content returned by the server is dynamically injected into the `<main id="main-content">` element.
    *   **History Management:** The browser's URL is updated using `history.pushState()`, and the `popstate` event is handled to ensure the back/forward buttons work as expected.

2.  **Server-Side (PHP - e.g., `dashboard.php`):**
    *   **Request Detection:** Each page checks for the `ajax` query parameter using `isset($_GET['ajax'])`.
    *   **Conditional Rendering:**
        *   If the request is **not** AJAX, the page includes the full `header.php` and `footer.php` as usual.
        *   If the request **is** AJAX, the page skips the header and footer and only `echo`es the essential HTML content for that specific page.

This architecture makes the application feel significantly faster and more responsive.

### 2. Security Best Practices

Security is a critical aspect of the DreamTrip application. Several layers of protection are implemented to safeguard user data.

-   **Database Security (PDO & Prepared Statements):**
    *   All database queries are executed using **PHP Data Objects (PDO)**.
    *   **Prepared statements** are used exclusively to prevent **SQL injection**. By separating the SQL query from the user-provided data, the database engine can correctly handle the data, making it impossible for a malicious user to alter the query's logic. This is implemented in the `classes/Database.php` and `classes/Destination.php` files.

-   **Session Handling:**
    *   User authentication is managed using PHP's native sessions (`$_SESSION`).
    *   The `includes/auth.php` file contains helper functions like `requireLogin()`, which ensures that sensitive pages can only be accessed by authenticated users. It checks if a `user_id` is set in the session and redirects to the login page if not.

-   **Cross-Site Request Forgery (CSRF) Protection:**
    *   To prevent attackers from tricking users into performing unintended actions, the application uses a token-based CSRF defense.
    *   A unique, random token is generated for each user session and embedded as a hidden input in all forms that perform state-changing actions (add, edit, delete).
    *   This token is also sent with any AJAX `POST` requests. The server validates this token on every request, rejecting any that do not have a valid token.

-   **Input Sanitization & Output Encoding (XSS Prevention):**
    *   To prevent **Cross-Site Scripting (XSS)**, all data that is outputted to the HTML page is sanitized using `htmlspecialchars()`. This function converts special characters (like `<` and `>`) into their HTML entities, ensuring that user-provided data is rendered as plain text and cannot be executed as HTML or JavaScript by the browser.

