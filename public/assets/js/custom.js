var slug = function (str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔỐÕØŘŔŠŞŤÚŮÜÙÛÝŸŽạáäảâậàãåăắčçćďéěëèếêẽĕȇệğíìîịïıňñóồốỡơớöòổôộõøðřŕšşťúůüửùûứựưụýÿžþÞĐđßÆa·/_,:;";
  var to = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOOORRSSTUUUUUYYZaaaaaaaaaaacccdeeeeeeeeeegiiiiiinnoooooooooooooorrsstuuuuuuuuuuyyzbBDdBAa------";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str; 
};

// Chạy select2
$(".js-example-tags").select2({
  tags: true,
  tokenSeparators: [',', ''],
  placeholder: "Chọn tag",
  allowClear: true,

});


// Chạy ck editor
let editor = document.querySelectorAll('.editor');
if (editor) {
  editor.forEach((element, index) => {
    element.id = 'editor_' + index;
    let ckeditor = CKEDITOR.replace(element.id);
    CKFinder.setupCKEditor(ckeditor);
  });
}

// Hàm tìm thẻ cha
function parentSelector(selector, classList) {
  while (selector) {
    selector = selector.parentElement;
    if (selector.classList.contains(classList)) {
      return selector;
    }
  }
}

// Xử lý mở popup ckfinder
function openCkfinder() {
  let chooseImages = document.querySelectorAll('.choose-image ');
  if (chooseImages) {
    chooseImages.forEach((item) => {
      item.addEventListener('click', (e) => {
        let parentElementObj = parentSelector(e.target, 'ckfinder-group');

        CKFinder.popup({
          chooseFiles: true,
          width: 800,
          height: 600,
          onInit: function (finder) {
            finder.on('files:choose', function (evt) {
              let fileUrl = evt.data.files.first().getUrl();
              //Xử lý chèn link ảnh vào input
              parentElementObj.querySelector('.image-render').value = fileUrl
              if (document.querySelector('.selectorImageJs')) {
                document.querySelector('.selectorImageJs').src = fileUrl;
              }
            });
            finder.on('file:choose:resizedImage', function (evt) {
              let fileUrl = evt.data.resizedUrl;
              //Xử lý chèn link ảnh vào input
            });
          }
          
        });
      })
    });
  }
}
openCkfinder();

// Xóa form thêm ảnh
function closeForm() {
  let closeBtn = document.querySelectorAll('.close-path');
  if (closeBtn) {
    closeBtn.forEach(element => {
      element.onclick = function (e) {
        let childClose = parentSelector(e.target, 'ckfinder-group');
        childClose.parentNode.removeChild(childClose);
      }
    });
  }
}
closeForm();
// Thêm form thêm ảnh
function addForm() {
  const html = `<div class="row ckfinder-group">
                    <div class="col-md-8">
                        <input type="text" class="form-control image-render" name="image_path[]">
                    </div>
                    <div class="col-md-2">
                        <span class="btn btn-primary btn-fill form-control choose-image">Chọn ảnh</span>
                    </div>
                    <div class="col-md-1">
                        <span class="btn btn-danger btn-fill close-path"><i class="pe-7s-trash"></i></span>
                    </div>
                    <span style="color:red;" class="errors"></span>
              </div>`;
  let addPath = document.querySelector('.add-path');
  let formPath = document.querySelector('.form-path');
  if (addPath && formPath) {
    addPath.onclick = function (e) {
      htmlChild = document.createElement('div');
      htmlChild.innerHTML = html;
      formPath.appendChild(htmlChild);
      openCkfinder();
      closeForm()
    }
  }
}
addForm();

