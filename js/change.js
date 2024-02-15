
    // Function to load content dynamically
    function loadContent(page) {
        $.ajax({
            url: page,
            type: "GET",
            dataType: "html",
            success: function(response) {
                $("body").html(response);  // Replace entire body content
            },
            error: function() {
                window.location.href = "404";
            }
        });
    }
    function loadContent2(page) {
        $.ajax({
            url: page,
            type: "GET",
            dataType: "html",
            success: function(response) {
                $("head").html(response);  // Replace entire body content
            },
            error: function() {
                window.location.href = "404";
            }
        });
    }
    // Load home page by default

    // Attach click events to navigation links
    $(".nav-link").on("click", function(e) {
        e.preventDefault();
        var page = $(this).attr("href");
        loadContent(page);
        loadContent2(page);
    });

