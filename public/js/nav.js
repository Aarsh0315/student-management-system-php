document.addEventListener("DOMContentLoaded", function () {

    const searchBox =
        document.getElementById("navbarSearch");

    const input =
        document.getElementById("globalSearch");

    const items =
        document.querySelectorAll(".search-item");

    const sections =
        document.querySelectorAll(".search-section");

    const noResults =
        document.getElementById("searchNoResults");


    /* ========================================
       SEARCH
    ======================================== */

    if (searchBox && input) {

        /* ========================================
           OPEN SEARCH
        ======================================== */

        function openSearch()
        {
            searchBox.classList.add("search-open");
        }


        /* ========================================
           CLOSE SEARCH
        ======================================== */

        function closeSearch()
        {
            searchBox.classList.remove("search-open");
        }


        /* ========================================
           FOCUS
        ======================================== */

        input.addEventListener("focus", function () {

            openSearch();

        });


        /* ========================================
           SEARCH
        ======================================== */

        input.addEventListener("input", function () {

            const value =
                input.value
                    .toLowerCase()
                    .trim();


            let visibleCount = 0;


            items.forEach(function (item) {

                const searchData =
                    item.dataset.search
                        .toLowerCase();

                const itemText =
                    item.innerText
                        .toLowerCase();


                const match =
                    value === "" ||
                    searchData.includes(value) ||
                    itemText.includes(value);


                if (match) {

                    item.style.display = "flex";

                    visibleCount++;

                } else {

                    item.style.display = "none";

                }

            });


            /* ========================================
               SECTIONS
            ======================================== */

            sections.forEach(function (section) {

                const sectionItems =
                    section.querySelectorAll(".search-item");

                let hasVisibleItem = false;


                sectionItems.forEach(function (item) {

                    if (item.style.display !== "none") {

                        hasVisibleItem = true;

                    }

                });


                section.style.display =
                    hasVisibleItem
                        ? "block"
                        : "none";

            });


            /* ========================================
               NO RESULTS
            ======================================== */

            if (noResults) {

                noResults.style.display =
                    visibleCount === 0
                        ? "block"
                        : "none";

            }


            openSearch();

        });


        /* ========================================
           ESCAPE
        ======================================== */

        document.addEventListener("keydown", function (event) {

            if (event.key === "Escape") {

                closeSearch();

                input.blur();

            }

        });


        /* ========================================
           "/" SEARCH SHORTCUT
        ======================================== */

        document.addEventListener("keydown", function (event) {

            const active =
                document.activeElement;

            const typing =
                active &&
                (
                    active.tagName === "INPUT" ||
                    active.tagName === "TEXTAREA"
                );


            if (
                event.key === "/" &&
                !typing
            ) {

                event.preventDefault();

                input.focus();

            }

        });


        /* ========================================
           CLICK OUTSIDE
        ======================================== */

        document.addEventListener("click", function (event) {

            if (!searchBox.contains(event.target)) {

                closeSearch();

            }

        });

    }


    /* ========================================
       LIGHT / DARK THEME
    ======================================== */

    const themeToggle =
        document.getElementById("themeToggle");

    const themeIcon =
        document.getElementById("themeIcon");

    const themeText =
        document.getElementById("themeText");


    if (themeToggle) {

        /* ========================================
           APPLY THEME
        ======================================== */

        function applyTheme(theme)
        {

            document.documentElement
                .setAttribute("data-theme", theme);


            if (theme === "dark") {

                if (themeIcon) {
                    themeIcon.textContent = "☀";
                }

                if (themeText) {
                    themeText.textContent = "Light";
                }

                themeToggle.setAttribute(
                    "aria-label",
                    "Switch to light mode"
                );

                themeToggle.setAttribute(
                    "title",
                    "Switch to light mode"
                );

            } else {

                if (themeIcon) {
                    themeIcon.textContent = "☾";
                }

                if (themeText) {
                    themeText.textContent = "Dark";
                }

                themeToggle.setAttribute(
                    "aria-label",
                    "Switch to dark mode"
                );

                themeToggle.setAttribute(
                    "title",
                    "Switch to dark mode"
                );

            }

        }


        /* ========================================
           LOAD SAVED THEME
        ======================================== */

        const savedTheme =
            localStorage.getItem("mySchoolTheme");


        if (
            savedTheme === "dark" ||
            savedTheme === "light"
        ) {

            applyTheme(savedTheme);

        } else {

            applyTheme("light");

        }


        /* ========================================
           TOGGLE
        ======================================== */

        themeToggle.addEventListener(
            "click",
            function ()
            {

                const currentTheme =
                    document.documentElement
                        .getAttribute("data-theme");


                const newTheme =
                    currentTheme === "dark"
                        ? "light"
                        : "dark";


                localStorage.setItem(
                    "mySchoolTheme",
                    newTheme
                );


                applyTheme(newTheme);

            }
        );

    }

});