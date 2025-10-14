<style>
    /* =========================
   CSS Variables for Theme
========================= */
:root {
    --bg-color: #f5f6fa;
    --header-bg: #4a76a8;
    --header-text: #fff;
    --sidebar-bg: #2c3e50;
    --sidebar-text: #fff;
    --main-bg: #fff;
    --main-text: #333;
    --button-bg: #4a76a8;
    --button-hover: #3a5f87;
    --search-bg: #fff;
    --search-text: #333;
    --hr-color: #4a76a8;
}

/* Dark Mode Variables */
body.dark-mode {
    --bg-color: #1e1e2f;
    --header-bg: #111227;
    --header-text: #f0f0f0;
    --sidebar-bg: #111227;
    --sidebar-text: #ddd;
    --main-bg: #1a1a2e;
    --main-text: #eee;
    --button-bg: #6a5acd;
    --button-hover: #5747a3;
    --search-bg: #2a2a3b;
    --search-text: #fff;
    --hr-color: #6a5acd;
}

/* =========================
   Global Styles
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    display: flex;
    min-height: 100vh;
    background-color: var(--bg-color);
    color: var(--main-text);
}

/* =========================
   Header
========================= */
header {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: var(--header-bg);
    color: var(--header-text);
    padding: 15px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

header h1 {
    font-size: 24px;
}

header .search-container {
    display: flex;
    gap: 10px;
}

header input[type="text"] {
    margin-left: 20px;
    padding: 6px 10px;
    border-radius: 4px;
    border: none;
    outline: none;
    width: clamp(290px, 4vw, 500px);
    background-color: var(--search-bg);
    color: var(--search-text);
}

header .search-container button,
header .search-container a {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-color: var(--button-bg);
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 6px 10px;
    transition: 0.3s;
    text-decoration: none;
}

header .search-container button:hover,
header .search-container a:hover {
    background-color: var(--button-hover);
    transform: scale(1.1);
}

header form button {
    background-color: #e74c3c;
    padding: 10px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: 0.3s;
}

header form button:hover {
    background-color: #c0392b;
}

/* =========================
   Sidebar
========================= */
aside {
    position: fixed;
    top: 60px;
    left: 0;
    width: 260px;
    height: calc(100% - 60px);
    background-color: var(--sidebar-bg);
    color: var(--sidebar-text);
    padding: 20px;
    overflow-y: auto;
}

aside h2 {
    font-size: 18px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

aside hr {
    border: 0;
    border-top: 1px solid var(--hr-color);
    margin: 10px 0;
}

aside h3 {
    font-size: 16px;
    margin-bottom: 5px;
}

aside p {
    font-size: 14px;
    color: var(--sidebar-text);
    margin-bottom: 10px;
}

aside nav ul {
    list-style: none;
    margin-top: 15px;
    padding-left: 0;
}

aside nav ul li {
    margin: 10px 0;
}

aside nav ul li a {
    color: var(--sidebar-text);
    text-decoration: none;
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    transition: 0.3s;
}

aside nav ul li a:hover {
    background-color: var(--header-bg);
}

/* Scrollbar */
aside::-webkit-scrollbar {
    width: 6px;
}

aside::-webkit-scrollbar-track {
    background: var(--sidebar-bg);
}

aside::-webkit-scrollbar-thumb {
    background-color: var(--header-bg);
    border-radius: 3px;
}

/* =========================
   Main Content
========================= */
main {
    margin-left: 260px;
    margin-top: 60px;
    padding: 20px;
    flex: 1;
    width: 100%;
}

.content {
    background-color: var(--main-bg);
    color: var(--main-text);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* =========================
   Profile Header
========================= */
.profile-header {
    display: flex;
    align-items: center;
}

.profile-logo {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 2px solid #ccc;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.profile-info h2 {
    margin: 0;
    font-size: 16px;
}

.profile-info p {
    margin: 0;
    font-size: 14px;
}

/* =========================
   Buttons & Links
========================= */
a {
    color: var(--button-bg);
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

button {
    background-color: var(--button-bg);
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: var(--button-hover);
}

/* =========================
   Responsive
========================= */
@media (max-width: 768px) {
    aside {
        width: 180px;
        padding: 15px;
    }

    main {
        margin-left: 200px;
        margin-top: 70px;
        padding: 15px;
    }

    header h1 {
        font-size: 20px;
    }

    header .search-container input[type="text"] {
        width: 140px;
    }
}
</style>