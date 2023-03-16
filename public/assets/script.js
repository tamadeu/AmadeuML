window.scrollTo(0,document.body.scrollHeight);

// Get the "sendForm" link element
var sendFormLink = document.getElementById("sendForm");

// Get the form element
var form = document.getElementById("footer-bar");

// Add a click event listener to the link
sendFormLink.addEventListener("click", function(event) {
    // Prevent the default link behavior (i.e. navigating to a new page)
    event.preventDefault();

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage = document.getElementById("userMessage");

    var message = $("#message").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message + '</p></div>');

    window.scrollTo(0,document.body.scrollHeight);
    
    // Submit the form
    form.submit();

    document.getElementById('message').value = '';
});

// Add a submit event listener to the form
form.addEventListener("submit", function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage = document.getElementById("userMessage");

    var message = $("#message").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message + '</p></div>');

    window.scrollTo(0,document.body.scrollHeight);
    
    // Submit the form
    form.submit();

    document.getElementById('message').value = '';
});

// Get the question element
var question1 = document.getElementById("question1");

// Add a click event listener to the link
question1.addEventListener("click", function(event) {

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage1 = document.getElementById("userMessage");

    var message1 = $("#questionMessage1").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage1.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message1 + '</p></div>');
});

// Get the question element
var question2 = document.getElementById("question2");

// Add a click event listener to the link
question2.addEventListener("click", function(event) {

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage2 = document.getElementById("userMessage");

    var message2 = $("#questionMessage2").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage2.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message2 + '</p></div>');
});

// Get the question element
var question3 = document.getElementById("question3");

// Add a click event listener to the link
question3.addEventListener("click", function(event) {

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage3 = document.getElementById("userMessage");

    var message3 = $("#questionMessage3").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage3.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message3 + '</p></div>');
});

// Get the question element
var question4 = document.getElementById("question4");

// Add a click event listener to the link
question4.addEventListener("click", function(event) {

    // Get the loader element
    var loader = document.getElementById("loader");

    // Get the userMessage element
    var userMessage4 = document.getElementById("userMessage");

    var message4 = $("#questionMessage4").val();
    
    // Show the preloader
    loader.classList.remove("d-none");

    // Show the userMessage
    userMessage4.classList.remove("d-none");
    $("#userMessage").html('<div class="media-body"><p>' + message4 + '</p></div>');

    window.scrollTo(0,document.body.scrollHeight);
    
    document.getElementById('message').value = '';
});