function bukanav(){
  var a = $('#sidenav');
  a.classList.add('aktif');
}
function closenav(){
  var a = $('#sidenav');
  a.classList.remove('aktif');
}
function $(elem){
  return document.querySelector(elem);
}