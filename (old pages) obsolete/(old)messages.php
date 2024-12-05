<?php
require 'vendor/autoload.php';

session_start();

function getClient() {
    $client = new Google_Client();
    $client->setAuthConfig('C:/Users/Kenoah/Documents/GitHub/hris/Admin-System/credentials.json');
    $client->setAccessType('offline');
    $client->setRedirectUri('http://localhost:3000/messages.php'); // Update with your redirect URI
    $client->addScope(Google_Service_Gmail::MAIL_GOOGLE_COM);

    // Token file to store the token information
    $tokenPath = 'token.json';

    // If there’s an access token in session, set it
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // Check if the token is expired
    if ($client->isAccessTokenExpired()) {
        if ($client->getRefreshToken()) {
            // Refresh the token if possible
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Redirect user to authorization URL if no valid token
            if (!isset($_GET['code'])) {
                $authUrl = $client->createAuthUrl();
                echo "<a href='$authUrl'>Connect to Gmail</a>";
                exit;
            } else {
                // Handle the authorization response by exchanging the code
                $authCode = $_GET['code'];
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Save the token to a file
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            }
        }
    }
    return $client;
}

$client = getClient();
$service = new Google_Service_Gmail($client);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employees List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <?php include "components/sidebar.php";
  
    ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>MESSAGES</span></p>
            </div>

            <div class="right">
                <a href="#">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <section class="messages-section">
            <div class="messages-container">
                <div class="messages-top-menu">
                    <div class="search-bar messages-search-bar">
                        <input type="text" name="search-bar" id="search-bar" placeholder="Search something..." />
                        <span><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <div>
                        <select name="document-sort" id="" class="sort-select">
                            <option value="" selected disabled>Sort Options</option>
                            <option value="Date Added">Date Added</option>
                            <option value="Alphabetical">Alphabetical</option>
                        </select>
                    </div>
                </div>

                <div class="messages-cards">
                    <a class="messages-card">
                        <span class="material-symbols-outlined">star</span>
                        <p class="message-name">Juan Jose Tanggol</p>
                        <p class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            exercitationem cumque similique nostrum error? Odio,
                            reprehenderit cum. Quisquam dolor repellat quasi ea at velit
                            delectus vitae impedit illo, eum tenetur.
                        </p>
                    </a>

                    <a class="messages-card">
                        <span class="material-symbols-outlined">star</span>
                        <p class="message-name">Juan Jose Tanggol</p>
                        <p class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            exercitationem cumque similique nostrum error? Odio,
                            reprehenderit cum. Quisquam dolor repellat quasi ea at velit
                            delectus vitae impedit illo, eum tenetur.
                        </p>
                    </a>

                    <a class="messages-card">
                        <span class="material-symbols-outlined">star</span>
                        <p class="message-name">Juan Jose Tanggol</p>
                        <p class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            exercitationem cumque similique nostrum error? Odio,
                            reprehenderit cum. Quisquam dolor repellat quasi ea at velit
                            delectus vitae impedit illo, eum tenetur.
                        </p>
                    </a>

                    <a class="messages-card">
                        <span class="material-symbols-outlined">star</span>
                        <p class="message-name">Juan Jose Tanggol</p>
                        <p class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            exercitationem cumque similique nostrum error? Odio,
                            reprehenderit cum. Quisquam dolor repellat quasi ea at velit
                            delectus vitae impedit illo, eum tenetur.
                        </p>
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js "></script>

</html>