  var btns = document.querySelectorAll('.edit');


  console.log(btns);
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', function(){
      this.nextElementSibling.classList.toggle('visible');
      this.nextElementSibling.classList.toggle('unvisible');
    });
  }
