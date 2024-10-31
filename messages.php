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
    <?php include "components/sidebar.php"; ?>

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