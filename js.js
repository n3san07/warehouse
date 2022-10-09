let url = `index.php`;
let serchInput = document.getElementById("serch");
let serchBtn = document.getElementById("serchBtn");
serchBtn.addEventListener("click", serch);
console.log(serchInput.value);
if (!serchInput.value) {
  getData();
}
function getData() {
  fetch(url)
    .then((res) => {
      return res.json();
    })
    .then(function (x) {
      createHtml(x);
      console.log(x);
    })
    .catch((err) => {
      console.log(err);
    });
}
function createHtml(x) {
  let html = "";
  for (let i = 0; i < x.length; i++) {
    html += `
<tr id="${x[i].id}" >
<th scope="row">${i + 1}</th>
<td>${x[i].name}</td>
<td>${x[i].price}</td>
<td>${x[i].place}</td>
<td><img src="${x[i].img}" onclick="imgHover(this)" class="previewImg"></td>
<td><button type="button" onclick="del(this)"  class="btn btn-outline-danger">X</button></td>
<td>    <button
type="button"
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#editModel"
onclick="edit(this)"
>
edit
</button></td>
</tr>

`;
  }
  document.getElementById("tbody").innerHTML = html;
}

function serch() {
  if (serchInput.value) {
    $.ajax({
      type: "POST",
      url: "serch.php",
      data: { serch: serchInput.value },
      success: function (data) {
        let x = JSON.parse(data);
        console.log(x);
        createHtml(x);
      },
    });
    serchInput.value = "";
  } else {
    getData();
  }
}

function del(id) {
  elem = id.parentElement.parentElement;

  $.ajax({
    type: "POST",
    url: "del.php",
    data: { id: elem.id },
    success: function (data) {},
  });
  elem.remove();
}
let id;
function edit(x) {
  id = x.parentElement.parentElement.id;
  let name = x.parentElement.parentElement.children[1].outerText;
  let price = x.parentElement.parentElement.children[2].outerText;
  let place = x.parentElement.parentElement.children[3].outerText;
  console.log(price);

  let editName = document.getElementsByClassName("editName");
  let editPrice = document.getElementsByClassName("editPrice");
  let editPlace = document.getElementsByClassName("editPlace");
  console.log(editName[0]);
  editName[0].value = name;
  editPrice[0].value = Number(price);
  editPlace[0].value = place;
}
function saveEdit() {
  let editName = document.getElementsByClassName("editName");
  let editPrice = document.getElementsByClassName("editPrice");
  let editPlace = document.getElementsByClassName("editPlace");

  let namePHP = editName[0].value;
  let PricePHP = editPrice[0].value;
  let PlacePHP = editPlace[0].value;

  $.ajax({
    type: "POST",
    url: "edit.php",
    data: { id: id, name: namePHP, price: PricePHP, place: PlacePHP },
    success: function (data) {},
  });
}

function imgHover(x) {
 /* let img = document.getElementsByClassName("previewImg");
  console.log(img);

  for (let elem of img) {
    if( elem.classList.contains("ClickedPreviewImg") ) {
    elem.classList.remove("ClickedPreviewImg")
}
  }*/
  x.classList.toggle("ClickedPreviewImg");
}
