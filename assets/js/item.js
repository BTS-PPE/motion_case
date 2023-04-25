var ctrl = document.getElementsByClassName("images")[0];
var mainImage = document.getElementById("mainImage");

ctrl.addEventListener("click", function(e) {
    var img = e.target;
    mainImage.src = img.src;
    mainImage.animate([ { transform: 'scale(1.2)' } ], { duration: 500, fill: 'both' });
    // $(mainImage).css("transform", "scale(1.2)");
});