function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = x.length }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-white", "");
    }
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " w3-white";
}

function getSize() {
    var height = $(window).height();
    var width = $(window).width();
    $.ajax({
        url: 'index.php',
        type: 'post',
        data: { 'width': width, 'height': height, 'recordSize': 'true' },
        success: function(response) {
            $("body").html(response);
        }
    });
}

function changeImage(current) {
    var imagesNumber = 3;

    for (i = 1; i <= imagesNumber; i++) {
        if (i == current) {
            document.getElementById("normal" + current).style.display = "flex";
        } else {
            document.getElementById("normal" + i).style.display = "none";
        }
    }
}

function replace(hide, show) {
    document.getElementById(hide).style.display = "none";
    document.getElementById(show).style.display = "block";
}