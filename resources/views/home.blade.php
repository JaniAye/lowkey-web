<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowkye Home</title>
    <style>
        :root {
            --primary-bg: #F8F8FA;
            --main-accent: #007BFF;
            --secondary-accent: #20C997;
            --text-headings: #212529;
            --text-secondary: #6C757D;
            --card-bg: #FFFFFF;
            --border-color: #E9ECEF;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; /* Modern, common sans-serif stack */
            margin: 0;
            padding: 0;
            background-color: var(--primary-bg);
            color: var(--text-secondary);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px; /* Added horizontal padding for content spacing from screen edges */
        }

        section { /* Global padding for sections */
            padding-top: 30px;
            padding-bottom: 30px;
        }

        section h2 { /* Common styling for section titles */
            color: var(--text-headings);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px; /* Slightly larger default size */
            font-weight: 600; /* Bolder titles */
        }

        /* Links global styling */
        a {
            color: var(--main-accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #0056b3; /* Darker shade of main accent for hover */
            text-decoration: underline;
        }

        /* Button global styling (base) - can be extended by specific button classes */
        button {
            cursor: pointer;
            font-family: inherit; /* Ensure buttons use the body font */
        }


        /* Header Styles */
        .header {
            background-color: var(--card-bg);
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Allows items to wrap on smaller screens */
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            width: 100%; /* Ensure container takes full width within header */
        }

        .header-left, .header-right {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px; /* Pill shape */
            min-width: 250px;
            font-size: 16px;
        }
        .search-bar input[type="text"]:focus {
            outline: none;
            border-color: var(--main-accent);
        }

        .balance-display {
            margin-left: 20px;
            font-size: 16px;
            color: var(--text-headings);
            font-weight: bold;
        }

        .main-nav ul {
            list-style: none;
            padding: 0;
            margin: 0 20px; /* Add margin to separate from search/balance and profile */
            display: flex;
        }

        .main-nav ul li {
            margin-right: 20px;
        }

        .main-nav ul li:last-child {
            margin-right: 0;
        }

        .main-nav ul li a {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 16px;
            padding: 5px 0;
        }
        .main-nav ul li a:hover, .main-nav ul li a.active {
            color: var(--main-accent);
            border-bottom: 2px solid var(--main-accent);
        }

        .user-profile {
            display: flex;
            align-items: center;
            text-align: right;
        }

        .user-profile .user-name {
            font-weight: bold;
            color: var(--text-headings);
            margin-right: 10px;
        }

        .user-profile .view-profile-link {
            text-decoration: none;
            color: var(--main-accent);
            font-size: 14px;
        }
        .user-profile .view-profile-link:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments for header */
        @media (max-width: 992px) { /* Tablet */
            .header .container {
                flex-direction: column;
                align-items: center; /* Center items in column layout */
            }
            .header-left, .header-right, .main-nav {
                width: 100%;
                justify-content: center;
                margin-bottom: 15px; /* Increased margin */
            }
            .main-nav ul {
                justify-content: center;
                margin: 10px 0;
            }
            .search-bar {
                margin-bottom: 10px;
                width: 80%; /* Make search bar wider on tablet */
                max-width: 400px; /* Max width for search bar */
            }
             .search-bar input[type="text"] {
                width: 100%;
             }
            .balance-display {
                 margin-left: 0;
                 margin-bottom: 10px;
            }
            .user-profile {
                justify-content: center;
            }
        }

        @media (max-width: 768px) { /* Mobile */
            .main-nav ul {
                flex-direction: column;
                align-items: center;
            }
            .main-nav ul li {
                margin-right: 0;
                margin-bottom: 10px;
            }
             .search-bar {
                width: 100%; /* Full width search bar on mobile */
             }
             .search-bar input[type="text"] {
                min-width: auto;
                width: 100%;
            }
            section h2 { /* Smaller section titles on mobile */
                font-size: 24px;
            }
        }

        /* Content Categories Styles */
        .content-categories {
            /* padding: 20px 0; */ /* Uses global section padding */
            background-color: var(--primary-bg);
        }
        .content-categories .container ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap; /* Allow categories to wrap */
            justify-content: center; /* Center categories */
        }
        .content-categories .container ul li {
            margin-right: 10px;
            margin-bottom: 10px; /* Space for wrapped items */
        }
        .content-categories .container ul li:last-child {
            margin-right: 0;
        }
        .category-tag {
            padding: 8px 15px;
            font-size: 14px;
            color: var(--text-secondary);
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px; /* Pill shape */
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .category-tag:hover {
            background-color: var(--secondary-accent);
            color: var(--card-bg);
            border-color: var(--secondary-accent);
        }
        .category-tag.active {
            background-color: var(--secondary-accent);
            color: var(--card-bg);
            border-color: var(--secondary-accent);
            font-weight: bold;
        }

        /* Featured Videos Styles */
        .featured-videos {
            /* padding: 30px 0; */ /* Uses global section padding */
        }
        /* .featured-videos h2 uses global section h2 style */

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive grid */
            gap: 20px;
            align-items: stretch; /* Ensures cards in a row stretch to the same height */
        }
        .video-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s ease;
            display: flex; /* Use flexbox for internal alignment */
            flex-direction: column; /* Stack items vertically */
        }
        .video-card:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .video-card img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
            border-radius: 4px;
            margin-bottom: 15px;
            background-color: #eee; /* Placeholder bg */
        }
        .video-card h3 {
            color: var(--text-headings);
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .video-card p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1; /* Allows description to take available space */
        }
        .watch-now-btn {
            background-color: var(--main-accent);
            color: var(--card-bg);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none; /* If using <a> tag instead of <button> */
            transition: background-color 0.3s;
            margin-top: auto; /* Pushes button to the bottom */
        }
        .watch-now-btn:hover {
            background-color: #0056b3; /* Darker shade of main accent */
        }

        /* Trending Section Styles */
        .trending-section {
            /* padding: 30px 0; */ /* Uses global section padding */
            background-color: var(--primary-bg);
        }
        /* .trending-section h2 uses global section h2 style */
        .trending-grid {
            display: grid;
            /* Using a fixed number of columns for trending, or could be scrollable */
            /* grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); */
            grid-template-columns: repeat(3, 1fr); /* Default to 3 columns */
            gap: 20px;
            overflow-x: auto; /* Allows horizontal scrolling if items exceed width */
            align-items: stretch; /* Ensures items in a row stretch to the same height */
        }
        .trending-item {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            display: flex; /* For side-by-side image and info */
            align-items: center; /* Vertically align items in the flex container */
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s ease;
            min-width: 300px; /* Minimum width for each item if scrolling */
        }
        .trending-item:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .trending-item img {
            width: 100px; /* Fixed width for thumbnail */
            height: 70px; /* Fixed height for thumbnail */
            border-radius: 4px;
            margin-right: 15px;
            object-fit: cover; /* Ensures image covers the area without distortion */
            background-color: #eee; /* Placeholder bg */
        }
        .trending-info {
            flex-grow: 1; /* Allows text content to take remaining space */
        }
        .trending-info h3 {
            color: var(--text-headings);
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 5px;
        }
        .trending-info p {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .trending-info p span { /* Timestamp */
            font-size: 12px;
            color: var(--text-secondary);
            display: block; /* Puts timestamp on new line or use float/flex for inline */
        }
        .trending-item .watch-now-btn { /* Specific styling if needed, or inherit */
            padding: 8px 12px;
            font-size: 13px;
            width: 100%; /* Make button full width of its container (.trending-info) */
        }

        /* Responsive adjustments for trending grid */
        @media (max-width: 992px) { /* Tablet */
            .trending-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on tablets */
            }
        }
        @media (max-width: 768px) { /* Mobile */
            .trending-grid {
                grid-template-columns: 1fr; /* 1 column on mobile, items will stack */
                overflow-x: visible; /* Disable horizontal scroll for stacked items */
            }
            .trending-item {
                min-width: auto; /* Reset min-width for stacked items */
                flex-direction: column; /* Stack image and info vertically on small screens */
                align-items: flex-start; /* Align items to the start */
            }
            .trending-item img {
                width: 100%; /* Full width image */
                height: auto; /* Auto height */
                margin-right: 0;
                margin-bottom: 10px; /* Space below image */
            }
        }


    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="search-bar">
                    <input type="text" placeholder="Search videos...">
                </div>
                <div class="balance-display">
                    Balance: $200
                </div>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Browse by Category</a></li>
                    <li><a href="#">Live Movie Rooms</a></li>
                    <li><a href="#">My Videos</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="user-profile">
                    <span class="user-name">Amanda</span>
                    <a href="#" class="view-profile-link">View profile</a>
                </div>
            </div>
        </div>
    </header>

        }

    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="search-bar">
                    <input type="text" placeholder="Search videos...">
                </div>
                <div class="balance-display">
                    Balance: $200
                </div>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Browse by Category</a></li>
                    <li><a href="#">Live Movie Rooms</a></li>
                    <li><a href="#">My Videos</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="user-profile">
                    <span class="user-name">Amanda</span>
                    <a href="#" class="view-profile-link">View profile</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Categories Section -->
    <section class="content-categories">
        <div class="container">
            <ul>
                <li><button class="category-tag active">All</button></li>
                <li><button class="category-tag">Music</button></li>
                <li><button class="category-tag">Gaming</button></li>
                <li><button class="category-tag">Podcasts</button></li>
                <li><button class="category-tag">Movie Trailers</button></li>
                <li><button class="category-tag">News</button></li>
                <li><button class="category-tag">Shows</button></li>
                <li><button class="category-tag">Learning</button></li>
                <li><button class="category-tag">Live</button></li>
                <li><button class="category-tag">Fashion</button></li>
                <li><button class="category-tag">Sports</button></li>
            </ul>
        </div>
    </section>

        .category-tag.active {
            background-color: var(--secondary-accent);
            color: var(--card-bg);
            border-color: var(--secondary-accent);
            font-weight: bold;
        }

    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="search-bar">
                    <input type="text" placeholder="Search videos...">
                </div>
                <div class="balance-display">
                    Balance: $200
                </div>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Browse by Category</a></li>
                    <li><a href="#">Live Movie Rooms</a></li>
                    <li><a href="#">My Videos</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="user-profile">
                    <span class="user-name">Amanda</span>
                    <a href="#" class="view-profile-link">View profile</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Categories Section -->
    <section class="content-categories">
        <div class="container">
            <ul>
                <li><button class="category-tag active">All</button></li>
                <li><button class="category-tag">Music</button></li>
                <li><button class="category-tag">Gaming</button></li>
                <li><button class="category-tag">Podcasts</button></li>
                <li><button class="category-tag">Movie Trailers</button></li>
                <li><button class="category-tag">News</button></li>
                <li><button class="category-tag">Shows</button></li>
                <li><button class="category-tag">Learning</button></li>
                <li><button class="category-tag">Live</button></li>
                <li><button class="category-tag">Fashion</button></li>
                <li><button class="category-tag">Sports</button></li>
            </ul>
        </div>
    </section>

    <!-- Featured Videos Section -->
    <section class="featured-videos">
        <div class="container">
            <h2>Featured Videos</h2>
            <div class="video-grid">
                <!-- Video Card 1 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Forest+Escape" alt="Forest Escape">
                    <h3>Forest Escape</h3>
                    <p>Explore the beauty of nature in this mesmerizing video.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 2 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Cooking+Hacks" alt="Cooking Hacks">
                    <h3>Cooking Hacks</h3>
                    <p>Discover new recipes and cooking tips to enhance your skills.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 3 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Skateboard+Tricks" alt="Skateboard Tricks">
                    <h3>Skateboard Tricks</h3>
                    <p>Get inspired by incredible skateboarding tricks and skills.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 4 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=City+Timelapse" alt="City Timelapse">
                    <h3>City Timelapse</h3>
                    <p>Experience the vibrant energy of city life like never before.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 5 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Wildlife+Wonders" alt="Wildlife Wonders">
                    <h3>Wildlife Wonders</h3>
                    <p>Dive into the wild and explore the life of majestic animals.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 6 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Beach+Sunset" alt="Beach Sunset">
                    <h3>Beach Sunset</h3>
                    <p>Relax and unwind with this stunning beach scenery.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
            </div>
        </div>
    </section>

        .watch-now-btn:hover {
            background-color: #0056b3; /* Darker shade of main accent */
        }


    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="search-bar">
                    <input type="text" placeholder="Search videos...">
                </div>
                <div class="balance-display">
                    Balance: $200
                </div>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Browse by Category</a></li>
                    <li><a href="#">Live Movie Rooms</a></li>
                    <li><a href="#">My Videos</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="user-profile">
                    <span class="user-name">Amanda</span>
                    <a href="#" class="view-profile-link">View profile</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Categories Section -->
    <section class="content-categories">
        <div class="container">
            <ul>
                <li><button class="category-tag active">All</button></li>
                <li><button class="category-tag">Music</button></li>
                <li><button class="category-tag">Gaming</button></li>
                <li><button class="category-tag">Podcasts</button></li>
                <li><button class="category-tag">Movie Trailers</button></li>
                <li><button class="category-tag">News</button></li>
                <li><button class="category-tag">Shows</button></li>
                <li><button class="category-tag">Learning</button></li>
                <li><button class="category-tag">Live</button></li>
                <li><button class="category-tag">Fashion</button></li>
                <li><button class="category-tag">Sports</button></li>
            </ul>
        </div>
    </section>

    <!-- Featured Videos Section -->
    <section class="featured-videos">
        <div class="container">
            <h2>Featured Videos</h2>
            <div class="video-grid">
                <!-- Video Card 1 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Forest+Escape" alt="Forest Escape">
                    <h3>Forest Escape</h3>
                    <p>Explore the beauty of nature in this mesmerizing video.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 2 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Cooking+Hacks" alt="Cooking Hacks">
                    <h3>Cooking Hacks</h3>
                    <p>Discover new recipes and cooking tips to enhance your skills.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 3 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Skateboard+Tricks" alt="Skateboard Tricks">
                    <h3>Skateboard Tricks</h3>
                    <p>Get inspired by incredible skateboarding tricks and skills.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 4 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=City+Timelapse" alt="City Timelapse">
                    <h3>City Timelapse</h3>
                    <p>Experience the vibrant energy of city life like never before.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 5 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Wildlife+Wonders" alt="Wildlife Wonders">
                    <h3>Wildlife Wonders</h3>
                    <p>Dive into the wild and explore the life of majestic animals.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
                <!-- Video Card 6 -->
                <div class="video-card">
                    <img src="https://via.placeholder.com/300x170?text=Beach+Sunset" alt="Beach Sunset">
                    <h3>Beach Sunset</h3>
                    <p>Relax and unwind with this stunning beach scenery.</p>
                    <button class="watch-now-btn">Watch Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Section -->
    <section class="trending-section">
        <div class="container">
            <h2>Trending Now</h2>
            <div class="trending-grid">
                <!-- Trending Item 1 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=Beach+Sunset" alt="Beach Sunset">
                    <div class="trending-info">
                        <h3>Beach Sunset</h3>
                        <p>Explore serene beaches. <span>5 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
                <!-- Trending Item 2 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=City+Lights" alt="City Lights">
                    <div class="trending-info">
                        <h3>City Lights</h3>
                        <p>Discover city nightlife. <span>10 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
                <!-- Trending Item 3 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=Cooking+Mastery" alt="Cooking Mastery">
                    <div class="trending-info">
                        <h3>Cooking Mastery</h3>
                        <p>Learn cooking tips. <span>15 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
                <!-- Trending Item 4 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=Mountain+Peaks" alt="Mountain Peaks">
                    <div class="trending-info">
                        <h3>Mountain Peaks</h3>
                        <p>Join epic adventures. <span>20 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
                <!-- Trending Item 5 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=Wildlife+Wonders" alt="Wildlife Wonders">
                    <div class="trending-info">
                        <h3>Wildlife Wonders</h3>
                        <p>Discover wildlife secrets. <span>25 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
                <!-- Trending Item 6 -->
                <div class="trending-item">
                    <img src="https://via.placeholder.com/250x140?text=Future+Cities" alt="Future Cities">
                    <div class="trending-info">
                        <h3>Future Cities</h3>
                        <p>Explore futuristic cities. <span>30 min ago</span></p>
                        <button class="watch-now-btn">Watch Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Basic script for active nav link, can be expanded
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.main-nav ul li a');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // e.preventDefault(); // Uncomment if using JS for actual navigation, not just class toggling
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            const categoryTags = document.querySelectorAll('.category-tag');
            categoryTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    categoryTags.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    // Add filtering logic here if needed
                });
            });
        });
    </script>
</body>
</html>
