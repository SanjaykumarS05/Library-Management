<style>

    /* === Reset & Base === */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    display: flex;
    min-height: 100vh;
    background-color: #f5f6fa;
    color: #333;
}

/* === Header === */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #4a76a8;
    color: #fff;
    padding: 15px 30px;
    text-align: center;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

header h1 {
    font-size: 24px;
}

aside {
    position: fixed;
    top: 60px;
    left: 0;
    width: 260px;
    height: calc(100% - 60px);
    background-color: #2c3e50;
    color: #fff;
    padding: 20px;
}

aside h2 {
    font-size: 18px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

aside hr {
    border: 0;
    border-top: 1px solid #4a76a8;
    margin: 10px 0;
}

aside h3 {
    font-size: 16px;
    margin-bottom: 5px;
}

aside p {
    font-size: 14px;
    color: #dcdcdc;
    margin-bottom: 10px;
}

aside nav ul {
    list-style: none;
    margin-top: 15px;
}

aside nav ul li {
    margin: 10px 0;
}

aside nav ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    transition: 0.3s;
}

aside nav ul li a:hover {
    background-color: #4a76a8;
}

/* === Main Content === */
main {
    margin-left: 240px;
    margin-top: 50px;
    padding: 20px;
    flex: 1;
    width: 100%;
}

.content {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}


/* === Buttons & Links === */
a {
    color: #4a76a8;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

button {
    background-color: #4a76a8;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: #3a5f87;
}

/* === Scrollbar Styling === */
aside::-webkit-scrollbar {
    width: 6px;
}

aside::-webkit-scrollbar-track {
    background: #2c3e50;
}

aside::-webkit-scrollbar-thumb {
    background-color: #4a76a8;
    border-radius: 3px;
}

/* === Responsive === */
@media (max-width: 768px) {
    aside {
        width: 180px;
        padding: 15px;
    }
    main {
        margin-left: 240px;
        margin-top: 70px;
        padding: 15px;
    }
    header h1 {
        font-size: 20px;
    }
}
</style>