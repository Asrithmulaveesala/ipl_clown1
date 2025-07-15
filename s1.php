<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sample";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch top 5 teams, ordered by points and NRR
$sql = "SELECT * FROM ipl_teams ORDER BY points DESC, nrr DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIAN PREMIER LEAGUE</title>
</head>

<body>
    <header class="navbar">
        <div class="logo">IPL</div>
        <nav class="nav-items">
            <a href="teams.html">Teams</a>
            <a href="http://localhost/H2_PROJECT/points_table/points_table.php">Points Table</a>
            <a href="http://localhost/H2_PROJECT/ipl_matches/index.php">Matches</a>
            <a href="#">News</a>
            <a href="login.html">Sign in </a>
            <a href="registration.html">Sign up</a>
        </nav>
        <input type="text" placeholder="Search..." class="search-bar">
        <span class="chat-icon" onclick="toggleChat()">💬</span>
    </header>

    <div id="chatIcon" onclick="toggleChat()"></div>

    <div id="chatWindow">
        <div id="chatBody"></div>
        <div id="chatInputContainer">
            <input type="text" id="chatInput" placeholder="Ask about IPL..." onkeydown="if(event.key==='Enter') sendMessage()">
            <button id="sendBtn" onclick="sendMessage()">Send</button>
            <button id="endChatBtn" onclick="endChat()">End Chat</button>

        </div>
    </div>

    <div class="image-row">
        <!-- Slideshow -->
        <div class="image-box">
            <div class="slideshow">
                <img src="pic1.jpg" alt="Image 1" class="slide">
                <img src="pic3.jpg" alt="Image 7" class="slide">
            </div>
        </div>
        <div class="image-box">
            <div class="slideshow">
                <img src="pic1.png" alt="Image 2" class="slide">
                <img src="pic2.jpg" alt="Image 5" class="slide">
            </div>
        </div>
        <div class="image-box">
            <div class="slideshow">
                <img src="pic20.png" alt="Image 3" class="slide">
                <img src="pic22.png" alt="Image 6" class="slide">
                <img src="pic23.png" alt="Image 9" class="slide">
            </div>
        </div>
    </div>

    <div class="container">
        <section id="about" class="section">
            <div>
                <h2>About the Tournament</h2>
                <p>The Indian Premier League (IPL) is one of the most popular and lucrative professional T20 cricket leagues in the world. Founded in 2008 by the Board of Control for Cricket in India (BCCI), the IPL brings together top cricketing talent from around the globe to compete in a fast-paced, high-energy format.</p>
            </div>
        </section>
    </div>

    <div class="b1">
        <h1>WHAT ARE YOU LOOKING FOR</h1>
        <div class="buttons-container">
            <button class="btn" onclick="openpage1()">POINTS TABLE</button>
            <button class="btn" onclick="openpage3()">FIXTURES</button>
            <button class="btn" onclick="openpage2()">GALLERY</button>
            <button class="btn" onclick="openPage()">ALL TEAMS</button>
        </div>
    </div>

    <div class="points-table-container">
        <h2>Points Table</h2>
        <?php
        $position = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="points-card">
                <h3><?php echo $position . ". " . (isset($row['team']) ? htmlspecialchars($row['team']) : 'No Team Name'); ?></h3>
                <img src="points_table/images/<?php echo isset($row['logo']) ? htmlspecialchars($row['logo']) : 'default.png'; ?>" alt="<?php echo isset($row['team']) ? htmlspecialchars($row['team']) : 'No Logo'; ?>">
                <p><strong>Points:</strong> <?php echo isset($row['points']) ? $row['points'] : 0; ?></p>
                <p><strong>Played:</strong> <?php echo isset($row['played']) ? $row['played'] : 0; ?></p>
                <p><strong>Won:</strong> <?php echo isset($row['won']) ? $row['won'] : 0; ?></p>
                <p><strong>NRR:</strong> <span class="nrr <?php echo isset($row['nrr']) && $row['nrr'] >= 0 ? 'positive' : 'negative'; ?>">
                    <?php echo isset($row['nrr']) ? number_format($row['nrr'], 3) : 0.000; ?></span></p>
                <p><strong>Recent Form:</strong> <span class="form">
                    <?php
                    $form = isset($row['recent_form']) ? str_split(substr($row['recent_form'], -5)) : [];
                    foreach ($form as $f) {
                        $style = $f === 'W' ? 'color: green;' : ($f === 'L' ? 'color: red;' : '');
                        echo "<span style='$style'>$f</span>";
                    }
                    ?>
                </span></p>
            </div>
            <?php
            $position++;
        }
        ?>
    </div>

    <button class="full-table-btn" onclick="openpage1()">Full Points Table</button>
    <footer class="footer">
        <div>
            <h3>TEAM</h3>
            <ul>
                <li><a href="#">Chennai Super Kings</a></li>
                <li><a href="#">Delhi Capitals</a></li>
                <li><a href="#">Gujarat Titans</a></li>
                <li><a href="#">Kolkata Knight Riders</a></li>
                <li><a href="#">Lucknow Super Giants</a></li>
                <li><a href="#">Mumbai Indians</a></li>
                <li><a href="#">Punjab Kings</a></li>
                <li><a href="#">Rajasthan Royals</a></li>
                <li><a href="#">Royal Challengers Bengaluru</a></li>
                <li><a href="#">Sunrisers Hyderabad</a></li>
            </ul>
        </div>
        <div>
            <h3>ABOUT</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Anti Corruption Code</a></li>
                <li><a href="#">Anti Doping Rules</a></li>
                <li><a href="#">TUE Application Form</a></li>
                <li><a href="#">Anti Discrimination Code</a></li>
                <li><a href="#">Clothing & Equipment Regulations</a></li>
                <li><a href="#">Code Of Conduct For Players</a></li>
                <li><a href="#">News Access Regulations</a></li>
                <li><a href="#">Image Use Terms</a></li>
            </ul>
        </div>
        <div>
            <h3>GUIDELINES</h3>
            <ul>
                <li><a href="#">Code Of Conduct For Officials</a></li>
                <li><a href="#">Brand & Protection Guidelines</a></li>
                <li><a href="#">Governing Council</a></li>
                <li><a href="#">Match Playing Conditions</a></li>
                <li><a href="#">PMOA Minimum Standard</a></li>
                <li><a href="#">Suspect Action Policy</a></li>
            </ul>
        </div>
        <div>
            <h3>CONTACT</h3>
            <ul>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Sponsorship</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>
    </footer>

    <div class="footer-bottom">
        Copyright © IPL 2025 All Rights Reserved.
    </div>



    <script>
        function startSlideshow(imageBox) {
            let slides = imageBox.getElementsByClassName('slide');
            let index = 0;

            function showSlide() {
                for (let i = 0; i < slides.length; i++) {
                    slides[i].style.display = 'none';
                }
                slides[index].style.display = 'block';
                index = (index + 1) % slides.length;
            }

            showSlide();
            setInterval(showSlide, 2000);
        }

        document.querySelectorAll('.image-box').forEach(box => startSlideshow(box));

        function openPage() { window.location.href = "teams.html"; }
        function openpage1() { window.location.href = "http://localhost/H2_PROJECT/points_table/points_table.php"; }
        function openpage2() { window.location.href = "gallery.html"; }
        function openpage3() { window.location.href = "http://localhost/H2_PROJECT/ipl_matches/index.php"; }

        document.querySelector('.search-bar').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                const query = e.target.value.toLowerCase().trim();
                if (query.includes("teams")) window.location.href = "teams.html";
                else if (query.includes("points") || query.includes("table")) openpage1();
                else if (query.includes("gallery")) openpage2();
                else if (query.includes("login")) window.location.href = "login.html";
                else if (query.includes("sign up") || query.includes("register")) window.location.href = "registration.html";
                else alert("No matching page found for: " + query);
            }
        });

        function toggleChat() {
            const chatWindow = document.getElementById('chatWindow');
            chatWindow.style.display = (chatWindow.style.display === 'none' || chatWindow.style.display === '') ? 'flex' : 'none';
        }

        function endChat() {
            const chatWindow = document.getElementById('chatWindow');
            const input = document.getElementById('chatInput');
            const chatBody = document.getElementById('chatBody');

            const botMessage = document.createElement('div');
            botMessage.className = 'chat-message bot';
            botMessage.textContent = "Chat ended. Have a great day! 👋";
            chatBody.appendChild(botMessage);

            input.disabled = true;
            input.placeholder = "Chat ended.";
            setTimeout(() => {
                chatWindow.style.display = "none";
            }, 1000);
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const chatBody = document.getElementById('chatBody');
            const message = input.value.trim().toLowerCase();

            if (message === '') return;

            const userMessage = document.createElement('div');
            userMessage.className = 'chat-message user';
            userMessage.textContent = message;
            chatBody.appendChild(userMessage);
            chatBody.scrollTop = chatBody.scrollHeight;
            input.value = '';

            const botMessage = document.createElement('div');
            botMessage.className = 'chat-message bot';
            let reply = "Sorry, I didn’t get that. Try asking about teams, matches, stats, or points table.";

            if (["hi", "hello", "hey"].includes(message)) reply = "Hello! I'm your IPL Chat Assistant. Ask me anything about teams, matches, or standings!";
            else if (message.includes("teams")) reply = "The 10 IPL 2025 teams are: CSK, MI, RCB, GT, LSG, DC, RR, KKR, SRH, PBKS.";
            else if (message.includes("best team")) reply = "Every fan has their favorite! Historically, CSK and MI have been top performers.";
            else if (message.includes("best player")) reply = "Players like Virat Kohli, MS Dhoni, Rohit Sharma, and Jos Buttler are fan favorites!";
            else if (message.includes("orange cap")) reply = "The Orange Cap is awarded to the highest run-scorer in a season.";
            else if (message.includes("purple cap")) reply = "The Purple Cap is awarded to the leading wicket-taker of the tournament.";
            else if (message.includes("points") || message.includes("table")) reply = "Check the latest standings by clicking the 'Points Table' button above.";
            else if (message.includes("top team")) reply = "The top 5 teams are displayed on this page based on points and NRR.";
            else if (message.includes("schedule") || message.includes("fixtures")) reply = "You can view all match schedules under the 'Matches' section.";
            else if (message.includes("next match")) reply = "Stay tuned! You can find upcoming matches in the Matches section.";
            else if (message.includes("ipl winner") || message.includes("last winner") || message.includes("2024 winner")) reply = "IPL 2024 was won by Chennai Super Kings (CSK) 🏆.";
            else if (message.includes("about ipl")) reply = "IPL is a professional T20 league started in 2008. It’s one of the most popular cricket leagues worldwide.";
            else if (message.includes("stadiums")) reply = "IPL matches are hosted in iconic stadiums like Wankhede, Eden Gardens, Chinnaswamy, and more.";
            else if (message.includes("buy tickets")) reply = "Tickets are usually available on BookMyShow or the IPL official website during the season.";
            else if (message.includes("csk")) reply = "CSK, led by MS Dhoni, has won 5 IPL titles. They're known for consistency and loyal fans.";
            else if (message.includes("mi")) reply = "MI is one of the most successful franchises with 5 titles. Known for strong all-round squads.";
            else if (message.includes("rcb")) reply = "RCB is a fan-favorite team with star players like Virat Kohli. Still chasing their first title!";
            else if (message.includes("who will win") || message.includes("prediction")) reply = "That’s tough! Every team is strong. Who do you think will win IPL 2025?";
            else if (message.includes("dhoni")) reply = "Thala for a reason! MS Dhoni is a legend of the game and CSK’s heart.";
            else if (message.includes("virat") || message.includes("kohli")) reply = "King Kohli! One of the best batsmen in IPL and international cricket.";

            botMessage.textContent = reply;
            chatBody.appendChild(botMessage);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
