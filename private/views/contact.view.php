<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Contact - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/static-pages.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="static-page">

    <section class="static-card">

        <p class="static-label">
            My School
        </p>

        <h1>
            Contact Us
        </h1>

        <p>
            If you have any questions, feedback or
            need assistance, please contact us.
        </p>


        <div class="contact-information">

            <div>
                <strong>
                    Email
                </strong>

                <p>
                    support@myschool.com
                </p>
            </div>


            <div>
                <strong>
                    Phone
                </strong>

                <p>
                    +91 00000 00000
                </p>
            </div>

        </div>

    </section>

</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>