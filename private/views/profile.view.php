<section class="profile-card">

    <div class="profile-left">

        <div class="profile-avatar">

            <?= strtoupper(
                substr($_SESSION['firstname'] ?? 'U', 0, 1)
            ) ?>

        </div>


        <div class="profile-details">

            <h2>

                <?= htmlspecialchars($_SESSION['firstname'] ?? '') ?>

                <?= htmlspecialchars($_SESSION['lastname'] ?? '') ?>

            </h2>

            <p>

                <?= htmlspecialchars($_SESSION['email'] ?? '') ?>

            </p>

            <span>

                <?= htmlspecialchars($_SESSION['rank'] ?? '') ?>

            </span>

        </div>

    </div>


    <a
        href="<?= ROOT ?>/profile"
        class="profile-btn"
    >
        View Profile
    </a>

</section>