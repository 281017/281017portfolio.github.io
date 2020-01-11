<script>
window.onscroll = function() {myFunction()};

var menu_bar = document.getElementById("menu_bar");
var sticky = menu_bar.offsetTop;

function myFunction() {
if (window.pageYOffset >= sticky) {
menu_bar.classList.add("sticky")
} else {
menu_bar.classList.remove("sticky");
}
}
</script>
