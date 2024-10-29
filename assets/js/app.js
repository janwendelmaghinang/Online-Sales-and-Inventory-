
window.onscroll = function() {myFunction()};
var navbar = document.querySelector('section');
var sticky = navbar.offsetTop;

var nav = document.querySelector('.navigations');
function myFunction() {
  if (window.pageYOffset >= sticky) {
    // nav.classList.add("sticky")
  } 
  else 
  {
    nav.classList.remove("sticky");
  }
}

// submit button double click avoid
// $(document).ready(function () {
//   $("#btn-all").on('click', function (event) {  
//         event.preventDefault();
//         var el = $(this);
//         el.prop('disabled', true);
//         setTimeout(function(){el.prop('disabled', false); }, 3000);
//   });
// });

